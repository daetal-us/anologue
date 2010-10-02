<?php
/**
 * Anologue: anonymous, linear dialogue
 *
 * @copyright     Copyright 2010, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace anologue\extensions\command;

use \anologue\models\AnologueView;
use \lithium\data\Connections;

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
		$this->_greeting();
		$this->header("Installing...");

		if (!$this->_database()) {
			$this->_status = false;
		} else {
			foreach (AnologueView::$views as $key => $view) {
				if (!$existing = AnologueView::first($view['id'])) {
					$view = AnologueView::create($view);
					$view->save();
					$model = $view->model();
					if ($this->_check($view->model(), $key)) {
						$this->out("`{$model}::\$views[{$key}]` created as `{$view->id}`.");
					}
				} else {
					$this->out("View `{$existing->id}` already exists.");
					$choice = $this->in('Would you like to update this view?', array(
						'choices' => array('n', 'y')
					));
					if ($choice == 'y') {
						$existing->set($view + $existing->to('array'));
						$existing->save();
						if ($this->_check($existing->model(), $key)) {
							$this->out("`{$existing->id}` updated.");
						}
					} else {
						$this->out("`{$existing->id}` skipped!");
					}
				}
				$this->out();
			}
		}

		$message = 'Oops. Install failed.';
		if ($this->_status) {
			$message = 'Excellent! Install complete.';
		}
		$this->out(array('',$message,''));
	}

	/**
	 * Create database
	 */
	protected function _database() {
		$meta = \anologue\models\Anologue::meta();
		$connection = Connections::get($meta['connection']);

		if (!$connection) {
			$this->out(
				'Cannot connect to your database. Is CouchDB started and your connection configured?'
			);
			return false;
		}

		$configs = Connections::config();
		$connection->describe($configs[$meta['connection']]['database']);

		$this->out(
			'Connection available and database configured/created.'
		);
		$this->out();

		return true;
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
		}
		if (isset($view->id) && $view->id == "_design/{$name}") {
			return true;
		}
		$this->_status = false;
		return false;
	}

	protected function _greeting() {
		$this->clear();
		$this->header(base64_decode("CiAgICBAQEBAQEAgIEBAQCAgQEBAICBAQEBAQEAgIEBAQCAgICAgICBAQEBAQEAg"
		 . "ICBAQEBAQEBAQCBAQEAgIEBAQCBAQEBAQEBAQAogICBAQEBAQEBAQCBAQEBAIEBAQCBAQEBAQEBAQCBAQEAgICAgI"
		 . "CBAQEBAQEBAQCBAQEBAQEBAQEAgQEBAICBAQEAgQEBAQEBAQEAKICAgQEAhICBAQEAgQEAhQCFAQEAgQEAhICBAQE"
		 . "AgQEAhICAgICAgQEAhICBAQEAgIUBAICAgICAgIEBAISAgQEBAIEBAIQogICAhQCEgIEAhQCAhQCEhQCFAISAhQCE"
		 . "gIEAhQCAhQCEgICAgICAhQCEgIEAhQCAhQCEgICAgICAgIUAhICBAIUAgIUAhCiAgIEAhQCFAIUAhIEAhQCAhIUAh"
		 . "IEAhQCAgIUAhIEAhISAgICAgIEAhQCAgIUAhICFAISBAIUAhQCBAIUAgICFAISBAISEhOiEKICAgISEhQCEhISEgI"
		 . "UAhICAhISEgIUAhICAhISEgISEhICAgICAgIUAhICAhISEgISEhICEhQCEhICFAISAgISEhICEhISEhOgogICAhIT"
		 . "ogICEhISAhITogICEhISAhITogICEhISAhITogICAgICAhITogICEhISA6ISEgICAhITogISE6ICAhISEgISE6CiA"
		 . "gIDohOiAgITohIDohOiAgITohIDohOiAgITohICA6ITogICAgIDohOiAgITohIDohOiAgICE6OiA6ITogICE6ISA6"
		 . "IToKICAgOjogICA6OjogIDo6ICAgOjogOjo6OjogOjogIDo6IDo6OjogOjo6OjogOjogIDo6OiA6Ojo6IDo6Ojo6I"
		 . "Do6ICA6OiA6Ojo6CiAgICA6ICAgOiA6IDo6ICAgIDogICA6IDogIDogIDogOjogOiA6ICA6IDogIDogICA6OiA6Oi"
		 . "A6ICAgOiA6ICA6ICA6IDo6IDo6CgogICBhbm9ueW1vdXMsIGxpbmVhciBkaWFsb2d1ZSAg4oiGICAoYykgMjAxMCw"
		 . "gVW5pb24gb2YgUmFkICDiiIYgIGFub2xvZ3VlLmNvbQoJCQ=="));
	}

}

?>