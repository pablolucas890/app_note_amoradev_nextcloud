<?php
declare(strict_types=1);
// SPDX-FileCopyrightText: Pablo Lucas Silva Santos <pablo@amoradev.com>
// SPDX-License-Identifier: AGPL-3.0-or-later

namespace OCA\AmoraDev\AppInfo;

use OCP\AppFramework\App;

class Application extends App {
	public const APP_ID = 'amoradev';

	public function __construct() {
		parent::__construct(self::APP_ID);
	}
}
