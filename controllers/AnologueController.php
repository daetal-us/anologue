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
			$data['ip'] = $this->request->get('env:REMOTE_ADDR');
			if (!empty($data)) {
				$result = Anologue::addMessage($this->request->params['id'], $data);
				if (!empty($result->ok)) {
					$status = 'success';
				} else {
					$status = 'fail';
				}
			}
		}
		$this->render(array('json' => $this->_jsend($status)));
	}
	
	public function view() {
		$anonymousAvatar = Media::asset('anonymous.png', 'image');
		if (!empty($this->request->params['id'])) {
			$anologue = Anologue::findById($this->request->params['id']);
			$this->set(compact('anologue'));
			$this->render();
		}
	}
	
	public function add() {
		$anologue = Anologue::create();
		if (!empty($anologue->error)) {
			throw new \Exception('CouchDB Error: ' . $anologue->error . ' | Reason: ' . $anologue->reason);
		}
		$this->redirect(array('controller' => 'anologue', 'action' => 'view', 'id' => $anologue->_id));
	}
	
	public function json() {
		$status = 'error';
		$anologue = false;
		if (!empty($this->request->params['id'])) {
			$status = 'fail';
			$anologue = Anologue::findById($this->request->params['id']);
			if ($anologue) {
				$status = "success";
			}
		}
		$data = new \stdClass();
		$data->anologue = $anologue;
		$this->render(array('json' => $this->_jsend($status, $data)));
	}
	
	protected function _jsend($status = "fail", $data = null) {
		$jsend = new \stdClass();
		$jsend->status = $status;
		$jsend->data = $data;
		return $jsend;
	}
}

?>
