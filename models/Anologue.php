<?php
/**
 * Anologue: anonymous, linear dialogue
 *
 * @copyright     Copyright 2010, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace anologue\models;

use \lithium\util\Inflector;
use \lithium\data\Connections;
use \lithium\data\collection\DocumentSet;
use \lithium\data\entity\Document;
use \lithium\util\Validator;
use \anologue\models\Message;


/**
 * The core model and messages container for Anologue.
 *
 * @see lithium\data\Model
 */
class Anologue extends \lithium\data\Model {

	public static $alias = 'Anologue';

	protected $_schema = array(
		'type' => 			array('default' => 'anologue'),
		'created' => 		array('default' => null),
		'title' => 			array('default' => null),
		'description' => 	array('default' => null),
		'webhook' => 		array('default' => null),
		'messages' => 		array('default' => array()),
		'viewers' => 		array('default' => array()),
	);

	/**
	 * Anologue meta
	 *
	 * @var array
	 * @see lithium\data\Model::$_meta
	 */
	protected $_meta = array(
		'connection' => 'anologue',
		'source' => 'anologue',
		'locked' => false,
	);

	/**
	 * List of restricted document ids
	 *
	 * @var array
	 */
	public static $restricted = array(
		'ping', 'changes', 'anologue'
	);

	public static function __init(array $options = array()) {
		parent::__init($options);

		static::applyFilter('find', function ($self, $params, $chain) {
			$result = $chain->next($self, $params, $chain);

			if (empty($result)) {
				return $result;
			}

			if (!empty($result->messages)) {
				$messages = new DocumentSet(array(
					'data' => $result->messages->data(),
					'model' => 'anologue\models\Message'
				));
				$result->set(compact('messages'));
			}

			return $result;
		});

		static::applyFilter('save', function($self, $params, $chain) {
			$anologue = $params['entity'];

			if (empty($anologue->created)) {
				$created = time();
				$params['entity']->set(compact('created'));
			}

			if (
				empty($params['entity']->webhook)
				|| !Validator::rule('url', $params['entity']->webhook)
			) {
				unset($params['entity']->webhook);
			}

			if (empty($anologue->id) && !empty($anologue->title)) {
				$id = $slug = Inflector::slug($anologue->title);

				if (strlen($id) < 5) {
					$id = $slug = $id . '-' . substr(md5($slug . time()), 0, 5);
				}

				while (in_array($id, $self::$restricted) || $existing = Anologue::first($id)) {
					$id = "$slug-" .  substr(md5($slug . time()), 0, 4);
				}

				$params['entity']->set(compact('id'));
			}

			$result = $chain->next($self, $params, $chain);

			if ($result && $anologue->webhook) {
				$self::webhook($anologue->webhook, $anologue->data());
			}

			return $result;
		});

		$self = static::_object();
		$self->_setupFinders();
	}

	protected function _setupFinders() {
		$self = static::_object();
		$self->_finders['changes'] = function($self, $params, $chain) {
			$query = (array) $params['options']['conditions'] + array(
				'filter' => 'changes/id'
			);
			$connection = Connections::get($self::meta('connection'));
			$result = $connection->get(
				$connection->_config['database'] . '/_changes/',
				$query, array('type' => null)
			);
			if (empty($result) || empty($result->results)) {
				return 0;
			}
			return new Document(array(
				'data' => $result->results[0],
				'model' => __CLASS__
			));
		};
	}

	public static function ping($id, $data = array()) {
		$default = array(
			'key' => null,
			'user' => null
		);
		$data += $default;

		if (!empty($data['user']['email'])) {
			$data['user']['email'] = md5($data['user']['email']);
		}

		if (empty($data['user']['name'])) {
			$data['user']['name'] = 'anonymous';
		}

		$record = static::first($id);
		$anologue = $record->data();

		$cutoff = strtotime('-2 minutes');

		$viewers = array();


		if (!empty($anologue['viewers'])) {
			foreach ($anologue['viewers'] as $viewer => $value) {
				if ($value->timestamp >= $cutoff) {
					$viewers[$viewer] = $anologue['viewers'][$viewer];
				}
			}
		}

		$viewers[$data['key']] = $data['user'] + array('timestamp' => time());

		return $record->save(compact('viewers'));
	}

	/**
	 * Append a message to an existing anologue. For user privacy, hashes the email before saving.
	 *
	 * @param integer $id
	 * @param mixed $message array or instance of `anologue\models\Message`
	 * @see anologue\models\Message
	 * @see lithium\data\Model::save()
	 */
	public static function addMessage($id, $message = array()) {

		$anologue = static::first($id);

		if (empty($anologue)) {
			return false;
		}

		$message = Message::create($message);

		if (!$message->save()) {
			return false;
		}

		$messages = !empty($anologue->messages)
			? $anologue->messages->data()
			: array();

		$messages[] = $message;

		$messages = new DocumentSet(array(
			'data' => $messages,
			'model' => 'anologue\models\Message'
		));

		$anologue->messages = $messages;

		print_r($anologue->data());

		return $anologue->save();
	}

	/**
	 * Query changes for a particular document
	 *
	 * @param string|array $id if a string assumed id, otherwise, assumed array of conditions
	 * @param array $conditions (optional) array of conditions
	 * @see http://wiki.apache.org/couchdb/HTTP_database_API#Changes
	 */
	public static function changes($id = null, $conditions = array()) {
		$defaults = array(
			'id' => null,
			'feed' => 'longpoll',
			'timeout' => 55000,
			'since' => 0,
			'style' => 'all_docs'
		);

		$conditions['id'] = $id;
		if (is_array($id)) {
			$conditions = $id;
		}

		$conditions += $defaults;

		return static::find('changes', compact('conditions'));
	}

	/**
	 * Post data in json format to a url
	 *
	 * @param string $uri
	 * @param array $data
	 * @return void
	 */
	public static function webhook($uri, $data) {
		return;
	}
}

?>
