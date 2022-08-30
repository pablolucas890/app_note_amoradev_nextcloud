<?php
declare(strict_types=1);
// SPDX-FileCopyrightText: Pablo Lucas Silva Santos <pablo@amoradev.com>
// SPDX-License-Identifier: AGPL-3.0-or-later

namespace OCA\AmoraDev\Controller;

use Closure;

use OCP\AppFramework\Http;
use OCP\AppFramework\Http\DataResponse;

use OCA\AmoraDev\Service\NotFoundException;

trait Errors {

    protected function handleNotFound (Closure $callback) {
        try {
            return new DataResponse($callback());
        } catch(NotFoundException $e) {
            $message = ['message' => $e->getMessage()];
            return new DataResponse($message, Http::STATUS_NOT_FOUND);
        }
    }

}