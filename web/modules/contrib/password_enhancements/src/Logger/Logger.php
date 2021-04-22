<?php

declare(strict_types = 1);

namespace Drupal\password_enhancements\Logger;

/**
 * Copyright (C) 2020 PRONOVIX GROUP BVBA.
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

use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Drupal\Core\Logger\RfcLoggerTrait;
use Drupal\Core\Utility\Error;
use Psr\Log\LoggerInterface;

/**
 * Defines module specific logger.
 */
final class Logger implements LoggerInterface {

  use RfcLoggerTrait;

  /**
   * Logger channel.
   *
   * @var \Drupal\Core\Logger\LoggerChannelInterface
   */
  private $loggerChannel;

  /**
   * Constructs a new logger service.
   *
   * @param \Drupal\Core\Logger\LoggerChannelFactoryInterface $logger_channel_factory
   *   Logger channel factory.
   */
  public function __construct(LoggerChannelFactoryInterface $logger_channel_factory) {
    $this->loggerChannel = $logger_channel_factory->get('password_enhancements');
  }

  /**
   * Logs exception.
   *
   * @param string $subject
   *   The subject of the exception.
   * @param \Exception $exception
   *   The exception that needs to be logged.
   */
  public function logException(string $subject, \Exception $exception): void {
    $this->error('@subject<br> <br>%type: @message in %function (line %line of %file).<pre>@backtrace_string</pre>', Error::decodeException($exception) + [
      '@subject' => $subject,
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function log($level, $message, array $context = []): void {
    $this->loggerChannel->log($level, $message, $context);
  }

}
