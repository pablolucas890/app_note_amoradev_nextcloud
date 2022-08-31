<?php
declare(strict_types=1);
// SPDX-FileCopyrightText: Pablo Lucas Silva Santos <pablo@amoradev.com>
// SPDX-License-Identifier: AGPL-3.0-or-later

// Camada entre o Controllar e o Banco de Dados

namespace OCA\AmoraDev\Service;

use Exception;

use OCP\AppFramework\Db\DoesNotExistException;
use OCP\AppFramework\Db\MultipleObjectsReturnedException;

use OCA\AmoraDev\Db\Note;
use OCA\AmoraDev\Db\NoteMapper;

class NoteService {

    private $mapper;

	//Metodo Contrutor
    public function __construct(NoteMapper $mapper){
        $this->mapper = $mapper;
    }

	//Localiza todas as notas no banco de dados
    public function findAll(string $userId) {
        return $this->mapper->findAll($userId);
    }

	//Caso a nota nao exista no banco de dados
    private function handleException ($e) {
        if ($e instanceof DoesNotExistException ||
            $e instanceof MultipleObjectsReturnedException) {
            throw new NoteNotFound($e->getMessage());
        } else {
            throw $e;
        }
    }

	//Procura a nota no banco de dados
    public function find(int $id, string $userId) {
        try {
            return $this->mapper->find($id, $userId);

        // in order to be able to plug in different storage backends like files
        // for instance it is a good idea to turn storage related exceptions
        // into service related exceptions so controllers and service users
        // have to deal with only one type of exception
        } catch(Exception $e) {
            $this->handleException($e);
        }
    }

	//Cria a nota no banco de dados
    public function create(string $title, string $content, string $userId) {
        $note = new Note();
        $note->setTitle($title);
        $note->setContent($content);
        $note->setUserId($userId);
        return $this->mapper->insert($note);
    }

	//Atualiza a nota no banco de dados
    public function update(int $id, string $title, string $content, string $userId) {
        try {
            $note = $this->mapper->find($id, $userId);
            $note->setTitle($title);
            $note->setContent($content);
            return $this->mapper->update($note);
        } catch(Exception $e) {
            $this->handleException($e);
        }
    }

	//Remove a Nota no Banco de Dados
    public function delete(int $id, string $userId) {
        try {
            $note = $this->mapper->find($id, $userId);
            $this->mapper->delete($note);
            return $note;
        } catch(Exception $e) {
            $this->handleException($e);
        }
    }

}