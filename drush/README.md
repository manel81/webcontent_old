# How to sync content between Amazee (Lagoon) environments

1. SSH into DESTINATION env (eg. master)

`$ lagoon ssh -p dp-example -e master`

2. Sync files from SOURCE (eg. accept)

`[dp-example]master@cli-drupal:/app$ drush rsync @accept:%files @self:/app/web/sites/default/files`

3. Sync database from SOURCE (eg. accept)

`[dp-example]master@cli-drupal:/app$ drush sql:sync @accept @self`

4. Optional: sanitize database to remove PII user data

`[dp-example]master@cli-drupal:/app$ drush sql:sanitize`
