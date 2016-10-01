<?php
defined('APP_PATH') || define('APP_PATH', realpath('.'));

return new \Phalcon\Config(array(
    'pagination' => array(
        "pageSize" => 32
    ),
    'servicePath' => array(
        'url' => 'http://tutorial.api/v1/'
    ),
    // 'database' => array(
    //     'adapter'     => 'Mongo',
    //     'host'        => '127.0.0.1',
    //     'username'    => '',
    //     'password'    => '',
    //     'dbname'      => '_tutorial_restapi',
    //     'charset'     => 'utf8'
    // ),
    'database' => array(
        'adapter'     => 'Mysql',
        'host'        => '127.0.0.1',
        'username'    => 'root',
        'password'    => '123qwe',
        'dbname'      => '_tutorial_restapi',
        'charset'     => 'utf8'
    ),
    'mail' => array(
        'fromName' => 'Tutorial API',
        'fromEmail' => 'khachhang.khach23098@gmail.com',
        'smtp' => array(
            'server'    => 'smtp.gmail.com',
            'port'      => 465,
            'security' => 'ssl',
            'username' => 'khachhang.khach23098@gmail.com',
            'password' => '!@#QWE456qwe',
        )
    ),
    'crypt'=>array(
        'key'=>'!@#WAusH5OHlA9EMTuRZmGUQWE'
    ),
    'token'=>array(
        'key'=>'B1B945557316B9876953D8FA14CD5491'
    ),
    'responseCode' => array()
));

