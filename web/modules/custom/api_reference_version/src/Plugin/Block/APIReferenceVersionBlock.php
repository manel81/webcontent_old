<?php

declare(strict_types = 1);

/**
 * Copyright (C) 2020 PRONOVIX GROUP BVBA.
 *
 *  This program is free software; you can redistribute it and/or
 *  modify it under the terms of the GNU General Public License
 *  as published by the Free Software Foundation; either version 2
 *  of the License, or (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program; if not, write to the Free Software
 *  Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301,
 *  USA.
 */

namespace Drupal\api_reference_version\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\Cache;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\api_reference_version\Form\APIReferenceVersionForm;
use Drupal\node\NodeInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides an 'API Product Version' block.
 *
 * @Block(
 *   id = "api_reference_version_block",
 *   admin_label = @Translation("API Reference Version"),
 *   category = @Translation("API Reference"),
 *   context_definitions = {
 *     "node" = @ContextDefinition("entity:node"),
 *   }
 * )
 */
final class APIReferenceVersionBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Current route match.
   *
   * @var \Drupal\Core\Routing\RouteMatchInterface
   */
  protected $routeMatch;

  /**
   * Form builder service.
   *
   * @var \Drupal\Core\Form\FormBuilderInterface
   */
  protected $formBuilder;

  /**
   * Creates a new APIReferenceVersionBlock instance.
   *
   * @param array $configuration
   *   Configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   Plugin_id for the plugin instance.
   * @param array $plugin_definition
   *   Plugin implementation definition.
   * @param \Drupal\Core\Routing\RouteMatchInterface $route_match
   *   Current route match interface.
   * @param \Drupal\Core\Form\FormBuilderInterface $formBuilder
   *   Form builder interface.
   */
  public function __construct(array $configuration, string $plugin_id, array $plugin_definition, RouteMatchInterface $route_match, FormBuilderInterface $formBuilder) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->routeMatch = $route_match;
    $this->formBuilder = $formBuilder;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition): self {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('current_route_match'),
      $container->get('form_builder')
    );
  }

  /**
   * Grant access to the blocks based on the node type.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   Currently logged in account.
   *
   * @return \Drupal\Core\Access\AccessResult
   *   Access result.
   */
  protected function blockAccess(AccountInterface $account): AccessResult {
    $node = $this->routeMatch->getParameter('node');
    // Sanity check to make sure it is an actual node.
    if ($node instanceof NodeInterface) {
      // Check if the current node has a reference to an API reference content,
      // and use the referenced node as the current one.
      if ($node->bundle() !== 'api_reference' && $node->hasField('field_api_reference')) {
        $node = $node->get('field_api_reference')->entity;
      }

      // Check if the current reference is an actual node and has the required
      // fields for the version selector.
      if ($node instanceof NodeInterface && $node->hasField('field_api_name') && $node->hasField('field_version')) {
        return AccessResult::allowedIf(!$node->get('field_api_name')->isEmpty() && !$node->get('field_version')->isEmpty());
      }
    }

    // In any other case forbid the access.
    return AccessResult::forbidden();
  }

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    return $this->formBuilder->getForm(APIReferenceVersionForm::class, $this->routeMatch->getParameter('node'));
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheContexts(): array {
    return Cache::mergeContexts(parent::getCacheContexts(), ['route']);
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheTags(): array {
    return Cache::mergeTags(parent::getCacheTags(), ['node_list']);
  }

}
