<?php

namespace OCA\AmoraDev\Controller;

use Exception;

use OCP\IRequest;
use OCP\AppFramework\Http;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Controller;

use OCA\AmoraDev\Db\Note;
use OCA\AmoraDev\Db\NoteMapper;

class NoteController extends Controller
{

    private $mapper;
    private $userId;

    public function __construct(string $AppName, IRequest $request, NoteMapper $mapper, $UserId)
    {
        parent::__construct($AppName, $request);
        $this->mapper = $mapper;
        $this->userId = $UserId;
    }

    /**
     * @NoAdminRequired
     */
    public function index()
    {
        return new DataResponse($this->mapper->findAll($this->userId));
    }

    /**
      * @NoAdminRequired
      *
      * @param int $id
      */
      public function show(int $id) {
        try {
            return new DataResponse($this->mapper->find($id, $this->userId));
        } catch(Exception $e) {
            return new DataResponse([], Http::STATUS_NOT_FOUND);
        }
    }

    /**
     * @NoAdminRequired
     *
     * @param string $title
     * @param string $content
     */
    public function create(string $title, string $content) {
        $note = new Note();
        $note->setTitle($title);
        $note->setContent($content);
        $note->setUserId($this->userId);
        return new DataResponse($this->mapper->insert($note));
    }

    /**
     * @NoAdminRequired
     *
     * @param int $id
     * @param string $title
     * @param string $content
     */
    public function update(int $id, string $title, string $content) {
        try {
            $note = $this->mapper->find($id, $this->userId);
        } catch(Exception $e) {
            return new DataResponse([], Http::STATUS_NOT_FOUND);
        }
        $note->setTitle($title);
        $note->setContent($content);
        return new DataResponse($this->mapper->update($note));
    }

    /**
     * @NoAdminRequired
     *
     * @param int $id
     */
    public function destroy(int $id) {
        try {
            $note = $this->mapper->find($id, $this->userId);
        } catch(Exception $e) {
            return new DataResponse([], Http::STATUS_NOT_FOUND);
        }
        $this->mapper->delete($note);
        return new DataResponse($note);
    }

}