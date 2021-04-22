<?php

declare(strict_types = 1);

namespace Drupal\devportal_api_reference\Plugin\Reference;

/**
 * Null reference.
 *
 * @Reference(
 *   id = "empty",
 *   label = @Translation("Dummy reference plugin"),
 *   extensions = {},
 *   weight = 1,
 * )
 */
class EmptyReference extends ReferenceBase {

  /**
   * {@inheritdoc}
   */
  public function getVersion(?\stdClass $doc): ?string {
    return NULL;
  }

  /**
   * {@inheritdoc}
   */
  public function parse(string $file_path): ?\stdClass {
    return NULL;
  }

  /**
   * {@inheritdoc}
   */
  public function validate(\stdClass $content): void {
  }

  /**
   * {@inheritdoc}
   */
  public function getTitle(?\stdClass $doc): ?string {
    return NULL;
  }

  /**
   * {@inheritdoc}
   */
  public function getDescription(?\stdClass $doc): ?string {
    return NULL;
  }

}
