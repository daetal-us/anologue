<?php
/**
 * Anologue: anonymous, linear dialogue
 *
 * @copyright     Copyright 2009, Union of Rad, Inc. (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

use \lithium\data\Connections;

Connections::add('anologue', array(
	'type' => 'http',
	'adapter' => 'CouchDb',
	'database' => 'anologue',
	'host' => 'localhost',
	'timeout' => 60,
	'version' => '1.0'
));

Connections::add('anologue_test', array(
	'type' => 'http',
	'adapter' => 'CouchDb',
	'database' => 'anologue_test',
	'host' => 'localhost',
	'version' => '1.0'
));


?>
