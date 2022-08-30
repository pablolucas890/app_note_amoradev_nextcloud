# Anotacoes
- Se você tiver mais de um repositório clonado, pode ser demorado fazer a mesma ação para todos os repositórios um por um. Para resolver isso, você pode usar o seguinte modelo de comando:

- Then create a skeleton app in the app store. This doesn’t publish anything on the appstore yet, it just gives you a download. <a href="https://apps.nextcloud.com/developer/apps/generate">link</a>

- Colocar nome pequeno no App

- Start Server

```bash
cd www/var/nextcloud
```
```bash
sudo php -S localhost:8080
```

- <a href="https://docs.nextcloud.com/server/latest/admin_manual/configuration_server/occ_command.html#using-the-occ-command">occ command</a>

<!--
SPDX-FileCopyrightText: Pablo Lucas Silva Santos <pablo@amoradev.com>
SPDX-License-Identifier: CC0-1.0
-->

# Amora Dev App Note NextCloud
Place this app in **nextcloud/apps/**

## Building the app

The app can be built by using the provided Makefile by running:

    make

This requires the following things to be present:
* make
* which
* tar: for building the archive
* curl: used if phpunit and composer are not installed to fetch them from the web
* npm: for building and testing everything JS, only required if a package.json is placed inside the **js/** folder

The make command will install or update Composer dependencies if a composer.json is present and also **npm run build** if a package.json is present in the **js/** folder. The npm **build** script should use local paths for build systems and package managers, so people that simply want to build the app won't need to install npm libraries globally, e.g.:

**package.json**:
```json
"scripts": {
    "test": "node node_modules/gulp-cli/bin/gulp.js karma",
    "prebuild": "npm install && node_modules/bower/bin/bower install && node_modules/bower/bin/bower update",
    "build": "node node_modules/gulp-cli/bin/gulp.js"
}
```


## Publish to App Store

First get an account for the [App Store](http://apps.nextcloud.com/) then run:

    make && make appstore

The archive is located in build/artifacts/appstore and can then be uploaded to the App Store.

## Running tests
You can use the provided Makefile to run all tests by using:

    make test

This will run the PHP unit and integration tests and if a package.json is present in the **js/** folder will execute **npm run test**

Of course you can also install [PHPUnit](http://phpunit.de/getting-started.html) and use the configurations directly:

    phpunit -c phpunit.xml

or:

    phpunit -c phpunit.integration.xml

for integration tests
