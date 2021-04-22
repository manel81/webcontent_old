<?php

declare(strict_types = 1);

/**
 * Copyright (C) 2020 PRONOVIX GROUP BVBA.
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

namespace Drupal\api_content_trigger\Controller;

use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Entity\EntityStorageException;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\api_content_trigger\Controller\Exception\TriggerControllerException;
use Drupal\node\NodeInterface;
use Drupal\node\NodeStorageInterface;
use Drupal\node\NodeTypeInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Provides trigger callback for ingesting markdown files for specific CTs.
 */
final class TriggerController implements ContainerInjectionInterface {

  /**
   * Node storage.
   *
   * @var \Drupal\node\NodeStorageInterface
   */
  private $nodeStorage;

  /**
   * Paragraph storage.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  private $paragraphStorage;

  /**
   * TriggerController constructor.
   *
   * @param \Drupal\node\NodeStorageInterface $node_storage
   *   Node storage.
   * @param \Drupal\Core\Entity\EntityStorageInterface $paragraph_storage
   *   Paragraph storage.
   */
  public function __construct(NodeStorageInterface $node_storage, EntityStorageInterface $paragraph_storage) {
    $this->nodeStorage = $node_storage;
    $this->paragraphStorage = $paragraph_storage;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container): self {
    $entity_type_manager = $container->get('entity_type.manager');
    return new static(
      $entity_type_manager->getStorage('node'),
      $entity_type_manager->getStorage('paragraph')
    );
  }

  /**
   * Trigger ingestion of the sent markdown file.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   The current request.
   * @param \Drupal\node\NodeTypeInterface $node_type
   *   The node type for which the file needs to be uploaded.
   *
   * @return \Symfony\Component\HttpFoundation\Response
   *   The response.
   */
  public function trigger(Request $request, NodeTypeInterface $node_type): Response {
    try {
      $this->validateRequest($request);
    }
    catch (TriggerControllerException $e) {
      return $this->createStatusResponse($e->getMessage(), $e->getCode());
    }

    /** @var \Drupal\node\NodeInterface $node */
    $bundle = $node_type->id();
    $node = $this->nodeStorage->create([
      'title' => $request->query->get('title'),
      'type' => $bundle,
      'field_api_reference' => $this->loadReferencedNode($request->query->get('api_name'), $request->query->get('version'))->id(),
      'status' => NodeInterface::NOT_PUBLISHED,
    ]);

    try {
      switch ($bundle) {
        case 'api_basic_page':
          $node->set('body', [
            'value' => $request->getContent(),
            'format' => 'github_flavored_markdown',
          ]);
          break;

        case 'api_description_page':
          /** @var \Drupal\paragraphs\Entity\Paragraph $text */
          $text = $this->paragraphStorage->create([
            'type' => 'text',
            'field_text' => [
              'value' => $request->getContent(),
              'format' => 'github_flavored_markdown',
            ],
          ]);
          $text->save();

          /** @var \Drupal\paragraphs\Entity\Paragraph $grid */
          $grid = $this->paragraphStorage->create([
            'type' => 'grid',
            'field_grid_layout' => 'one-column',
            'field_grid_elements' => [
              'target_id' => $text->id(),
              'target_revision_id' => $text->getRevisionId(),
            ],
          ]);
          $grid->save();

          $node->set('field_page_builder_elements', [
            'target_id' => $grid->id(),
            'target_revision_id' => $grid->getRevisionId(),
          ]);
          break;

        default:
          return $this->createStatusResponse('Unsupported node content type.', 400);
      }

      $node->save();
    }
    catch (EntityStorageException $e) {
      return $this->createStatusResponse('Failed to create content.', 500);
    }

    return $this->createStatusResponse('Content successfully created.');
  }

  /**
   * Validates the exception.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   The current request.
   */
  private function validateRequest(Request $request): void {
    // phpcs:ignore Squiz.Arrays.ArrayDeclaration.CommaAfterLast, Drupal.WhiteSpace.CloseBracketSpacing.ClosingWhitespace
    [$content_type, ] = explode(';', $request->headers->get('Content-Type'));
    if (trim($content_type) !== 'text/markdown') {
      throw new TriggerControllerException('Invalid Content-Type, it must be text/markdown.', 406);
    }

    if (empty($request->query->get('title'))) {
      throw new TriggerControllerException('Missing title.', 400);
    }

    if (empty($request->getContent())) {
      throw new TriggerControllerException('Missing content file.', 400);
    }

    $api_name = $request->query->get('api_name');
    if (empty($api_name)) {
      throw new TriggerControllerException('Missing api_name.', 400);
    }

    $version = $request->query->get('version');
    if (empty($version)) {
      throw new TriggerControllerException('Missing version.', 400);
    }

    if ($this->loadReferencedNode($api_name, $version) === NULL) {
      throw new TriggerControllerException(strtr('API reference with the name of ":name" with ":version" version is not found.', [
        ':name' => $api_name,
        ':version' => $version,
      ]), 404);
    }
  }

  /**
   * Loads the referenced node by the API name and version.
   *
   * @param string $api_name
   *   The name of the API.
   * @param string $version
   *   The version of the API.
   *
   * @return \Drupal\node\NodeInterface|null
   *   The loaded referenced node or NULL if not found.
   */
  private function loadReferencedNode(string $api_name, string $version): ?NodeInterface {
    /** @var \Drupal\node\NodeInterface[] $nodes */
    $nodes = $this->nodeStorage->loadByProperties([
      'title' => $api_name,
      'type' => 'api_reference',
      'field_version' => $version,
    ]);
    return !empty($nodes) ? reset($nodes) : NULL;
  }

  /**
   * Creates a status JSON response.
   *
   * @param string $message
   *   The status message.
   * @param int $code
   *   The status code.
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   *   The initialized JSON response.
   */
  private function createStatusResponse(string $message, int $code = 200): JsonResponse {
    return new JsonResponse([
      'status' => $code < 300 ? 'success' : 'error',
      'message' => $message,
    ], $code);
  }

}
