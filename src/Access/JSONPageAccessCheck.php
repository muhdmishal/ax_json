<?php

namespace Drupal\ax_json\Access;

use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

class JSONPageAccessCheck {

  /**
   * A custom access check.
   *
   *   Run access checks for this account.
   */
  public function access(AccountInterface $account, $api_key, $node) {

    $config = \Drupal::config('system.site');

    // Load the node to check if the type is page.
    $node = \Drupal::entityTypeManager()->getStorage('node')->load($node);

    if ($api_key == $config->get('siteapikey') && $node->bundle() == 'page') {
      return AccessResult::allowed();
    }

    return AccessResult::forbidden();

  }

}
