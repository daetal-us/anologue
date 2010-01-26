<?php

namespace app\controllers;

use \app\models\Anologue;
use \lithium\storage\Session;

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
		$defaultUser = array(
			'author' => null,
			'email' => null,
			'scrolling' => 'true',
			'sounds' => 'true',
			'cookies' => 'true'
		);
		
		if (!empty($this->request->params['id'])) {
			$data = Anologue::find($this->request->params['id']);
			$status = (!empty($data)) ? 'success' : 'fail';
		}
		
		if (!empty($data->error) || empty($this->request->params['id'])) {
			$this->redirect('/');
		}
		
		if (!empty($this->request->params['type'])) {
			$data = $data->to('array');
			$result = array(
				$this->request->params['type'] => compact('status', 'data')
			);
		}
		
		$user = Session::read('user');
		if (!empty($user)) {
			$user = unserialize($user) + $defaultUser;
		}
		
		$this->set(compact('data', 'user'));
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
			
			$this->_manageCookie($data);
			
			$data['ip'] = $this->request->env('REMOTE_ADDR');
			if (!empty($data)) {
				$status = 'fail';
				$result = Anologue::addMessage($this->request->params['id'], $data);
				$status = ($result) ? 'success' : 'fail';
			}
		}
		$this->render(array('json' => (object) compact('status', 'data')));
	}
	
	/**
	 * Internal method to create or delete data in cookie.
	 *
	 * This method is currently intended to be called from within `AnologueController::say()`.
	 *
	 * @param array $data associative array of user data and options to be saved
	 * @see app\controllers\AnologueController::say()
	 */ 
	private function _manageCookie($data = array()) {
		$cookieKeys = array('author','email','scrolling','sounds', 'cookies');
		if ($data['cookies'] == 'true') {
			$user = array();
		
			array_walk($cookieKeys, function($key) use (&$data, &$user) {
				if (!empty($data[$key])) {
					$user[$key] = $data[$key];
					if ($key == 'author' && $data[$key] == 'anonymous') {
						unset($user[$key]);
					}
				}
			});
		
			Session::write('user', serialize($user));
		} else {
			Session::write('user', null);
		}
	}
	
}

?>
