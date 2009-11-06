<?php

use \lithium\http\Router;

Router::connect('/', array('controller' => 'anologue', 'action' => 'index'));
Router::connect('/new', array('controller' => 'anologue', 'action' => 'add'));
Router::connect('/say/{:id}', array('controller' => 'anologue', 'action' => 'say'));
Router::connect('/{:id}.{:type}', array('controller' => 'anologue', 'action' => 'view'));
Router::connect('/{:id}', array('controller' => 'anologue', 'action' => 'view'));

?>
