<?php

declare(strict_types = 1);

namespace Drupal\devportal_api_reference\Plugin;

use Drupal\devportal_api_reference\Exception\RuntimeException;

/**
 * Exception for OpenApi validation errors.
 */
class OpenApiValidationException extends RuntimeException {

  /**
   * List of errors.
   *
   * @var string[]
   */
  protected $errors = [];

  /**
   * Returns the list of stored errors.
   *
   * @return array
   *   Array of validation errors.
   */
  public function getErrors(): array {
    return $this->errors;
  }

  /**
   * Sets the list of stored errors.
   *
   * @param array $errors
   *   Array of errors.
   *
   * @return self
   *   New self.
   */
  public function setErrors(array $errors): self {
    $this->errors = $errors;
    return $this;
  }

  /**
   * OpenApiValidationException constructor.
   *
   * @param string $message
   *   The Exception message to throw.
   * @param int $code
   *   The Exception code.
   * @param \Throwable|null $previous
   *   The previous throwable used for the exception chaining.
   * @param array $errors
   *   The list of errors.
   */
  public function __construct(string $message = '', int $code = 0, \Throwable $previous = NULL, array $errors = []) {
    parent::__construct($message, $code, $previous);
    $this->errors = $errors;
  }

  /**
   * Factory method that creates an instance from a list of validation errors.
   *
   * @param array $errors
   *   Array of validation errors.
   * @param \Throwable|null $previous
   *   The previous exception or NULL.
   *
   * @return self
   *   New OpenApiValidationException.
   */
  public static function fromErrors(array $errors, \Throwable $previous = NULL): self {
    return new self(implode(PHP_EOL, array_map(static function ($error) {
      $msg = '';

      if ($error['property']) {
        $msg .= " [{$error['property']}]";
      }

      $msg .= " {$error['message']}";

      return $msg;
    }, $errors)), 0, $previous, $errors);
  }

}
