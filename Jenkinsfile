#!groovy

@Library("pipelinelib") _

import com.pronovix.Utils

def BOT_CHANNEL = '#project_allianz_bot'
def MAIN_CHANNEL = '#project_allianz'

utils = new Utils()
def reponame = (env.JOB_NAME.tokenize('/') as String[])[0]
def nameparts = reponame.tokenize('-')
def technology = nameparts[0]
def category = nameparts[1]
def projectname = nameparts[2]
def projectsuffix = utils.generatorAlphaNumeric(4)
def sitename = ""
def testsite = ""
def dbname = ""
def dbpass = utils.generatorAlphaNumeric(16)
def projectid = "${technology}-${category}-${projectname}"
def timeStamp = Calendar.getInstance().getTime().format('yyyyMMdd-HHmmss',TimeZone.getTimeZone('CET'))

// For Amazee-hosted sites, set: def hosting = "lagoon"
def hosting = "lagoon"
// Set "de" for AWS:Frankfurt - or "ch" for others (CH:Cloudscale and AWS:US)
def lagooninstance = "ch"

if (BRANCH_NAME == "master") {
    sitename = "${projectname}.${category}.devportal.io"
    testsite = "${projectname}.test.devportal.io"
    dbname = "${technology}_${category}_${projectname}"
} else if (BRANCH_NAME ==~ /^env\/.*/) {
    def envname = "$BRANCH_NAME".split('/')[1]
    sitename = "${envname}--${projectname}.${category}.devportal.io"
    testsite = "${envname}--${projectname}.test.devportal.io"
    dbname = "${technology}_${category}_${projectname}_${envname}"
}

def docroot = "/var/www/${technology}-${category}/$sitename"
def backstoproot = "/var/www/${technology}-test/$testsite/backstop"
def backstopref
def files_dir = "$docroot/web/sites/default/files"
def settings_local_php = "$docroot/web/sites/default/settings.local.php"
def oidc_test_client = "/usr/local/openresty/nginx/conf/oidc/client_id_${testsite}"

