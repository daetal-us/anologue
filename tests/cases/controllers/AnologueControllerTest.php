<?php

namespace app\tests\cases\controllers;

use \app\controllers\AnologueController;

class AnologueControllerTest extends \lithium\test\Unit {

	public function testIndex() {
		$anologueController = new AnologueController(array('classes' => array(
			'media' => '\lithium\tests\mocks\action\MockMediaClass'
		)));
		$response = $anologueController->__invoke(null, array('action' => 'index'));
		
		$expected = 'index';
		$this->assertEqual($expected, $response->options['template']);
		$this->assertTrue($response->data['index']);
	}
	
	public function testView() {
		$anologueController = new AnologueController(array('classes' => array(
			'media' => '\lithium\tests\mocks\action\MockMediaClass',
			'response' => '\lithium\tests\mocks\action\MockControllerResponse'
		)));
		$anologueController->__invoke(null, array('action' => 'view'));
		//print_r($response);
	}
	
	public function testAdd() {
		
	}
	
	public function testSay() {
	}

}

?>
