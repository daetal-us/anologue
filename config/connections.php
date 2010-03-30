<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2009, Union of Rad, Inc. (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

use \lithium\data\Connections;

Connections::add('default', array(
	'type' => 'Http',
	'adapter' => 'CouchDb',
	'database' => 'anologue',
	'host' => 'localhost'
));

Connections::add('test', array(
	'type' => 'Http',
	'adapter' => 'CouchDb',
	'database' => 'anologue_test',
	'host' => 'localhost'
));

?>