pipeline {
    agent { label 'master' }

    parameters {
        booleanParam(name: 'LagoonDeploy', defaultValue: true, description: 'Trigger deployment on Amazee (after sync)?')
        booleanParam(name: 'LocalTests', defaultValue: true, description: 'Run tests?')
        booleanParam(name: 'LocalDeploy', defaultValue: true, description: 'Deploy Local site (after sync)?')
        booleanParam(name: 'CodeDrop', defaultValue: false, description: 'Prepare code drop?')
    }

    options {
        timestamps()
        disableConcurrentBuilds()
        disableResume()
        timeout(time: 110, unit: 'MINUTES')
    }

    environment {
        PHP_XDEBUG = "0"
        PHP_XDEBUG_DEFAULT_ENABLE = "0"
        COMPOSE_PROJECT_NAME = "$projectname" + "_" + "$projectsuffix"
        COMPOSE_HTTP_TIMEOUT = "600"
        COMPOSE_INTERACTIVE_NO_CLI = "1"
        GITHUB_ACCESS_TOKEN = credentials('githubAccessToken')
        COMPOSER_AUTH = """{
            "github-oauth": {
                "github.com": "${GITHUB_ACCESS_TOKEN}"
            }
        }"""
        GIT_COMMIT_AUTHOR = sh (
            script: 'git --no-pager show -s --format=%ae | cut -d@ -f1',
            returnStdout: true
        ).trim()
        GIT_COMMIT_SUBJECT = sh (
            script: 'git --no-pager show -s --format=%s',
            returnStdout: true
        ).trim()
    }

    stages {
        stage('Gerrit message') {
            when { changeRequest() }
            steps {
                gerritReview message: "Starting build: ${env.RUN_DISPLAY_URL}"
            }
        }
        stage('Slack notification') {
            steps {
                slackSend channel: BOT_CHANNEL, color: 'good', message: "```${GIT_COMMIT_SUBJECT}```\n<${env.RUN_DISPLAY_URL}|Build> `${env.BRANCH_NAME}` by `${GIT_COMMIT_AUTHOR}` started per ${currentBuild.buildCauses.shortDescription}."
            }
        }
        stage('Git checkout') {
            steps {
                git branch: BRANCH_NAME, url: "ssh://ci@localhost:29418/${reponame}"
            }
        }
        stage('Ensure git tag') {
            when {
                anyOf {
                    branch 'accept'
                    branch 'preprod'
                    branch 'production'
                }
            }
            steps {
                script {
                    sh """
                    git describe --exact-match HEAD
                    """
                }
            }
            post {
                unsuccessful {
                    slackSend channel: MAIN_CHANNEL, color: 'danger', message: "<${env.RUN_DISPLAY_URL}|Build> `${env.BRANCH_NAME}` by `${GIT_COMMIT_AUTHOR}` failed because a git tag is required.\nPlease add one, for example:\n```STAG=2020-01-01.0 && git tag -sm \$STAG \$STAG && git push --tags```"
                }
            }
        }
        stage('Trigger lagoon deploy') {
            when {
                expression { "${hosting}" == "lagoon" && params.LagoonDeploy}
                anyOf {
                    branch 'test'
                    branch 'master'
                    branch 'accept'
                    branch 'preprod'
                }
            }
            steps {
                sshagent (credentials: ['lagoon']) {
                    sh """
                    lagoon -l ${lagooninstance} login
                    lagoon -l ${lagooninstance} --force deploy branch -p ${technology}-${projectname} -b ${env.BRANCH_NAME}
                    """
                }
            }
            post {
                unsuccessful {
                    slackSend channel: MAIN_CHANNEL, color: 'danger', message: "<${env.RUN_DISPLAY_URL}|Build> `${env.BRANCH_NAME}` by `${GIT_COMMIT_AUTHOR}` lagoon deploy trigger failed."
                }
            }
        }
        stage('Local build') {
            when {
                expression { params.LocalTests || params.LocalDeploy }
                anyOf {
                    changeRequest()
                    expression { BRANCH_NAME ==~ /^env\/.*/ }
                    branch 'master'
                }
            }
            stages {
                stage('Visual reference') {
                    when {
                        expression { utils.pathExists(settings_local_php) && fileExists("backstop.json") }
                    }
                    steps {
                        script {
                            sh """
                                sudo rm -rf ${backstoproot} || true
                                mkdir -p ${backstoproot}
                                rsync -av backstop* ${backstoproot}/
                            """
                        }
                        dir(backstoproot) {
                            sh """
                                sed -i 's/foobar.site.devportal.io/${sitename}/g' backstop.json
                                docker run --rm --net=host --add-host ${sitename}:127.0.0.1 -v \$(pwd):/src backstopjs/backstopjs reference
                                sudo chown -R jenkins.jenkins build
                            """
                        }
                        script {
                            backstopref="done"
                        }
                    }
                }
                stage('Container') {
                    steps {
                        script {
                            sh """
                                rm -rf drupal-dev build docker-compose.yml Dockerfile .env tools
                                git clone https://github.com/Pronovix/docker-drupal-dev.git drupal-dev
                                mkdir -p build web
                                ln -s drupal-dev/docker-compose.yml
                                ln -s drupal-dev/Dockerfile
                                docker-compose up --build -d
                                cd build
                                if test -f "../.unicompilerc.json"; then
                                    ln -s ../.unicompilerc.json
                                fi
                                cp ../composer.json .
                                cp ../composer.lock .
                                cp -a ../web .
                                cp -a ../config .
                                [ -d ../patches ] && cp -a ../patches .
                                cd ..
                                chmod -R 777 .
                                docker-compose exec -T php composer install --no-progress --no-suggest
                                docker-compose exec -T php composer drupal:scaffold
                                docker-compose exec -T php sh -c 'composer drupalqa:testrunner:download . --overwrite --no-progress && chmod +x testrunner'
                            """
                            utils.fixPermissions()
                        }
                    }
                    post {
                        unsuccessful {
                            slackSend channel: BOT_CHANNEL, color: 'danger', message: "<${env.RUN_DISPLAY_URL}|Build> `${env.BRANCH_NAME}` by `${GIT_COMMIT_AUTHOR}` container failed."
                        }
                    }
                }
                stage('Assets') {
                    when {
                        expression { fileExists '.unicompilerc.json' }
                    }
                    steps {
                        script {
                            utils.runUnicompile 'build'
                        }
                    }
                    post {
                        unsuccessful {
                            slackSend channel: BOT_CHANNEL, color: 'danger', message: "<${env.RUN_DISPLAY_URL}|Build> `${env.BRANCH_NAME}` by `${GIT_COMMIT_AUTHOR}` assets failed."
                        }
                    }
                }
            }
        }
        stage('Local tests') {
            when {
                expression { params.LocalTests }
                changeRequest()
            }
            parallel {
                stage('Code Analysis') {
                    when {
                        expression { utils.getCodeAnalysisPaths().length() > 0 }
                    }
                    steps {
                        script {
                            String analysisPaths = utils.getCodeAnalysisPaths();
                            sh "touch drupalcheckresult.json eslintresult.json phpcsresult.json && chmod 777 drupalcheckresult.json eslintresult.json phpcsresult.json"
                            utils.runCheck "docker-compose exec -T php sh -c './vendor/bin/phpcs -s phpcs.xml.dist --ignore=\"*.js, *.css\" --report=json --report-file=../phpcsresult.json ${analysisPaths}'"
                            utils.runCheck "docker-compose exec -T php sh -c './vendor/bin/drupal-check web/themes/custom/ web/modules/custom/ --format=json --no-progress > ../drupalcheckresult.json'"
                            utils.runESLint "web -f json -o /home/node/app/target/eslintresult.json"
                            sh '''
                                if [ ! -s eslintresult.json ]; then
                                    rm eslintresult.json
                                fi
                            '''
                        }
                    }
                    post {
                        always {
                            script {
                                if (fileExists("eslintresult.json")) {
                                    utils.processEslintResults("eslintresult.json", { String path ->
                                        return path.substring("/home/node/app/target/".length())
                                    })
                                }
                                utils.processPhpcsResults("phpcsresult.json", { String path ->
                                    return path.substring("/mnt/files/local_mount/build/".length())
                                })
                                utils.processPhpcsResults("drupalcheckresult.json", { String path ->
                                    return path.substring("/mnt/files/local_mount/build/".length())
                                })
                            }
                            sh 'rm -f drupalcheckresult.json eslintresult.json phpcsresult.json'
                        }
                        success {
                            gerritReview labels: ['Code-Analysis': 1]
                        }
                        unsuccessful {
                            gerritReview labels: ['Code-Analysis': -1]
                            slackSend channel: BOT_CHANNEL, color: 'danger', message: "<${env.RUN_DISPLAY_URL}|Build> `${env.BRANCH_NAME}` by `${GIT_COMMIT_AUTHOR}` code analysis failed."
                        }
                    }
                }
                stage('Automatic Verification') {
                    stages {
                        stage('phpunit') {
                            when { expression { utils.customComponentsExist('modules') } }
                            steps {
                                dir('build') {
                                    script {
                                        utils.fixPermissions()
                                        sh '''
                                            chmod -R 777 web/sites
                                            cp web/sites/default/default.settings.php web/sites/default/settings.php
                                            echo "include 'settings.local.php';" >> web/sites/default/settings.php
                                        '''
                                        writeFile file: 'web/sites/default/settings.local.php', text: '''<?php
                                            $databases['default']['default'] = [
                                              'database' => 'drupal',
                                              'username' => 'drupal',
                                              'password' => 'drupal',
                                              'prefix' => '',
                                              'host' => 'mariadb',
                                              'port' => '3306',
                                              'namespace' => 'Drupal\\\\Core\\\\Database\\\\Driver\\\\mysql',
                                              'driver' => 'mysql',
                                            ];
                                            $config_directories['sync'] = '../config/sync';
                                        '''
                                    }
                                }
                                sh """
                                    docker-compose exec -T php sh -c "find web/*/custom -name '*Test.php' -print0 | ./testrunner -verbose -threads=24 -root='-' -command='./vendor/bin/phpunit -c web/core -v --debug --printer \\Drupal\\Tests\\Listeners\\HtmlOutputPrinter'"
                                """
                            }
                            post {
                                always {
                                    script {
                                        utils.fixPermissions()
                                        // Remove test settings.local.php
                                        sh 'rm -f web/sites/default/settings.local.php'
                                    }
                                }
                            }
                        }
                    }
                    post {
                        success {
                            gerritReview labels: ['Automatic-Verification': 1]
                        }
                        unsuccessful {
                            gerritReview labels: ['Automatic-Verification': -1]
                            slackSend channel: BOT_CHANNEL, color: 'danger', message: "<${env.RUN_DISPLAY_URL}|Build> `${env.BRANCH_NAME}` by `${GIT_COMMIT_AUTHOR}` local tests failed."
                        }
                    }
                }
            }
        }
        stage('Local deploy') {
            when {
                expression { params.LocalDeploy || params.LocalSyncDB || params.LocalSyncFiles }
                anyOf {
                    expression { BRANCH_NAME ==~ /^env\/.*/ }
                    branch 'master'
                }
            }
            stages {
                stage ('OIDC main') {
                    when {
                        expression { !utils.pathExists(settings_local_php) }
                    }
                    steps {
                        sh "/usr/local/src/infra/scripts/oidc_register_client.sh '$sitename'"
                    }
                }
                stage ('OIDC test') {
                    when {
                        expression { !utils.pathExists(oidc_test_client) && fileExists("backstop.json") }
                    }
                    steps {
                        sh "/usr/local/src/infra/scripts/oidc_register_client.sh '$testsite'"
                    }
                }
                stage ('Backup site') {
                    when {
                        expression { utils.pathExists(settings_local_php) }
                    }
                    steps {
                        dir (docroot) {
                            sh './vendor/bin/drush -y sset system.maintenance_mode 1'
                            sh 'echo "Exit code:" $?'
                            sh "./vendor/bin/drush sql-dump | gzip > /mnt/enc-storage/jenkins/${sitename}_`date +%Y%m%d-%H%M%S`.sql.gz"
                        }
                    }
                }
                stage('Copy files') {
                    steps {
                        dir ('build') {
                            sh "rsync -av --delete --exclude web/sites/default/files --exclude web/sites/default/settings.local.php `ls -A1 | grep -vE '(build|.git)'` $docroot/"
                        }
                    }
                }
                stage('Ensure database') {
                    when {
                        expression { !utils.pathExists(settings_local_php) }
                    }
                    stages {
                        stage('Create database') {
                            steps {
                                dir (docroot) {
                                    sh "echo 'CREATE DATABASE $dbname; CREATE USER $dbname@localhost IDENTIFIED BY \"$dbpass\"; GRANT ALL PRIVILEGES ON $dbname.* TO $dbname@localhost;' | mysql -u jenkins"
                                    script {
                                        def hash_salt = sh script: './vendor/bin/drush ev \'print Drupal\\Component\\Utility\\Crypt::randomBytesBase64(55);\'', returnStdout: true
                                        writeFile file: settings_local_php, text: """<?php

                                            \$databases['default']['default'] = [
                                              'database' => '$dbname',
                                              'username' => '$dbname',
                                              'password' => '$dbpass',
                                              'prefix' => '',
                                              'host' => 'localhost',
                                              'port' => '3306',
                                              'namespace' => 'Drupal\\\\Core\\\\Database\\\\Driver\\\\mysql',
                                              'driver' => 'mysql',
                                            ];

                                            \$settings['hash_salt'] = '$hash_salt';

                                            \$config_directories['sync'] = '../config/sync';
                                        """
                                    }
                                }
                            }
                        }
                        stage('Install site') {
                            when {
                                expression { not BRANCH_NAME ==~ /\/db$/ }
                            }
                            steps {
                                dir (docroot) {
                                    sh './vendor/bin/drush si -y config_installer'
                                    sh 'echo "Exit code:" $?'
                                }
                            }
                        }
                        stage('Copy prod db') {
                            when {
                                expression { BRANCH_NAME ==~ /\/db$/ }
                            }
                            steps {
                                sh 'sleep 1'
                            }
                        }
                    }
                }
                stage('Apply updates') {
                    steps {
                        dir (docroot) {
                            sh './vendor/bin/drush --version'
                            sh './vendor/bin/drush cache:rebuild'
                            sh 'echo "Exit code:" $?'
                            sh './vendor/bin/drush -y updatedb'
                            sh 'echo "Exit code:" $?'
                            sh './vendor/bin/drush -y config:import'
                            sh 'echo "Exit code:" $?'
                            sh './vendor/bin/drush -y sset system.maintenance_mode 0'
                            sh 'echo "Exit code:" $?'
                            sh "sudo /bin/chmod -R g+w $files_dir"
                            sh "sudo /bin/chown -R jenkins.www-data $files_dir"
                            sh './vendor/bin/drush cache:rebuild'
                            sh 'echo "Exit code:" $?'
                        }
                    }
                }
            }
            post {
                unsuccessful {
                    slackSend channel: BOT_CHANNEL, color: 'danger', message: "<${env.RUN_DISPLAY_URL}|Build> `${env.BRANCH_NAME}` by `${GIT_COMMIT_AUTHOR}` local deploy failed."
                }
            }
        }
        stage('Visual test') {
            when {
                expression { fileExists("backstop.json") && params.LocalTests && "${backstopref}" == 'done' }
                anyOf {
                    changeRequest()
                    branch 'master'
                    expression { BRANCH_NAME ==~ /^env\/.*/ }
                }
            }
            steps {
                catchError(buildResult: 'UNSTABLE', stageResult: 'FAILURE') {
                    dir(backstoproot) {
                        sh "docker run --rm --net=host --add-host ${sitename}:127.0.0.1 -v \$(pwd):/src backstopjs/backstopjs test"
                    }
                }
                dir(backstoproot) {
                    sh """
                        sudo chown -R jenkins.jenkins build
                        sed -i 's/ classname="document"//g' build/junit/backstop.xml
                    """
                    archiveArtifacts artifacts: 'build/html/*', fingerprint: true
                    junit 'build/junit/backstop.xml'
                    publishHTML ([
                        allowMissing: false,
                        alwaysLinkToLastBuild: false,
                        keepAll: true,
                        reportDir: 'build',
                        reportFiles: 'html/index.html',
                        reportName: "BackstopJS"
                    ])
                }
            }
            post {
                success {
                    slackSend channel: BOT_CHANNEL, color: 'good', message: "<${env.RUN_DISPLAY_URL}|Build> `${env.BRANCH_NAME}` by `${GIT_COMMIT_AUTHOR}` visual tests succeeded: ${testsite}"
                }
                unsuccessful {
                    slackSend channel: BOT_CHANNEL, color: 'danger', message: "<${env.RUN_DISPLAY_URL}|Build> `${env.BRANCH_NAME}` by `${GIT_COMMIT_AUTHOR}` visual tests failed: ${testsite}"
                    script {
                        if (BRANCH_NAME == "master") {
                            slackSend channel: MAIN_CHANNEL, color: 'danger', message: "<${env.RUN_DISPLAY_URL}|Build> `${env.BRANCH_NAME}` by `${GIT_COMMIT_AUTHOR}` visual tests failed: ${testsite}"
                        }
                    }
                }
            }
        }
        stage('Visual approve and retest') {
            when {
                expression { fileExists("backstop.json") && params.LocalApprove }
                anyOf {
                    changeRequest()
                    branch 'master'
                    expression { BRANCH_NAME ==~ /^env\/.*/ }
                }
            }
            steps {
                dir(backstoproot) {
                    sh """
                        docker run --rm --net=host --add-host ${sitename}:127.0.0.1 -v \$(pwd):/src backstopjs/backstopjs approve
                        docker run --rm --net=host --add-host ${sitename}:127.0.0.1 -v \$(pwd):/src backstopjs/backstopjs test
                        sudo chown -R jenkins.jenkins build
                        sed -i 's/ classname="document"//g' build/junit/backstop.xml
                    """
                    archiveArtifacts artifacts: 'build/html/*', fingerprint: true
                    junit 'build/junit/backstop.xml'
                    publishHTML ([
                        allowMissing: false,
                        alwaysLinkToLastBuild: false,
                        keepAll: true,
                        reportDir: 'build',
                        reportFiles: 'html/index.html',
                        reportName: "BackstopJS"
                    ])
                }
            }
            post {
                success {
                    slackSend channel: BOT_CHANNEL, color: 'good', message: "<${env.RUN_DISPLAY_URL}|Build> `${env.BRANCH_NAME}` by `${GIT_COMMIT_AUTHOR}` visual differences approved: ${testsite}"
                }
            }
        }
        stage('Prerelease') {
            when {
                expression { BRANCH_NAME ==~ /^release\/.*/ }
            }
            steps {
                sh 'sleep 1'
            }
        }
        stage('Release') {
            when {
                buildingTag()
            }
            steps {
                sh 'sleep 1'
            }
        }
        stage('Code drop') {
            when {
                expression { params.CodeDrop }
            }
            steps {
                script {
                    sh """
                        rm -rf /var/www/codedrop/${projectid}_${env.BRANCH_NAME}
                        git clone -b ${env.BRANCH_NAME} ssh://ci@localhost:29418/${projectid} /var/www/codedrop/${projectid}_${env.BRANCH_NAME}
                        cd /var/www/codedrop/${projectid}_${env.BRANCH_NAME}
                        git describe --exact-match HEAD > RELEASE
                        cat RELEASE
                        composer install --no-dev --no-progress --no-suggest
                        composer drupal:scaffold
                        docker pull pronovix/dp-unicompile:current
                        docker run --rm -u \$(id -u ${USER}):\$(id -g ${USER}) -v \$("pwd"):/home/node/app/target pronovix/dp-unicompile:current
                        cd /var/www/codedrop/
                        tar czf /var/www/code.devportal.io/${projectid}_${env.BRANCH_NAME}_${timeStamp}.tgz ${projectid}_${env.BRANCH_NAME}/
                        rm -rf ${projectid}_${env.BRANCH_NAME}
                        cd /var/www/code.devportal.io/
                        gpg --sign ${projectid}_${env.BRANCH_NAME}_${timeStamp}.tgz && rm ${projectid}_${env.BRANCH_NAME}_${timeStamp}.tgz
                        ln -sf ${projectid}_${env.BRANCH_NAME}_${timeStamp}.tgz.gpg ${projectid}_${env.BRANCH_NAME}_LATEST.tgz.gpg
                    """
                }
            }
            post {
                success {
                    slackSend channel: MAIN_CHANNEL, color: 'good', message: """
```New code drop is available:
https://code.devportal.io/${projectid}_${env.BRANCH_NAME}_${timeStamp}.tgz.gpg
https://code.devportal.io/${projectid}_${env.BRANCH_NAME}_LATEST.tgz.gpg```
                    """
                }
                unsuccessful {
                    slackSend channel: BOT_CHANNEL, color: 'danger', message: "<${env.RUN_DISPLAY_URL}|Build> `${env.BRANCH_NAME}` by `${GIT_COMMIT_AUTHOR}` code drop failed."
                }
            }
        }
    }
    post {
        always {
            script {
                utils.fixPermissions()
                sh 'docker-compose down --remove-orphans -v || true'
                sh 'docker volume rm $(docker volume ls -qf dangling=true) || exit 0'
            }
        }
        success {
            slackSend channel: BOT_CHANNEL, color: 'good', message: "<${env.RUN_DISPLAY_URL}|Build> `${env.BRANCH_NAME}` by `${GIT_COMMIT_AUTHOR}` succeeded."
        }
        unstable {
            slackSend channel: BOT_CHANNEL, color: 'warning', message: "<${env.RUN_DISPLAY_URL}|Build> `${env.BRANCH_NAME}` by `${GIT_COMMIT_AUTHOR}` unstable."
        }
        failure {
            slackSend channel: BOT_CHANNEL, color: 'danger', message: "<${env.RUN_DISPLAY_URL}|Build> `${env.BRANCH_NAME}` by `${GIT_COMMIT_AUTHOR}` failed."
        }
    }
}
