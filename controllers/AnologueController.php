<?php

namespace app\controllers;

use \app\models\Anologue;
use \lithium\http\Media;

class AnologueController extends \lithium\action\Controller {

	public function index() {
		$this->set(array('index' => true));
		$this->render();
	}

	public function say() {
		$status = 'error';
		if (!empty($this->request->params['id'])) {
			$data = $this->request->data;
			$data['ip'] = $this->request->env('REMOTE_ADDR');
			if (!empty($data)) {
				$status = 'fail';
				$result = Anologue::addMessage($this->request->params['id'], $data);
				$status = (!empty($result->ok)) ? 'success' : 'fail';
			}
		}
		$this->render(array('json' => (object) compact('status', 'data')));
	}

	public function view() {
		$status = 'error';
		$data = null;
		if (!empty($this->request->params['id'])) {
			$data = Anologue::findById($this->request->params['id']);
			$status = (!empty($data)) ? 'success' : 'fail';
		}
		$result = array();
		$this->set(compact('data'));

		if (!empty($this->request->params['type'])) {
			$result = array(
				$this->request->params['type'] => (object) compact('status', 'anologue')
			);
		}
		$this->render($result);
	}

	public function add() {
		$anologue = Anologue::create();
		if (!empty($anologue->error)) {
			throw new \Exception('CouchDB Error: ' . $anologue->error . ' | Reason: ' . $anologue->reason);
		}
		$this->redirect(array('controller' => 'anologue', 'action' => 'view', 'id' => $anologue->_id));
	}
}

?>