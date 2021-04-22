<?php

// @codingStandardsIgnoreFile

/**
 * Lagoon specific settings and overrides.
 */

if (getenv('LAGOON')) {
  // Database connection.
  $databases['default']['default'] = [
    'driver' => 'mysql',
    'database' => getenv('MARIADB_DATABASE') ?: 'drupal',
    'username' => getenv('MARIADB_USERNAME') ?: 'drupal',
    'password' => getenv('MARIADB_PASSWORD') ?: 'drupal',
    'host' => getenv('MARIADB_HOST') ?: 'mariadb',
    'port' => 3306,
    'prefix' => '',
  ];

  // Redis connection.
  $settings['redis.connection']['interface'] = 'PhpRedis';
  $settings['redis.connection']['host'] = getenv('REDIS_HOST') ?: 'redis';
  $settings['redis.connection']['port'] = 6379;

  $settings['cache_prefix']['default'] = getenv('LAGOON_PROJECT') . '_' . getenv('LAGOON_GIT_SAFE_BRANCH');

  // Do not set the cache during installations of Drupal.
  if (!drupal_installation_attempted() && extension_loaded('redis')) {
    $settings['cache']['default'] = 'cache.backend.redis';

    // Include the default example.services.yml from the module, which will
    // replace all supported backend services (that currently includes the
    // cache tags checksum service and the lock backends, check the file for
    // the current list).
    $settings['container_yamls'][] = 'modules/contrib/redis/example.services.yml';

    // Allow the services to work before the Redis module itself is enabled.
    $settings['container_yamls'][] = 'modules/contrib/redis/redis.services.yml';

    // Manually add the classloader path, this is required for the container
    // cache bin definition below and allows to use it without the redis
    // module being enabled.
    $class_loader->addPsr4('Drupal\\redis\\', 'modules/contrib/redis/src');

    // Use redis for container cache.
    // The container cache is used to load the container definition itself, and
    // thus any configuration stored in the container itself is not available
    // yet. These lines force the container cache to use Redis rather than the
    // default SQL cache.
    $settings['bootstrap_container_definition'] = [
      'parameters' => [],
      'services' => [
        'redis.factory' => [
          'class' => 'Drupal\redis\ClientFactory',
        ],
        'cache.backend.redis' => [
          'class' => 'Drupal\redis\Cache\CacheBackendFactory',
          'arguments' => [
            '@redis.factory',
            '@cache_tags_provider.container',
            '@serialization.phpserialize',
          ],
        ],
        'cache.container' => [
          'class' => '\Drupal\redis\Cache\PhpRedis',
          'factory' => ['@cache.backend.redis', 'get'],
          'arguments' => ['container'],
        ],
        'cache_tags_provider.container' => [
          'class' => 'Drupal\redis\Cache\RedisCacheTagsChecksum',
          'arguments' => ['@redis.factory'],
        ],
        'serialization.phpserialize' => [
          'class' => 'Drupal\Component\Serialization\PhpSerialize',
        ],
      ],
    ];
  }

  // Various other tweaks.
  $settings['reverse_proxy'] = TRUE;
  $settings['file_private_path'] = 'sites/default/files/private';

  // Use auto-generated-during-deploy hash_salt file if possible - otherwise
  // throw error.
  $hash_salt_file = '/app/web/sites/default/files/private/donotcopy/hash_salt.txt';
  if ((file_exists($hash_salt_file)) && (filesize($hash_salt_file) === 128)) {
    $settings['hash_salt'] = file_get_contents($hash_salt_file);
  }
  else {
    throw new \RuntimeException(sprintf('Hash salt file "%s" not readable or incorrect size.', $hash_salt_file));
  }

  // Trusted Host Patterns, see https://www.drupal.org/node/2410395 for more
  // information.
  // If your site runs on multiple domains, you need to add these domains
  // here.
  if (getenv('LAGOON_ROUTES')) {
    $settings['trusted_host_patterns'] = [
      // Escape dots, remove schema, use commas as regex separator.
      '^' . str_replace(['.', 'https://', 'http://', ','], ['\.', '', '', '|'], getenv('LAGOON_ROUTES')) . '$',
    ];
  }

  // Lagoon Solr connection.
  // WARNING: you have to create a search_api server having "solr" machine
  // name at /admin/config/search/search-api/add-server to make this work.
  //   $config['search_api.server.solr']['backend_config']['connector_config']['host'] = getenv('SOLR_HOST') ?: 'solr';
  //   $config['search_api.server.solr']['backend_config']['connector_config']['path'] = '/solr/';
  //   $config['search_api.server.solr']['backend_config']['connector_config']['core'] = getenv('SOLR_CORE') ?: 'drupal';
  //   $config['search_api.server.solr']['backend_config']['connector_config']['port'] = 8983;
  //   $config['search_api.server.solr']['backend_config']['connector_config']['http_user'] = getenv('SOLR_USER') ?: '';
  //   $config['search_api.server.solr']['backend_config']['connector_config']['http']['http_user'] = getenv('SOLR_USER') ?: '';
  //   $config['search_api.server.solr']['backend_config']['connector_config']['http_pass'] = getenv('SOLR_PASSWORD') ?: '';
  //   $config['search_api.server.solr']['backend_config']['connector_config']['http']['http_pass'] = getenv('SOLR_PASSWORD') ?: '';
  //   $config['search_api.server.solr']['name'] = 'Lagoon Solr - Environment: ' . getenv('LAGOON_PROJECT');

  // Overrides for all Lagoon environments.
  if (file_exists(__DIR__ . '/lagoon.all.settings.php')) {
    include __DIR__ . '/lagoon.all.settings.php';
  }
  if (file_exists(__DIR__ . '/lagoon.all.services.yml')) {
    $settings['container_yamls'][] = __DIR__ . '/lagoon.all.services.yml';
  }

  // Lagoon environment-type specific settings and services.
  $lagoon_env_type = getenv('LAGOON_ENVIRONMENT_TYPE');
  if($lagoon_env_type){
    // Examples: lagoon.env_type.production.settings.php,
    // lagoon.env_type.development.settings.php, etc.
    if (file_exists(__DIR__ . '/lagoon.env_type.' . $lagoon_env_type . '.settings.php')) {
      include __DIR__ . '/lagoon.env_type.' . $lagoon_env_type . '.settings.php';
    }
    // Examples: lagoon.env_type.production.services.yml,
    // lagoon.env_type.development.services.yml, etc.
    if (file_exists(__DIR__ . '/lagoon.env_type.' . $lagoon_env_type . '.services.yml')) {
      $settings['container_yamls'][] = __DIR__ . '/lagoon.env_type.' . $lagoon_env_type . '.services.yml';
    }
  }

  // Lagoon environment-name specific settings and services.
  $lagoon_env = getenv('LAGOON_ENVIRONMENT');
  if ($lagoon_env) {
    // Examples: lagoon.env.production.settings.php,
    // lagoon.env.accept.settings.php, etc.
    if (file_exists(__DIR__ . '/lagoon.env.' . $lagoon_env . '.settings.php')) {
      include __DIR__ . '/lagoon.env.' . $lagoon_env . '.settings.php';
    }
    // Examples: lagoon.env.production.services.yml,
    // lagoon.env.accept.services.yml, etc.
    if (file_exists(__DIR__ . '/lagoon.env.' . $lagoon_env . '.services.yml')) {
      $settings['container_yamls'][] = __DIR__ . '/lagoon.env.' . $lagoon_env . '.services.yml';
    }
  }

  // Include environment-specific keys.
  if (file_exists('/app/web/sites/default/files/private/donotcopy/keys/include.php')) {
    require '/app/web/sites/default/files/private/donotcopy/keys/include.php';
  }
}
