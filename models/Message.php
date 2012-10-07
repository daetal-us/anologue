<?php
/**
 * Anologue: anonymous, linear dialogue
 *
 * @copyright     Copyright 2010, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace anologue\models;

use \anologue\extensions\helper\Oembed;
use \lithium\util\Validator;

class Message extends \lithium\data\Model {

	protected static $_classes = array(
		'entity' => '\lithium\data\entity\Document'
	);

	protected $_meta = array(
		'source' =>     false,
		'connection' => false,
		'locked' =>     false
	);

	protected $_schema = array(
		'name' =>      array('default' => 'anonymous'),
		'ip' =>        array('default' => null),
		'email' =>     array('default' => null),
		'timestamp' => array('default' => null),
		'text' =>      array('default' => null),
		'url' =>       array('default' => null)
	);

	public static function __init(array $options = array()) {
		parent::__init($options);

		static::applyFilter('save', function ($self, $params, $chain) {

			if (empty($params['entity']->name) || $params['entity']->name == '') {
				$params['entity']->name = 'anonymous';
			}

			if (empty($params['entity']->url) || !Validator::rule('url', $params['entity']->url)) {
				unset($params['entity']->url);
			}

			if (!empty($params['entity']->email)) {
				$email = md5($params['entity']->email);
				$params['entity']->set(compact('email'));
			}
			$timestamp = time();
			$text = Oembed::classify($params['entity']->text, array('markdown' => true));
			$params['entity']->set(compact('timestamp','text'));

			return true;
		});
	}

}

?>