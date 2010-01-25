<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2009, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace lithium;

use \lithium\core\Environment;
use \lithium\core\Libraries;
use \lithium\storage\Session;

/**
 * This is the path to the class libraries used by your application, and must contain a copy of the
 * Lithium core.  By default, this directory is named 'libraries', and resides in the same
 * directory as your application.  If you use the same libraries in multiple applications, you can
 * set this to a shared path on your server.
 */
define('LITHIUM_LIBRARY_PATH', dirname(dirname(__DIR__)) . '/lithium/libraries');

/**
 * This is the path to your application's directory.  It contains all the sub-folders for your
 * application's classes and files.  You don't need to change this unless your webroot folder is
 * stored outside of your app folder.
 */
define('LITHIUM_APP_PATH', dirname(__DIR__));

/**
 * Locate and load Lithium core library files.  Throws a fatal error if the core can't be found.
 * If your Lithium core directory is named something other than 'lithium', change the string below.
 */
if (!include LITHIUM_LIBRARY_PATH . '/lithium/core/Libraries.php') {
	$message  = "Lithium core could not be found.  Check the value of LITHIUM_LIBRARY_PATH in ";
	$message .= "config/bootstrap.php.  It should point to the directory containing your ";
	$message .= "/libraries directory.";
	trigger_error($message, E_USER_ERROR);
}

/**
 * Add the Lithium core library.  This sets default paths and initializes the autoloader.  You
 * generally should not need to override any settings.
 */
Libraries::add('lithium');

/**
 * Optimize default request cycle by loading common classes.  If you're implementing custom
 * request/response or dispatch classes, you can safely remove these.  Actually, you can safely
 * remove them anyway, they're just there to give slightly you better out-of-the-box performance.
 */
require LITHIUM_LIBRARY_PATH . '/lithium/core/Object.php';
require LITHIUM_LIBRARY_PATH . '/lithium/core/StaticObject.php';
require LITHIUM_LIBRARY_PATH . '/lithium/util/Collection.php';
require LITHIUM_LIBRARY_PATH . '/lithium/util/collection/Filters.php';
require LITHIUM_LIBRARY_PATH . '/lithium/util/Inflector.php';
require LITHIUM_LIBRARY_PATH . '/lithium/util/Set.php';
require LITHIUM_LIBRARY_PATH . '/lithium/util/String.php';
require LITHIUM_LIBRARY_PATH . '/lithium/core/Environment.php';
require LITHIUM_LIBRARY_PATH . '/lithium/http/Base.php';
require LITHIUM_LIBRARY_PATH . '/lithium/http/Media.php';
require LITHIUM_LIBRARY_PATH . '/lithium/http/Request.php';
require LITHIUM_LIBRARY_PATH . '/lithium/http/Response.php';
require LITHIUM_LIBRARY_PATH . '/lithium/http/Route.php';
require LITHIUM_LIBRARY_PATH . '/lithium/action/Controller.php';
require LITHIUM_LIBRARY_PATH . '/lithium/action/Dispatcher.php';
require LITHIUM_LIBRARY_PATH . '/lithium/action/Request.php';
require LITHIUM_LIBRARY_PATH . '/lithium/action/Response.php';
require LITHIUM_LIBRARY_PATH . '/lithium/template/View.php';
require LITHIUM_LIBRARY_PATH . '/lithium/template/view/Renderer.php';



/**
 * Add the application.  You can pass a `'path'` key here if this bootstrap file is outside of
 * your main application, but generally you should not need to change any settings.
 */
Libraries::add('app');

Session::config(array('default' => array('adapter' => 'Cookie')));

?>
