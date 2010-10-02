<?php
/**
 * Anologue: anonymous, linear dialogue
 *
 * @copyright     Copyright 2010, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace anologue\tests\cases\models;

use \lithium\data\Connections;
use \anologue\models\Anologue;
use \anologue\models\Message;
use \anologue\models\AnologueView;


class AnologueTest extends \lithium\test\Unit {

	public function skip() {
		$config = array(
			'connection' => 'anologue_test'
		);

		Anologue::meta($config);
		Message::meta($config);
		AnologueView::meta($config);

		$connection = Connections::get($config['connection']);
		$message 	= 'Cannot connect to your database. Is CouchDB started and your connection '
						. 'properly configured?';
		$this->skipIf(!$connection, $message);

		$configs = Connections::config();
		$connection->describe($configs[$config['connection']]['database']);

	}

	public function setUp() {
		foreach (AnologueView::$views as $key => $view) {
			$result = AnologueView::create($view)->save();
		}
	}

	public function tearDown() {
		$results = Anologue::all();
		if ($results->count()) {
			$results->delete();
		}
	}

	public function testCreate() {

		$data = array(
			'title' => 'Custom Title',
			'messages' => array(
				array(
					'ip' => '127.0.0.1',
					'email' => 'jon@anologue.com',
					'text' => 'hi.'
				)
			)
		);
		$anologue = Anologue::create($data);
		$result = $anologue->save();
		$this->assertTrue($result, 'Cannot save document.');

		$result = Anologue::first($anologue->id);
		$this->assertTrue($result, 'Cannot find document.');

		$result = $result->data();

		$this->assertTrue(array_key_exists('title', $result));

		$expected = $data['title'];
		$this->assertEqual($expected, $result['title']);

		$this->assertTrue(array_key_exists('messages', $result));

		$this->assertTrue(!empty($result['messages']));

		$expected = $data['messages'][0]['ip'];
		$this->assertEqual($expected, $result['messages'][0]['ip']);

		$expected = $data['messages'][0]['email'];
		$this->assertEqual($expected, $result['messages'][0]['email']);

		$expected = $data['messages'][0]['text'];
		$this->assertEqual($expected, $result['messages'][0]['text']);

		$this->assertTrue(array_key_exists('created', $result));
		$this->assertTrue(is_numeric($result['created']));

		$expected = date('Y-m-d');
		$this->assertEqual($expected, date('Y-m-d', $result['created']));

		$this->assertTrue(array_key_exists('type', $result));

		$expected = 'anologue';
		$this->assertEqual($expected, $result['type']);
	}

	public function testAddEmptyMessage() {
		$anologue = Anologue::create();
		$result = $anologue->save();
		$this->assertTrue($result);

		$result = Anologue::addMessage($anologue->id);
		$this->assertFalse($result);
	}

	public function testAddMessage() {
		$anologue = Anologue::create();
		$result = $anologue->save();
		$this->assertTrue($result);

		$message = array(
			'text' => 'new message'
		);
		$result = Anologue::addMessage($anologue->id, $message);
		$this->assertTrue($result);

		$result = Anologue::find($anologue->id);
		$this->assertTrue(!empty($result));

		$this->assertTrue(!empty($result->messages));

		$expected = 1;
		$this->assertEqual($expected, $result->messages->count());

		$expected = $message['text'];
		$this->assertEqual($expected, $result->messages->first()->text);

		$messageTwo = array(
			'text' => 'second message'
		);
		$result = Anologue::addMessage($anologue->id, $messageTwo);
		$this->assertTrue($result);

		$result = Anologue::find($anologue->id);

		$this->assertTrue(!empty($result));

		$this->assertTrue(!empty($result->messages));

		$expected = 2;
		$this->assertEqual($expected, $result->messages->count());

		$expected = $message['text'];
		$this->assertEqual($expected, $result->messages->first()->text);

		$result->messages->next();
		$expected = $messageTwo['text'];
		$this->assertEqual($expected, $result->messages->current()->text);
	}

	public function testEmailEncryption() {
		$anologue = Anologue::create();
		$anologue->save();
		$message = array(
			'text' => 'something',
			'email' => 'danny.tanner@wake-up-san-francisco.com'
		);
		Anologue::addMessage($anologue->id, $message);
		$anologue = Anologue::find($anologue->id);
		$messages = $anologue->messages->data();

		$notExpected = 'danny.tanner@wake-up-san-francisco.com';
		$this->assertNotEqual($notExpected, $messages[0]['email']);

		$expected = 'c6c33ded09cbbf21d6fa20d7c4514567';
		$this->assertEqual($expected, $messages[0]['email']);
	}

	public function testMessageTimestamp() {
		$anologue = Anologue::create();
		$anologue->save();
		Anologue::addMessage($anologue->id, array('text' => 'blah'));
		$anologue = Anologue::find($anologue->id);
		$messages = $anologue->messages->data();

		$this->assertFalse(empty($messages[0]['timestamp']));

		$this->assertTrue(date('m/d/y', $messages[0]['timestamp']));
	}

	public function testChanges() {
		$anologue = Anologue::create();
		$anologue->save();

		$result = Anologue::changes($anologue->id, array('timeout' => 1));
		$this->assertTrue($result);

		$sequence = $result->seq;

		$result = Anologue::changes($anologue->id, array('since' => $sequence, 'timeout' => 1));
		$this->assertFalse($result);

		$result = Anologue::addMessage($anologue->id, array('text' => 'some message'));
		$this->assertTrue($result);

		$result = Anologue::changes($anologue->id, array('since' => $sequence, 'timeout' => 1));
		$this->assertTrue($result);

		$result = $result->seq > $sequence;
		$this->assertTrue($result);

	}

}

?>
