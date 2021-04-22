<?php

declare(strict_types = 1);

namespace Drupal\Tests\dp_trigger\Functional;

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

use Behat\Mink\Driver\BrowserKitDriver;
use Drupal\Core\Url;
use Psr\Http\Message\ResponseInterface;

/**
 * Helper trait for trigger tests.
 */
trait TriggerTestTrait {

  /**
   * {@inheritdoc}
   *
   * @param string|null $url
   *   Session url.
   *
   * @return \Behat\Mink\Session
   *   Mink session.
   *
   * @see \Drupal\Tests\BrowserTestBase::getSession()
   */
  abstract public function getSession($url = NULL);

  /**
   * {@inheritdoc}
   *
   * @param string $message
   *   Failure message.
   *
   * @see \Drupal\Tests\BrowserTestBase::fail()
   */
  abstract public static function fail(string $message = '');

  /**
   * Asserts a request to the dp_trigger token endpoint.
   *
   * @param int $expected_code
   *   Expected HTTP status code.
   * @param string $token
   *   Trigger token.
   * @param string $body
   *   Request body.
   * @param array $extra_headers
   *   Additional headers.
   *
   * @return null|\Psr\Http\Message\ResponseInterface
   *   HTTP Response.
   */
  protected function assertRequest(int $expected_code, string $token, string $body, array $extra_headers = []): ?ResponseInterface {
    $url = Url::fromRoute('dp_trigger.tokens.trigger', [
      'entity' => $token,
    ]);

    return $this->assertRequestUrl($expected_code, $url, $body, $extra_headers);
  }

  /**
   * Asserts a request to a trigger endpoint.
   *
   * @param int $expected_code
   *   Expected HTTP status code.
   * @param \Drupal\Core\Url $url
   *   Trigger endpoint URL.
   * @param string $body
   *   Request body.
   * @param array $extra_headers
   *   Additional headers.
   *
   * @return null|\Psr\Http\Message\ResponseInterface
   *   HTTP Response.
   */
  protected function assertRequestUrl(int $expected_code, Url $url, string $body, array $extra_headers = []): ?ResponseInterface {
    $absolute_url = $url->setAbsolute(TRUE)->toString();
    $request_options = [
      'body' => $body,
      'headers' => $extra_headers + [
        'Content-Type' => 'application/yaml',
      ],
      'http_errors' => FALSE,
      'allow_redirects' => FALSE,
      'exceptions' => FALSE,
    ];
    $driver = $this->getSession()->getDriver();

    if ($driver instanceof BrowserKitDriver) {
      /** @var \Psr\Http\Message\ResponseInterface $response */
      $response = $driver->getClient()->getClient()
        ->request('POST', $absolute_url, $request_options);

      $this->assertEquals($expected_code, $response->getStatusCode());

      return $response;
    }

    $this->fail('Session driver is not a BrowserKitDriver');
    return NULL;
  }

}
