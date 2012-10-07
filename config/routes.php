<?php
/**
 * Anologue: anonymous, linear dialogue
 *
 * @copyright     Copyright 2010, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

use \lithium\net\http\Router;
use \lithium\core\Environment;

/**
 * Anologue application routes
 */
Router::connect('/', 'Pages::view');

/**
 * Connect the testing routes and theme skeleton.
 */
if (!Environment::is('production')) {
	Router::connect('/test/{:args}', array('controller' => '\lithium\test\Controller'));
	Router::connect('/test', array('controller' => '\lithium\test\Controller'));
	Router::connect('/spec-runner', array('controller' => 'pages', 'action' => 'view', 'args' => array('spec-runner')));
	Router::connect('/skeleton', array('controller' => 'pages', 'action' => 'view', 'args' => array('skeleton')));
}

/**
 * Create
 */
Router::connect('/add', array('controller' => 'anologue', 'action' => 'add'));
Router::connect('/add.{:type}', array('controller' => 'anologue', 'action' => 'add'));

/**
 * Update
 */
Router::connect('/ping/{:id}', array('controller' => 'anologue', 'action' => 'ping'));
Router::connect('/say/{:id}', array('controller' => 'anologue', 'action' => 'say'));

/**
 * Read
 */
Router::connect('/changes/{:id}', array('controller' => 'anologue', 'action' => 'changes'));
Router::connect('/{:id}.{:type}', array('controller' => 'anologue', 'action' => 'view'));
Router::connect('/{:id}', array('controller' => 'anologue', 'action' => 'view'));


?>