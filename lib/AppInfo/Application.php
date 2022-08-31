<?php
declare(strict_types=1);
// SPDX-FileCopyrightText: Pablo Lucas Silva Santos <pablo@amoradev.com>
// SPDX-License-Identifier: AGPL-3.0-or-later
// A classe Application é o principal ponto de entrada de um aplicativo. Essa classe é opcional,
// mas altamente recomendada se seu aplicativo precisar registrar algum serviço ou executar
// algum código para cada solicitação.
// O Nextcloud tentará carregar automaticamente a classe do namespace , como , onde MyApp
// seria o nome do seu aplicativo. O arquivo terá, portanto, a localização
// .\OCA\<App namespace>\AppInfo\Application\OCA\MyApp\AppInfo\Applicationmyapp/lib/AppInfo/Application.php

namespace OCA\AmoraDev\AppInfo;

use OCP\AppFramework\App;

class Application extends App {
	public const APP_ID = 'amoradev';

	public function __construct() {
		parent::__construct(self::APP_ID);
	}
}
