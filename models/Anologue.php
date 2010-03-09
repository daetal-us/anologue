<?php

namespace app\models;

use \lithium\data\model\Document;
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

	/**
	 * Create a new anologue using schema.
	 *
	 * @param array $data
	 * @return void
	 * @see lithium\data\Model::create()
	 */
	public static function create(array $data = array()) {
		$default = array(
			'messages' => null
		);
		$data = $data + $default;
		return parent::create($data);
	}

	/**
	 * Append a message to an existing anologue. For user privacy, hashes the email before saving.
	 *
	 * @param integer $id
	 * @param array $message
	 * @see lithium\data\Model::save()
	 */
	public static function addMessage($id, $message = array()) {
		$anologue = static::find($id);

		$message['text'] = Oembed::classify($message['text'], array('markdown' => true));

		if (!empty($message['email'])) {
			$message['email'] = md5($message['email']);
		}

		$message = $message + array('timestamp' => time()) + static::$_defaultMessage;

		if (!$anologue->messages) {
			$anologue->messages = array($message);
		} else {
			$anologue->messages->append($message);
		}
		return $anologue->save();
	}
}

?>
