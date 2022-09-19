<!--
SPDX-FileCopyrightText: Pablo Lucas Silva Santos <pablo@amoradev.com>
SPDX-License-Identifier: CC0-1.0
-->
<img src="gif.gif" width="800">

# Amora Dev App Note NextCloud

- Docs NextCloud Dev: https://docs.nextcloud.com/

- Create a skeleton app in the app store. This doesn’t publish anything on the appstore yet, it just gives you a download. <a href="https://apps.nextcloud.com/developer/apps/generate">link</a>

- Colocar nome pequeno no App

- O comando do Nextcloud<a href="https://docs.nextcloud.com/server/latest/admin_manual/configuration_server/occ_command.html#using-the-occ-command">occ</a>(origem do “ownCloud Console”) é a interface de linha de comando do Nextcloud. Você pode realizar muitas operações comuns de servidor com o occ, como instalar e atualizar o Nextcloud, gerenciar usuários, criptografia, senhas, configuração LDAP e muito mais.

## Development

- Install LAMP packages 

- Download nextcloud server

- Place this app in **nextcloud/apps/**

- Start Server:

```bash
cd www/var/nextcloud
sudo php -S localhost:8080
```
- O App foi desenvolvido com o Node versao 16.16.0 e Instalado com ``` nvm ```, ```nvm``` e um gerenciador de versao do node e para instala-lo basta seguir o passo a passo <a href="https://github.com/nvm-sh/nvm">clicando aqui</a>

- Apos instalar o nvm, basta instalar a versao 16.16.0 do node com o seguinte comando:

```
nvm install 16.16.0 && nvm use 16.16.0
```

- Voce pode verificar se a versao esta correta rodando:

```
node --version 
```
- Para rodar o projeto, primeiro deve-se baixar as dependencias com o seguinte comando:

```sh
npm install
```
- Buildar o App com o seguinte comando:
```
npm run build
```
- go to http://localhost:8080/index.php/apps/amoradev

- Run on NextCloud github: (Change webpack.modules.js)
```
amoradev: {
    main: path.join(__dirname, 'apps/amoradev/src', 'main.js'),
},
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
