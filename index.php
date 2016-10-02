<?php
defined('APP_PATH') || define('APP_PATH', realpath('.'));
define("API_VERSION","v1");

use \Phalcon\Http\Response;

try {
	define('APP_DEBUG', false);
	define('DEPLOY', "development");
	$config = include APP_PATH . "/config/".DEPLOY."/config.php";
	include APP_PATH . "/config/".DEPLOY."/message.php";

	$loader = new \Phalcon\Loader();

	$di = new Phalcon\Di\FactoryDefault();
	$config->responseCode = $messages;
	$di->set('config', $config);

	/**
	 * We're a registering a set of directories taken from the configuration file
	 */

	$db = $config->database->toArray();
    $driver = $db['adapter'];
    if($driver=="Mysql")
    {
    	$loader->registerDirs(
		    array(
		        APP_PATH . '/models/mysql/',
		        APP_PATH . '/library/',
		        APP_PATH . '/vendor/'
		    )
		)->register();
    }

    if($driver=="Mongo")
    {
    	$loader->registerDirs(
		    array(
		        APP_PATH . '/models/mongo/',
		        APP_PATH . '/library/',
		        APP_PATH . '/vendor/'
		    )
		)->register();
    }

	/*
	* Api Path
	*/
	$apiVersionPath = "/".API_VERSION;

	/**
	 * Database connection is created based in the parameters defined in the configuration file
	 */
	$di->setShared('db', function () use ($config) {
	    $dbConfig = $config->database->toArray();
	    $adapter = $dbConfig['adapter'];
	    unset($dbConfig['adapter']);

	    $class = 'Phalcon\Db\Adapter\Pdo\\' . $adapter;

	    return new $class($dbConfig);
	});

	// MongoDB Database 
	$di->set('mongo', function () use ($config) {
	    if (!$config->database->username OR !$config->database->password) {
	        $mongo = new MongoClient('mongodb://' . $config->database->host);
	    } else {
	        $mongo = new MongoClient('mongodb://' . $config->database->username . ':' . $config->database->password . '@' . $config->database->host, array('db' => $config->database->dbname));
	    }
	    
	    return $mongo->selectDb($config->database->dbname);
	}, true);

	// Set the CollectionManager
	$di->set('collectionManager', function(){
	    return new Phalcon\Mvc\Collection\Manager();
	}, true);

	/**
	 * Start the sendmail
	 */
	/**
	* Mail service uses AmazonSES
	*/
	$di->set('mail', function(){
        return new Mail();
	});

	// Create and bind the DI to the application
	$app = new Phalcon\Mvc\Micro($di);

	$app->ResponseLib = new ResponseLib($config,$app);
	$app->ValidateLib = new ValidateLib($config,$app);
	$app->JsonLib = new JsonLib();
	// $app->AdvancedHtmlDom = new AdvancedHtmlDom();
	$app->CryptLib = new CryptLib();
	$app->PHQL = new PHQL($config,$app);

	

	// current version
	include API_VERSION.'/app.php';

	$app->handle();

} catch (\Exception $e) {
	http_response_code(404);
	echo $e;
}

?>