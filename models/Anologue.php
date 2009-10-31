<?php

namespace app\models;

use \lithium\data\Connections;

/**
 * Data model for anologue store in couchdb.
 */
class Anologue extends \lithium\core\StaticObject {

	public static $alias = 'anologue';
	
	protected static $_schema = array(
		'anologue' => array(
			'messages' => null
		),
		'message' => array(
			'author' => 'anonymous',
			'email' => null,
			'timestamp' => null,
			'text' => null
		)
	);
	
	protected static $_meta = array(
		'source' => 'anologue'
	);
	
	public static function findById($id) {
		$uri = static::$_meta['source'] . '/' . $id;
		$result = Connections::get('couch')->get($uri);
		$result->messages = static::decodeMessages($result->messages);
		return $result;
	}
	
	public static function create() {
		$data = static::$_schema['anologue'];
		$result = Connections::get('couch')->post(static::$_meta['source'], $data);
		if (!empty($result->ok)) {
			$result->_id = $result->id;
			$result->_rev = $result->rev;
			unset($result->ok);
			unset($result->id);
			unset($result->rev);
			$result->messages = static::decodeMessages($result->messages);
			return $result;
		}
		return null;
	}
	
	public static function addMessage($id = null, $message = array()) {
		if (!empty($id) && is_string($id)) {
			$anologue = static::findById($id);
		} else {
			$message = $id;
			$id = null;
			$anologue = static::create();
		}
		$message = $message + array('timestamp' => time()) + static::$_schema['message'];
		$anologue->messages[] = $message;
		$anologue->messages = static::encodeMessages($anologue->messages);
		$result = Connections::get('couch')->post(static::$_meta['source'], $anologue);
		return $result;
	}
	
	public static function encodeMessages($messages = array()) {
		if (!empty($messages)) {
			foreach ($messages as $key => $message) {
				$message->text = rawurlencode($message->text);
				$messages[$key] = $message;
			}
		}
		return $messages;
	}
	
	public static function decodeMessages($messages = array()) {
		if (!empty($messages)) {
			foreach ($messages as $key => $message) {
				$message->text = rawurldecode($message->text);
				$messages[$key] = $message;
			}
		}
		return $messages;
	}
}

?>
