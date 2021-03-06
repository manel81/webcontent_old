<?php

declare(strict_types = 1);

namespace Drupal\devportal_api_reference\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Reference plugin annotation.
 *
 * @Annotation
 *
 * @see \Drupal\devportal_api_reference\Plugin\Reference\ReferenceBase
 */
class Reference extends Plugin {

  /**
   * Machine name.
   *
   * @var string
   */
  public $id;

  /**
   * Human-readable label.
   *
   * @var string
   */
  public $label;

  /**
   * List of extensions where this plugin should be used.
   *
   * @var string[]
   */
  public $extensions;

  /**
   * Priority of the plugin.
   *
   * @var int
   */
  public $weight;

}
