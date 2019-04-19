<?php

namespace Drupal\ax_json\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Controller to deliver the Json data.
 */
class JSONPageController extends ControllerBase {

  /**
   * Returns JSON data
   */
  public function content($api_key = NULL, NodeInterface $node) {

    $data = [
      'type' => $node->get('type')->target_id,
      'id' => $node->get('nid')->value,
      'attributes' => [
        'title' =>  $node->get('title')->value,
        'content' => $node->get('body')->value,
      ],
    ];

    return new JsonResponse($data);
  }

}
