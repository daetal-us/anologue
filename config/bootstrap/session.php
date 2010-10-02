<?php
/**
 * Anologue: anonymous, linear dialogue
 *
 * @copyright     Copyright 2010, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

/**
 * This configures your session storage. The Cookie storage adapter must be connected first, since
 * it intercepts any writes where the `'expires'` key is set in the options array.
 */
use \lithium\storage\Session;

Session::config(array(
	'default' => array('adapter' => 'Cookie')
));
Session::config(array(
	'php' => array('adapter' => 'Php')
));

?>