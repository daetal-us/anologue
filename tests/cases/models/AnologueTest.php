<?php

namespace app\tests\cases\models;

use \lithium\data\Connections;
use \app\models\Anologue;

class AnologueTest extends \lithium\test\Unit {

	public static function __init() {
		if (!Connections::get(Anologue::meta('connection'))) {
			$this->skip();
		}
		
		Anologue::__init(array('source' => 'test'));
	}

	public function testCreate() {
		$anologue = Anologue::create();
		$result = $anologue->save();
		$this->assertTrue($result, 'Cannot save document. Make sure `test` database exists.');
	}
	
	public function testAddEmptyMessage() {
		$anologue = Anologue::create();
		$anologue->save();
		$result = Anologue::addMessage($anologue->id);
		$this->assertTrue($result);
		
		$anologue = Anologue::find($anologue->id);
		$expected = '\lithium\data\model\Document';
		$result = '\\' . get_class($anologue->messages);
		$this->assertEqual($expected, $result);
	}
	
	public function testEmailEncryption() {
		$anologue = Anologue::create();
		$anologue->save();
		$message = array('email' => 'danny.tanner@wake-up-san-francisco.com');
		Anologue::addMessage($anologue->id, $message);
		$anologue = Anologue::find($anologue->id);
		$messages = $anologue->messages->to('array');
		
		$notExpected = 'danny.tanner@wake-up-san-francisco.com';
		$this->assertNotEqual($notExpected, $messages[0]['email']);
		
		$expected = 'c6c33ded09cbbf21d6fa20d7c4514567';
		$this->assertEqual($expected, $messages[0]['email']);
	}
	
	public function testMessageTimestamp() {
		$anologue = Anologue::create();
		$anologue->save();
		Anologue::addMessage($anologue->id);
		$anologue = Anologue::find($anologue->id);
		$messages = $anologue->messages->to('array');
		
		$this->assertFalse(empty($messages[0]['timestamp']));
		
		$this->assertTrue(date('m/d/y', $messages[0]['timestamp']));
	}
	
	public function testAppendMessageToExistingMessages() {
		$anologue = Anologue::create();
		$anologue->save();
		Anologue::addMessage($anologue->id);
		Anologue::addMessage($anologue->id);
		$anologue = Anologue::find($anologue->id);
		$messages = $anologue->messages->to('array');
		$expected = 2;
		$this->assertEqual($expected, count($messages));
	}

}

?>
