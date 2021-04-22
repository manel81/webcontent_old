<?php

declare(strict_types = 1);

namespace Drupal\dp_trigger\Controller;

/**
 * Devportal Pro module for Drupal.
 *
 * Copyright (C) 2018 PRONOVIX GROUP BVBA.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301,
 * USA.
 */

use Drupal\Component\Datetime\TimeInterface;
use Drupal\Component\Utility\Random;
use Drupal\Core\Config\Config;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\ProxyClass\File\MimeType\MimeTypeGuesser;
use Drupal\devportal_api_reference\ReferenceTypeManager;
use Drupal\dp_trigger\ResolverManager;
use Drupal\file\Entity\File;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Trigger controller class.
 */
class TriggerController extends ControllerBase {

  /**
   * Resolver manager serivce.
   *
   * @var \Drupal\dp_trigger\ResolverManager
   */
  protected $resolverManager;

  /**
   * Mime type guesser service.
   *
   * @var \Drupal\Core\ProxyClass\File\MimeType\MimeTypeGuesser
   */
  protected $guesser;

  /**
   * Reference type manager service.
   *
   * @var \Drupal\devportal_api_reference\ReferenceTypeManager
   */
  protected $referenceManager;

  /**
   * Config service.
   *
   * @var \Drupal\Core\Config\Config
   */
  protected $settings;

  /**
   * Datetime service.
   *
   * @var \Drupal\Component\Datetime\TimeInterface
   */
  protected $time;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    /** @var \Drupal\dp_trigger\ResolverManager $resolverManager */
    $resolverManager = $container->get('plugin.manager.dp_trigger_resolver');
    /** @var \Drupal\Core\ProxyClass\File\MimeType\MimeTypeGuesser $guesser */
    $guesser = $container->get('file.mime_type.guesser');
    /** @var \Drupal\devportal_api_reference\ReferenceTypeManager $referenceManager */
    $referenceManager = $container->get('plugin.manager.reference');
    /** @var \Drupal\Core\Config\Config $config */
    $config = $container->get('config.factory')->get('dp_trigger.settings');
    /** @var \Drupal\Component\Datetime\TimeInterface $time */
    $time = $container->get('datetime.time');

