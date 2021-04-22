<?php

declare(strict_types = 1);

namespace Drupal\dp_trigger\EventSubscriber;

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

use Drupal\Core\EventSubscriber\HttpExceptionSubscriberBase;
use Drupal\Core\Routing\RouteMatchInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

/**
 * Handles default error responses in serialization formats.
 */
class DPTriggerHttpExceptionSubscriber extends HttpExceptionSubscriberBase {

  /**
   * The current route match service.
   *
   * @var \Drupal\Core\Routing\RouteMatchInterface
   */
  protected $routeMatch;

  /**
   * DPTriggerHttpExceptionSubscriber constructor.
   *
   * @param \Drupal\Core\Routing\RouteMatchInterface $route_match
   *   The current route match service.
   */
  public function __construct(RouteMatchInterface $route_match) {
    $this->routeMatch = $route_match;
  }

  /**
   * {@inheritdoc}
   */
  protected function getHandledFormats(): array {
    return ['html'];
  }

  /**
   * Handles 4xx HTTP exceptions thrown on the dp_trigger.tokens.trigger route.
   *
   * @param \Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent $event
   *   The event to process.
   *
   * @see \Drupal\dp_trigger\Controller\TriggerController::trigger()
   */
  public function on4xx(GetResponseForExceptionEvent $event): void {
    $this->handleEvent($event);
  }

  /**
   * Handles 5xx HTTP exceptions thrown on the dp_trigger.tokens.trigger route.
   *
   * @param \Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent $event
   *   The event to process.
   *
   * @see \Drupal\dp_trigger\Controller\TriggerController::trigger()
   */
  public function on5xx(GetResponseForExceptionEvent $event): void {
    $this->handleEvent($event);
  }

  /**
   * Helper function to handle 4xx and 5xx HTTP exceptions.
   *
   * @param \Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent $event
   *   The event to process.
   *
   * @see \Drupal\dp_trigger\Controller\TriggerController::trigger()
   */
  protected function handleEvent(GetResponseForExceptionEvent $event): void {
    // Handle only those 4xx and 5xx HTTP exceptions which where thrown on the
    // dp_trigger.tokens.trigger route.
    if ($this->routeMatch->getRouteName() === 'dp_trigger.tokens.trigger') {
      /** @var \Symfony\Component\HttpKernel\Exception\HttpExceptionInterface $exception */
      $exception = $event->getException();

      $content = (object) [
        'messages' => explode(
          "\n",
          $exception->getMessage()
        ),
      ];
      $headers = $exception->getHeaders();
      // Set a JSON encoded response message instead of HTML text.
      $response = new Response(json_encode($content), $exception->getStatusCode(), $headers);
      $event->setResponse($response);
    }
  }

}
