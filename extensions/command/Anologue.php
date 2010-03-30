<?php

namespace app\extensions\command;

use \app\models\AnologueView;

class Anologue extends \lithium\console\Command {

	/**
	 * Container for install result flag.
	 *
	 */
	protected $_status = true;

	/**
	 * Run the install method to create database and views
	 *
	 * @return boolean
	 */
	public function install() {
		$this->clear();
		$this->header('Installing Anologue...');
		foreach (AnologueView::$views as $key => $view) {
			AnologueView::create($view)->save();
			$this->_check('\app\models\AnologueView', $key);
		}
		$message = 'Install failed.';
		if ($this->_status) {
			$message = 'Sweet, install complete.';
		}
		$this->out(array('',$message,''));
	}

	/**
	 * Checks model's configured CouchDB connection for existing design documents.
	 *
	 */
	protected function _check($model, $name = null) {
		if (!$name) {
			return null;
		}

		$view = $model::find("_design/{$name}");

		if (!empty($view->reason)) {
			switch($view->reason) {
				case 'no_db_file':
					$this->out(array(
						'Database does not exist.',
						'Please make sure CouchDB is running and refresh to try again.'
					));
				break;
				case 'missing':
					$this->out(array(
						'Database created.', 'Design views were not created.',
						'Please run the command again.'
					));
				break;
			}
			$this->_status = false;
		}
		if (isset($view->id) && $view->id == "_design/{$name}") {
			$this->out("`{$name}` view created.");
			return true;
		}
	}

}

?>