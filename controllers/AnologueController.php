<?php

namespace app\controllers;

use \app\models\Anologue;
use \lithium\http\Media;

/**
 * The core controller for Anologue.
 *
 * @see lithium\action\controller 
 */
class AnologueController extends \lithium\action\Controller {

	/**
	 * This action is used to render the index view, which is essentially a static page.
	 */
	public function index() {
		$this->set(array('index' => true));
		$this->render();
	}

	/**
	 * View an anologue. By default, the anologue data is requested and passed to the view to be 
	 * rendered as html. However, a `type` param can be passed, currently utilized by the router to 
	 * render the data as json.
	 */
	public function view() {
		$status = 'error';
		$data = null;
		$result = array();
		
		if (!empty($this->request->params['id'])) {
			$data = Anologue::find($this->request->params['id']);
			$status = (!empty($data)) ? 'success' : 'fail';
		}
		
		if (!empty($data->error)) {
			$this->redirect(array('controller' => 'anologue', 'action' => 'index'));
		}
		
		if (!empty($this->request->params['type'])) {
			$data = $data->to('array');
			$result = array(
				$this->request->params['type'] => compact('status', 'data')
			);
		}
		
		$this->set(compact('data'));
		$this->render($result);
	}

	/**
	 * Create a new anologue and redirect to view it.
	 *
	 * @see app\controllers\AnologueController::view()
	 */
	public function add() {
		$anologue = Anologue::create();
		$anologue->save();
		$this->redirect(array('controller' => 'anologue', 'action' => 'view', 'id' => $anologue->id));
	}
	
	/**
	 * Add a message to the an existing anologue.
	 */
	public function say() {
		$status = 'error';
		if (!empty($this->request->params['id'])) {
			$data = $this->request->data;
			$data['ip'] = $this->request->env('REMOTE_ADDR');
			if (!empty($data)) {
				$status = 'fail';
				$result = Anologue::addMessage($this->request->params['id'], $data);
				$status = ($result) ? 'success' : 'fail';
			}
		}
		$this->render(array('json' => (object) compact('status', 'data')));
	}
}

?>
