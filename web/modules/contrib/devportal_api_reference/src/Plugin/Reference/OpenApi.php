<?php

declare(strict_types = 1);

namespace Drupal\devportal_api_reference\Plugin\Reference;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\devportal_api_reference\Exception\InvalidArgumentException;
use Drupal\devportal_api_reference\Exception\ParseException;
use Drupal\devportal_api_reference\Plugin\OpenApiValidationException;
use JsonSchema\Validator;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Yaml\Yaml;
use function DeepCopy\deep_copy;

/**
 * Base class for OpenAPI references.
 */
abstract class OpenApi extends ReferenceBase implements ContainerFactoryPluginInterface {

  /**
   * The cache backend.
   *
   * @var \Drupal\Core\Cache\CacheBackendInterface
   */
  protected $cache;

  /**
   * The logger.
   *
   * @var \Psr\Log\LoggerInterface
   */
  protected $logger;

  /**
   * Whether validation is enabled or not.
   *
   * @var bool
   */
  protected $enableValidation;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    /** @var \Drupal\Core\Cache\CacheBackendInterface $cache */
    $cache = $container->get('cache.apifiles');
    /** @var \Drupal\Core\Logger\LoggerChannelInterface $logger */
    $logger = $container->get('logger.channel.api_reference');
    /** @var \Drupal\Core\Config\ConfigFactoryInterface $configFactory */
    $configFactory = $container->get('config.factory');

    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $cache,
      $logger,
      $configFactory->get('devportal_api_reference.settings')->get('enable_validation')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, string $plugin_id, array $plugin_definition, CacheBackendInterface $cache, LoggerInterface $logger, bool $enableValidation = TRUE) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->cache = $cache;
    $this->logger = $logger;
    $this->enableValidation = $enableValidation;
  }

  /**
   * {@inheritdoc}
   */
  public function getVersion(?\stdClass $doc): ?string {
    if (!$doc) {
      return NULL;
    }

    return $doc->info->version ?? NULL;
  }

  /**
   * {@inheritdoc}
   */
  public function getTitle(?\stdClass $doc): ?string {
    if (!$doc) {
      return NULL;
    }

    return $doc->info->title ?? NULL;
  }

  /**
   * {@inheritdoc}
   */
  public function getDescription(?\stdClass $doc): ?string {
    if (!$doc) {
      return NULL;
    }

    return $doc->info->description ?? NULL;
  }

  /**
   * Path to the JSON schema file.
   *
   * @return string
   *   Path relative to Drupal.
   */
  abstract protected function getSchema(): string;

  /**
   * Checks if an OpenAPI file is valid.
   *
   * Normally, plugins should check the version in data structure. This
   * function is used to determine if the current plugin is applicable to be
   * used for a given file. Since different OpenAPI versions use the same
   * formats (YAML and JSON), this function is need to tell which one it is.
   *
   * @param object $data
   *   OpenAPI data structure.
   *
   * @return bool
   *   TRUE if valid.
   */
  abstract protected function isValid(\stdClass $data): bool;

  /**
   * Parses an OpenAPI file.
   *
   * @param string $file_path
   *   The file path.
   *
   * @return object|null
   *   The OpenAPI object or null.
   *
   * @throws \Exception
   * @throws \Drupal\devportal_api_reference\Exception\ParseException
   *   Thrown when the yaml or json file can not be parsed.
   * @throws \Drupal\devportal_api_reference\Exception\InvalidArgumentException
   *   Thrown when the source file extension is not yaml or json.
   */
  public function parse(string $file_path): ?\stdClass {
    $cid = $file_path . ':' . md5_file($file_path);
    $cached = $this->cache->get($cid);
    if ($cached) {
      if (($cached->data['plugin'] ?? NULL) === $this->getPluginId()) {
        return $cached->data['object'] ?? NULL;
      }
      return NULL;
    }

    if (!file_exists($file_path)) {
      $this->logger->warning("File doesn't exists: {$file_path}");
      return NULL;
    }

    $file_info = pathinfo($file_path);
    $file_ext = $file_info['extension'];

    $input = file_get_contents($file_path);
    // Remove the BOM from the beginning of the file, if present.
    $input = ltrim($input, chr(0xEF) . chr(0xBB) . chr(0xBF));
    if (($file_ext === 'yaml') || ($file_ext === 'yml')) {
      try {
        $openapi = Yaml::parse($input, Yaml::PARSE_OBJECT | Yaml::PARSE_OBJECT_FOR_MAP);
      }
      catch (ParseException $e) {
        throw ParseException::yamlParseError($file_path, $e->getMessage(), $e);
      }
    }
    elseif ($file_ext === 'json') {
      $openapi = json_decode($input, FALSE);
      if ($openapi === NULL) {
        throw ParseException::jsonParseError($file_path, json_last_error(), json_last_error_msg());
      }
    }
    else {
      throw new InvalidArgumentException("Unsupported source file extension: {$file_ext}. Please use YAML or JSON source.");
    }

    if (!$this->isValid($openapi)) {
      return NULL;
    }

    if ($this->enableValidation) {
      $this->validate($openapi);
    }

    $this->cache->set($cid, [
      'object' => $openapi,
      'plugin' => $this->getPluginId(),
    ]);

    return $openapi;
  }

  /**
   * {@inheritdoc}
   */
  public function validate(\stdClass $content): void {
    $validator = new Validator();
    $content = deep_copy($content);
    $this->fixPatterns('', $content);
    $validator->validate($content, (object) [
      '$ref' => 'file://' . ($_SERVER['DOCUMENT_ROOT'] ?: getcwd()) . '/' . $this->getSchema(),
    ]);
    if (!$validator->isValid()) {
      $errors = $validator->getErrors();
      throw OpenApiValidationException::fromErrors($errors);
    }
  }

  /**
   * Fixes values in the 'pattern' key in an OpenApi structure.
   *
   * @param string $key
   *   Key of the current value, empty string for root.
   * @param mixed $val
   *   Current value.
   */
  private function fixPatterns(string $key, &$val): void {
    if (is_object($val) || is_array($val)) {
      foreach ($val as $k => &$v) {
        $this->fixPatterns((string) $k, $v);
      }
    }
    elseif ($key === 'pattern') {
      $val = $this->fixRegex($val);
    }
  }

  /**
   * Fixes the regex so json-schema can validate it.
   *
   * Currently all it does is escape `/` that is not escaped and not the first
   * character of the regex.
   *
   * @param string $str
   *   Input regex string.
   *
   * @return string
   *   Fixed regex.
   */
  private function fixRegex(string $str): string {
    $output = '';

    $escaped = FALSE;
    for ($i = 0, $max = mb_strlen($str); $i < $max; $i++) {
      $char = $str[$i];
      if ($char === '/' && !$escaped && $i > 0) {
        $output .= '\\';
      }
      $escaped = $char === '\\';
      $output .= $char;
    }

    return $output;
  }

}