    return new static(
      $resolverManager,
      $guesser,
      $referenceManager,
      $config,
      $time
    );
  }

  /**
   * TriggerController constructor.
   *
   * @param \Drupal\dp_trigger\ResolverManager $resolverManager
   *   Resolver manager.
   * @param \Drupal\Core\ProxyClass\File\MimeType\MimeTypeGuesser $guesser
   *   Mime type guesser.
   * @param \Drupal\devportal_api_reference\ReferenceTypeManager $referenceTypeManager
   *   Reference type manager.
   * @param \Drupal\Core\Config\Config $config
   *   Config.
   * @param \Drupal\Component\Datetime\TimeInterface $time
   *   Datetime.
   */
  public function __construct(ResolverManager $resolverManager, MimeTypeGuesser $guesser, ReferenceTypeManager $referenceTypeManager, Config $config, TimeInterface $time) {
    $this->resolverManager = $resolverManager;
    $this->guesser = $guesser;
    $this->referenceManager = $referenceTypeManager;
    $this->settings = $config;
    $this->time = $time;
  }

  /**
   * Page handler for 'dp_trigger.tokens.trigger'.
   *
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   Triggering entity.
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   The HTTP request object.
   *
   * @return \Symfony\Component\HttpFoundation\Response
   *   A HTTP response object with 202 status code if the request was accepted.
   */
  public function trigger(EntityInterface $entity, Request $request): Response {
    $content_type = $request->headers->get('Content-Type');
    $filename = static::contentTypeToFileName($content_type);
    if (!$filename) {
      throw new NotAcceptableHttpException('Invalid content type. Valid content types are: text/yaml, application/yaml, application/json');
    }

    $body = $request->getContent();

    $api = NULL;
    try {
      $tmpfile = rtrim(sys_get_temp_dir(), '/') . '/' . $filename;
      file_put_contents($tmpfile, $body);
      $instance = $this->referenceManager->lookupPlugin($tmpfile);
      if (!$instance) {
        throw new NotAcceptableHttpException('Invalid MIME type.');
      }

      $api = $instance->parse($tmpfile);
      // PHPCS doesn't know about this syntax of assignment.
      // phpcs:ignore DrupalPractice.CodeAnalysis.VariableAnalysis.UndefinedVariable
      [, $version, , $doc, $type] = _devportal_api_reference_get_data_from_file(
        $tmpfile
      );
    }
    catch (\Exception $ex) {
      throw new UnprocessableEntityHttpException($ex->getMessage(), $ex);
    }
    finally {
      @unlink($tmpfile);
    }

    /** @var \Drupal\dp_trigger\ResolverInterface $resolver */
    $resolver = $this->resolverManager
      ->createInstance($entity->getEntityTypeId());

    /** @var \Drupal\node\NodeInterface $api_ref */
    $api_ref = $resolver->resolve($entity, $api);
    if (!$api_ref) {
      throw new NotFoundHttpException('Project cannot be resolved');
    }

    $path = "public://{$filename}";
    if (!file_put_contents($path, $body)) {
      throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR, 'Failed to save uploaded file');
    }
    $file = File::create([
      'uid' => $api_ref->getOwnerId(),
      'status' => FILE_STATUS_PERMANENT,
      'filename' => $filename,
      'uri' => $path,
      'filesize' => strlen($body),
      'filemime' => $this->guesser->guess($filename),
    ]);
    $file->save();

    $api_ref->setChangedTime($this->time->getRequestTime());

    $mappings = $this->moduleHandler()
      ->invokeAll('devportal_api_reference_fields', [
        // PHPCS doesn't know about that syntax of assignment above.
        // phpcs:ignore DrupalPractice.CodeAnalysis.VariableAnalysis.UndefinedVariable
        $type,
        // PHPCS doesn't know about that syntax of assignment above.
        // phpcs:ignore DrupalPractice.CodeAnalysis.VariableAnalysis.UndefinedVariable
        $doc,
        $file,
        $request,
      ]);
    foreach ($mappings as $field_name => $value) {
      $api_ref->set($field_name, $value);
    }

    $api_ref->set('field_source_file', $file->id());
    $api_ref->setNewRevision();
    $api_ref->setRevisionUserId($this->currentUser()->id());
    $api_ref->setRevisionCreationTime($this->time->getRequestTime());
    $api_ref->setRevisionLogMessage($this->t('Developer Portal Trigger - API version: @version', [
      // PHPCS doesn't recognize that this variable HAS been initialized.
      // phpcs:ignore DrupalPractice.CodeAnalysis.VariableAnalysis.UndefinedVariable
      '@version' => $version,
    ]));
    if ($this->settings->get('set_status')) {
      $api_ref->set('status', (bool) $this->settings->get('status'));
    }

    // PHPCS doesn't recognize that this variable HAS been initialized.
    // phpcs:ignore DrupalPractice.CodeAnalysis.VariableAnalysis.UndefinedVariable
    if (devportal_api_reference_check_api_version($api_ref, $version)) {
      // PHPCS doesn't recognize that this variable HAS been initialized.
      // phpcs:ignore DrupalPractice.CodeAnalysis.VariableAnalysis.UndefinedVariable
      throw new ConflictHttpException("API documentation version {$version} already exists");
    }

    $api_ref->save();

    return new Response('', Response::HTTP_ACCEPTED);
  }

  /**
   * Generates a file name based on the content type.
   *
   * @param string $content_type
   *   Content type.
   *
   * @return null|string
   *   File name if found.
   */
  public static function contentTypeToFileName(string $content_type): ?string {
    static $map = [
      'text/yaml' => 'yaml',
      'application/yaml' => 'yaml',
      'application/json' => 'json',
    ];
    $extension = $map[$content_type] ?? NULL;
    return $extension ? ((new Random())->name() . '.' . $extension) : NULL;
  }

}
