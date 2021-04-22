<?php

// @codingStandardsIgnoreFile

$databases = [];
$settings['hash_salt'] = '';

$config_directories['sync'] = '../config/sync';
$settings['container_yamls'][] = $app_root . '/' . $site_path . '/services.yml';
$settings['file_scan_ignore_directories'] = [
  'node_modules',
  'bower_components',
];

$settings['entity_update_batch_size'] = 50;
$settings['entity_update_backup'] = TRUE;

$settings['update_free_access'] = FALSE;

# Project specific settings and services for _ALL_ environments.
if (file_exists(__DIR__ . '/project.settings.php')) {
  include __DIR__ . '/project.settings.php';
}
if (file_exists(__DIR__ . '/project.services.yml')) {
  $settings['container_yamls'][] = __DIR__ . '/project.services.yml';
}

# Lagoon specific settings and services.
if (file_exists(__DIR__ . '/lagoon.settings.php')) {
  include __DIR__ . '/lagoon.settings.php';
}
if (file_exists(__DIR__ . '/lagoon.services.yml')) {
  $settings['container_yamls'][] = __DIR__ . '/lagoon.services.yml';
}

# Local environment settings and services.
if (file_exists(__DIR__ . '/settings.local.php')) {
  include __DIR__ . '/settings.local.php';
}
if (file_exists(__DIR__ . '/services.local.yml')) {
  $settings['container_yamls'][] = __DIR__ . '/services.local.yml';
}
