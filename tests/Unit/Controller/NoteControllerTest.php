<?php
declare(strict_types=1);
// SPDX-FileCopyrightText: Pablo Lucas Silva Santos <pablo@amoradev.com>
// SPDX-License-Identifier: AGPL-3.0-or-later

namespace OCA\AmoraDev\Tests\Unit\Controller;

use PHPUnit\Framework\TestCase;

use OCP\AppFramework\Http;
use OCP\IRequest;

use OCA\AmoraDev\Service\NoteNotFound;
use OCA\AmoraDev\Service\NoteService;
use OCA\AmoraDev\Controller\NoteController;

class NoteControllerTest extends TestCase {
	protected NoteController $controller;
	protected string $userId = 'john';
	protected $service;
	protected $request;

	public function setUp(): void {
		$this->request = $this->getMockBuilder(IRequest::class)->getMock();
		$this->service = $this->getMockBuilder(NoteService::class)
			->disableOriginalConstructor()
			->getMock();
		$this->controller = new NoteController($this->request, $this->service, $this->userId);
	}

	public function testUpdate(): void {
		// the existing note
		$note = 'just check if this value is returned correctly';
		$this->service->expects($this->once())
			->method('update')
			->with($this->equalTo(3),
					$this->equalTo('title'),
					$this->equalTo('content'),
				   $this->equalTo($this->userId))
			->will($this->returnValue($note));

		$result = $this->controller->update(3, 'title', 'content');

		$this->assertEquals($note, $result->getData());
	}


    /**
     * @expectedException OCA\NotesTutorial\Service\NotFoundException
     */
	public function testUpdateNotFound(): void {
		// test the correct status code if no note is found
		$this->service->expects($this->once())
			->method('update')
			->will($this->throwException(new NoteNotFound()));

		$result = $this->controller->update(3, 'title', 'content');

		$this->assertEquals(Http::STATUS_NOT_FOUND, $result->getStatus());
	}
}
