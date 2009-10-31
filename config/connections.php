<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2009, Union of Rad, Inc. (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

use \lithium\data\Connections;

Connections::add('couch', 'http', array(
	'adapter' => 'Couch',
	'host' => '127.0.0.1',
	'port' => 5984,
));
?>
