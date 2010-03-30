<?php

namespace app\tests\cases\models;

use \lithium\data\Connections;
use \app\models\Anologue;
use \app\models\AnologueView;

class AnologueTest extends \lithium\test\Unit {

	public function skip() {
		$config = array(
			'connection' => 'test'
		);

		Anologue::__init($config);
		AnologueView::__init($config);

		$connection = Connections::get(Anologue::meta('connection'));
		$message 	= 'Cannot connect to your database. Is CouchDB started and your connection '
						. 'properly configured?';
		$this->skipIf(!$connection, $message);

		foreach (AnologueView::$views as $key => $view) {
			$result = AnologueView::create($view)->save();
			$this->skipIf(!$result, 'Could not install required design document');
		}
	}

	public function testCreate() {
		$anologue = Anologue::create();
		$result = $anologue->save();
		$this->assertTrue($result, 'Cannot save document. Make sure `test` database exists.');
	}

	public function testAddEmptyMessage() {
		$anologue = Anologue::create();
		$result = $anologue->save();
		$this->assertTrue($result);

		$result = Anologue::addMessage($anologue->id);
		$this->assertTrue($result);

		$anologue = Anologue::find($anologue->id);
		$expected = '\lithium\data\collection\Document';
		$result = '\\' . get_class($anologue->messages);
		$this->assertEqual($expected, $result);
	}

	public function testAddMessageMarkdownLink() {
		$anologue = Anologue::create();
		$result =  $anologue->save();
		$this->assertTrue($result);

		$result = Anologue::addMessage($anologue->id, array(
			'text' => 'unlinked http://example.com'
		));
		$this->assertTrue($result);

		$result = Anologue::find($anologue->id);
		$firstMessage = $result->messages->first()->to('array');
		$expected = 'unlinked [http://example.com](http://example.com)';
		$this->assertEqual($expected, $firstMessage['text']);

		$result = Anologue::addMessage($anologue->id, array('text' => '[already a link](http://example.com)'));
		$this->assertTrue($result);

		$result = Anologue::find($anologue->id);
		$secondMessage = $result->messages->next()->to('array');
		$expected = '[already a link](http://example.com)';
		$this->assertEqual($expected, $secondMessage['text']);
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

	public function testChanges() {
		$anologue = Anologue::create();
		$anologue->save();

		$result = Anologue::changes($anologue->id);
		$this->assertTrue($result);

		$sequence = $result->seq;

		$result = Anologue::changes($anologue->id, array('since' => $sequence));
		$this->assertFalse($result);

		$result = Anologue::addMessage($anologue->id, array('text' => 'some message'));
		$this->assertTrue($result);

		$result = Anologue::changes($anologue->id, array('since' => $sequence));
		$this->assertTrue($result);

		$result = $result->seq > $sequence;
		$this->assertTrue($result);

	}

}

?>
