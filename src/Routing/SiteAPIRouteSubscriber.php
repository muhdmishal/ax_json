<?php

namespace Drupal\ax_json\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic route events.
 */
class SiteAPIRouteSubscriber extends RouteSubscriberBase
{
  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection)
  {
    if($route = $collection->get('system.site_information_settings'))
    {
      $route->setDefault('_form', 'Drupal\ax_json\Form\SiteAPISiteInformationForm');
    }
  }
}
