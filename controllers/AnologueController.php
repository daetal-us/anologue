<?php
/**
 * Anologue: anonymous, linear dialogue
 *
 * @copyright     Copyright 2010, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace anologue\controllers;

use \anologue\models\Anologue;
use \lithium\storage\Session;
use \lithium\core\Environment;

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
		$id = $data = null;
		$result = array();
		$defaultUser = array(
			'name' => null,
			'email' => null,
			'url' => null,
			'scrolling' => 'true',
			'sounds' => 'true',
			'cookies' => 'true'
		);

		if (!empty($this->request->params['id'])) {
			$data = Anologue::find($this->request->params['id']);
		}

		if (empty($data) || !empty($data->error)) {
			$this->redirect('/');
		}

		if (isset($this->request->query['user'])) {
			$defaultUser = (array) $this->request->query['user'] + $defaultUser;
		}
		if (isset($this->request->data['user'])) {
			$defaultUser = (array) $this->request->data['user'] + $defaultUser;
		}

		$id = $this->request->params['id'];
		$status = 'success';

		if (!empty($this->request->params['type'])) {
			$data = $data->to('array');
			$result = array(
				$this->request->params['type'] => compact('status', 'data')
			);
		}

		$user = Session::read($id);
		if (!empty($user)) {
			$user = unserialize($user) + $defaultUser;
		} else {
			$user = $defaultUser;
		}

		$this->_manageCookie($id, $user);

		$this->set(compact('data', 'user'));
		$this->render($result);
	}

	/**
	 * Pinging an anologue updates the anologue with a timestamp and your user data. This is what
	 * makes the "viewers" feature possible.
	 *
	 */
	public function ping() {
		if (!empty($this->request->params['id'])) {
			$id = $this->request->params['id'];
			$user = $this->_manageCookie($id, $this->request->data);
			$key = Session::key('php');
			$result = Anologue::ping($id, compact('key','user'));
		}
		return $this->render(array('json' => compact('result')));
	}

	public function changes() {
		$status = 'error';
		$data = null;
		$since = 0;
		if (!empty($this->request->query['since'])) {
			$since = $this->request->query['since'];
		}
		if (!empty($this->request->params['id'])) {
			if ($changes = Anologue::changes($this->request->params['id'], compact('since'))) {
				$status = 'success';
				$data = $changes->to('array');
			}
		}
		return $this->render(array('json' => compact('status', 'data')));
	}

	/**
	 * Create a new anologue, set admin parameter in user cookie and redirect to view.
	 *
	 * @see anologue\controllers\AnologueController::view()
	 */
	public function add() {

		$data = array(
			'title' => null,
			'description' => null,
			'webhook' => null
		);

		foreach (array_keys($data) as $key) {
			if (isset($this->request->query[$key])) {
				$data[$key] = $this->request->query[$key];
			}
			if (isset($this->request->data[$key])) {
				$data[$key] = $this->request->data[$key];
			}
		}

		$anologue = Anologue::create(array_filter($data));
		$anologue->save();

		if (!empty($this->request->params['type'])) {
			$data = $anologue->to('array');
			$result = array(
				$this->request->params['type'] => compact('data')
			);
			return $this->render($result);
		}

		$this->redirect(array('controller' => 'anologue', 'action' => 'view', 'id' => $anologue->id));
	}

	/**
	 * Add a message to the an existing anologue.
	 */
	public function say() {
		$status = 'error';
		if (!empty($this->request->params['id'])) {
			$id = $this->request->params['id'];
			$data = $this->request->data;

			if (isset($data['admin'])) {
				unset($data['admin']);
			}

			$this->_manageCookie($id, $data);

			$data['ip'] = $this->request->env('REMOTE_ADDR');
			if (!empty($data)) {
				$result = Anologue::addMessage($id, $data);
				$status = ($result) ? 'success' : 'fail';
			}
		}
		$this->render(array('json' => (object) compact('status', 'data')));
	}


	/**
	 * Convenient skinning with sample content.
	 */
	public function skeleton() {}

	/**
	 * Internal method to create or delete data in cookie.
	 *
	 * This method is currently intended to be called from within `AnologueController::say()`.
	 *
	 * @param array $data associative array of user data and options to be saved
	 * @see anologue\controllers\AnologueController::say()
	 */
	private function _manageCookie($id = null, $data = array()) {

		$keys = array('name','email','url','scrolling','sounds','cookies');

		$user = array();

		if (isset($data['cookies']) && $data['cookies'] == 'false') {
			Session::write($id, null);
		} else {
			$allowed = array_fill_keys($keys, null);

			$user = array_filter(array_intersect_key($data, $allowed));

			if (isset($user['name']) && $user['name'] == 'anonymous') {
				unset($user['name']);
			}

			$serialized = serialize($user);

			Session::write($id, $serialized);
			Session::write($id, $serialized, array('name' => 'php'));
		}

		return $user;
	}

}

?>