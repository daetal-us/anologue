<?php

namespace anologue\tests\cases\models;

use \anologue\models\Message;

class MessageTest extends \lithium\test\Unit {

	public function setUp() {}

	public function tearDown() {}

	public function testValidation() {
		$message = Message::create();
		$this->assertFalse($message->validates());

		$message->text = 'something';
		$this->assertTrue($message->validates());
	}

	public function testSave() {
		$message = Message::create();
		$result = $message->save();
		$this->assertFalse($result);

		$message = Message::create(array('text' => 'aloha'));
		$result = $message->save();
		$this->assertTrue($result);

		$expected = array('text','name','timestamp');
		$result = array_keys($message->data());
		$this->assertEqual($expected, $result);

		$expected = 'anonymous';
		$this->assertEqual($expected, $message->name);
		$this->assertTrue(is_numeric($message->timestamp));

		$data = array(
			'ip' => '1.1.1.1',
			'text' => 'aloha',
			'name' => 'jon',
			'url' => 'http://example.com',
			'email' => 'jon@anologue.com'
		);
		$message = Message::create($data);

		$result = $message->save();
		$this->assertTrue($result);

		$this->assertEqual($data['ip'], $message->ip);
		$this->assertEqual($data['text'], $message->text);
		$this->assertEqual($data['name'], $message->name);
		$this->assertEqual($data['url'], $message->url);

		$expected = '8ea3bb4b8d7a43ee0c89cfc05b716014';
		$this->assertEqual($expected, $message->email);

	}

}

?>