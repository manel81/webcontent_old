<?php

declare(strict_types = 1);

namespace Drupal\devportal_api_reference\Access;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Access\AccessResultInterface;
use Drupal\Core\Routing\Access\AccessInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\node\NodeInterface;

/**
 * Determines access based on API Reference related node bundles.
 */
final class APIRefBundleAccessCheck implements AccessInterface {

  /**
   * Provides the list of API Reference related node bundles.
   */
  public const DEVPORTAL_API_REFERENCE_BUNDLES = ['api_reference'];

  /**
   * Checks access based on API Reference related node bundles.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The currently logged in account.
   * @param \Drupal\node\NodeInterface $node
   *   The node object.
   *
   * @return \Drupal\Core\Access\AccessResultInterface
   *   A \Drupal\Core\Access\AccessInterface constant value.
   */
  public function access(AccountInterface $account, NodeInterface $node = NULL): AccessResultInterface {
    if (in_array($node->bundle(), self::DEVPORTAL_API_REFERENCE_BUNDLES, TRUE)) {
      return AccessResult::allowed();
    }
    // No opinion.
    return AccessResult::neutral();
  }

}
