<?php

namespace app\models;

use \lithium\data\Connections;
use \lithium\data\collection\Document;
use \app\extensions\helper\Oembed;

/**
 * The core model and messages container for Anologue.
 *
 * @see lithium\data\Model
 */
class Anologue extends \lithium\data\Model {

	public static $alias = 'Anologue';

	/**
	 * Anologue meta
	 *
	 * @var array
	 * @see lithium\data\Model::$_meta
	 */
	protected $_meta = array(
		'source' => 'anologue'
	);

	/**
	 * Default key/values for messages.
	 *
	 * @var array
	 * @see app\models\Anologue::addMessage()
	 * @todo move to Message model
	 */
	protected static $_defaultMessage = array(
		'author' => 'anonymous',
		'ip' => null,
		'email' => null,
		'timestamp' => null,
		'text' => null
	);

	public static function __init(array $options = array()) {
		parent::__init($options);
		$self = static::_instance();
		$self->_setupFinders();
	}

	protected function _setupFinders() {
		$self = static::_instance();
		$self->_finders['changes'] = function($self, $params, $change) {
			$query = (array) $params['options']['conditions'] + array(
				'filter' => 'changes/id'
			);
			$connection = Connections::get($self::meta('connection'));
			$result = $connection->get(
				$connection->_config['database'] . '/_changes/',
				$query, array('type' => null)
			);
			if (empty($result)) {
				return 0;
			}
			return new Document(array(
				'items' => $result,
				'model' => __CLASS__
			));
		};
	}

	/**
	 * Create a new anologue using schema.
	 *
	 * @param array $data
	 * @return void
	 * @see lithium\data\Model::create()
	 */
	public static function create(array $data = array(), array $options = array()) {
		$default = array(
			'messages' => null
		);
		$data += $default;
		return parent::create($data, $options);
	}

	/**
	 * Append a message to an existing anologue. For user privacy, hashes the email before saving.
	 *
	 * @param integer $id
	 * @param array $message
	 * @see lithium\data\Model::save()
	 */
	public static function addMessage($id, $message = array()) {
		$message = $message + array('timestamp' => time()) + static::$_defaultMessage;

		$anologue = static::find($id);

		$message['text'] = Oembed::classify($message['text'], array('markdown' => true));

		if (!empty($message['email'])) {
			$message['email'] = md5($message['email']);
		}

		if (!$anologue->messages) {
			$anologue->messages = array($message);
		} else {
			$anologue->messages->append($message);
		}
		return $anologue->save();
	}

	public static function title($id, $title) {
		$anologue = static::find($id);
		if ($anologue) {
			if (!isset($anologue->title)) {
				$anologue->title = $title;
				if ($anologue->save()) {
					return true;
				}
			}
		}
		return false;
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
}

?>
