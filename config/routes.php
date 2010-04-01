<?php

use \lithium\net\http\Router;

/**
 * Connect the testing routes.
 */
Router::connect('/test/{:args}', array('controller' => '\lithium\test\Controller'));
Router::connect('/test', array('controller' => '\lithium\test\Controller'));

/**
 * Anologue application routes
 */
Router::connect('/', array('controller' => 'anologue', 'action' => 'index'));
Router::connect('/add', array('controller' => 'anologue', 'action' => 'add'));
Router::connect('/say/{:id}', array('controller' => 'anologue', 'action' => 'say'));
Router::connect('/title/{:id}', array('controller' => 'anologue', 'action' => 'title'));
Router::connect('/changes/{:id}', array('controller' => 'anologue', 'action' => 'changes'));
Router::connect('/{:id}.{:type}', array('controller' => 'anologue', 'action' => 'view'));
Router::connect('/{:id}', array('controller' => 'anologue', 'action' => 'view'));

?>
