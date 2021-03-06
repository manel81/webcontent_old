<?php

declare(strict_types = 1);

namespace Drupal\devportal_api_reference;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\devportal_api_reference\Annotation\Reference;

/**
 * Manager for the reference handler plugins.
 */
class ReferenceTypeManager extends DefaultPluginManager {

  /**
   * {@inheritdoc}
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cacheBackend, ModuleHandlerInterface $module_handler) {
    parent::__construct(
      'Plugin/Reference',
      $namespaces,
      $module_handler,
      ReferenceInterface::class,
      Reference::class
    );

    $this->alterInfo('reference_info');
    $this->setCacheBackend($cacheBackend, 'reference_info_plugins');
  }

  /**
   * {@inheritdoc}
   */
  protected function findDefinitions(): array {
    $definitions = parent::findDefinitions();
    uasort($definitions, static function (array $def0, array $def1): int {
      return ($def0['weight'] ?? 0) <=> ($def1['weight'] ?? 0);
    });

    return $definitions;
  }

  /**
   * Returns possible instances for a given file based on its extension.
   *
   * @param string $filename
   *   Path of the API reference file.
   *
   * @return \Drupal\devportal_api_reference\ReferenceInterface[]
   *   Applicable instances for the given file.
   */
  public function getInstancesFor(string $filename): array {
    $definitions = $this->getDefinitions();
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    if (!$extension) {
      return [];
    }
    $instances = [];
    foreach ($definitions as $name => $definition) {
      $extensions = $definition['extensions'] ?? [];
      if (!in_array($extension, $extensions, TRUE)) {
        continue;
      }

      /** @var \Drupal\devportal_api_reference\ReferenceInterface $instance */
      $instance = $this->createInstance($name);
      $instances[] = $instance;
    }

    return $instances;
  }

  /**
   * Attempts to find the appropriate plugin for an API reference file.
   *
   * @param string $filename
   *   Path of the API reference file.
   *
   * @return \Drupal\devportal_api_reference\ReferenceInterface|null
   *   The found plugin's instance, or NULL if not found.
   */
  public function lookupPlugin(string $filename): ?ReferenceInterface {
    $instances = $this->getInstancesFor($filename);

    foreach ($instances as $instance) {
      if ($instance->parse($filename)) {
        return $instance;
      }
    }

    return NULL;
  }

}
