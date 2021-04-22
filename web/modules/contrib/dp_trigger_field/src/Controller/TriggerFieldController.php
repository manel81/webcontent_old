<?php

declare(strict_types = 1);

namespace Drupal\dp_trigger_field\Controller;

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
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityInterface;
use Drupal\dp_trigger\ResolverManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Controller class for field updates.
 */
class TriggerFieldController extends ControllerBase {

  /**
   * Resolver manager service.
   *
   * @var \Drupal\dp_trigger\ResolverManager
   */
  protected $resolverManager;

  /**
   * Datateime service.
   *
   * @var \Drupal\Component\Datetime\TimeInterface
   */
  protected $time;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('plugin.manager.dp_trigger_resolver'),
      $container->get('datetime.time')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function __construct(ResolverManager $resolverManager, TimeInterface $time) {
    $this->resolverManager = $resolverManager;
    $this->time = $time;
  }

  /**
   * Field updater endpoint.
   *
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   Triggering entity.
   * @param string $field_name
   *   Field name.
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   HTTP request object.
   *
   * @return \Symfony\Component\HttpFoundation\Response
   *   HTTP response.
   */
  public function triggerField(EntityInterface $entity, string $field_name, Request $request): Response {
    /** @var \Drupal\dp_trigger\ResolverInterface $resolver */
    $resolver = $this->resolverManager
      ->createInstance($entity->getEntityTypeId());
    $api_ref = $resolver->resolve($entity, NULL);
    if (!$api_ref) {
      throw new NotFoundHttpException('Project cannot be resolved.');
    }

    if (!$api_ref->hasField($field_name)) {
      throw new NotFoundHttpException('Field does not exists.');
    }

    $whitelist = $this->config('dp_trigger_field.settings')->get('whitelist') ?: [];
    if (!in_array($field_name, $whitelist, TRUE)) {
      throw new NotFoundHttpException('This field cannot be changed.');
    }

    $api_ref->setChangedTime($this->time->getRequestTime());
    $api_ref->setNewRevision();
    $api_ref->setRevisionUserId($this->currentUser()->id());
    $api_ref->setRevisionCreationTime($this->time->getRequestTime());
    $api_ref->setRevisionLogMessage($this->t('Developer Portal Trigger - Field update: @field_name', [
      '@field_name' => $field_name,
    ]));

    $content = $request->getContent();

    $this->moduleHandler()
      ->alter('devportal_api_reference_field_content', $content, $api_ref, $field_name);

    $api_ref->set($field_name, $content);

    $this->moduleHandler()
      ->alter('devportal_api_reference_field', $api_ref, $request);

    $api_ref->save();

    return new Response('', Response::HTTP_ACCEPTED);
  }

}
