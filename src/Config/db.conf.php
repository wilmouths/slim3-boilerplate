<?php

/**
 * db.config.php
 *
 * Database configuration
 *
 * @author     WILMOUTH Steven
 * @version    1
 */
return array(
	'default' => 'dev', // Name of the configuration to use

    // development configuration
	'dev' => array(
		'driver' => 'mysql',
		'host' => '192.168.99.100',
		'user' => 'root',
		'pass' => 'root',
		'dbName' => 'swilm',
		'port' => 3306,
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => ''
	),

    // production configuration
	'prod' => array(
		'driver' => 'mysql',
		'host' => '',
		'user' => '',
		'pass' => '',
		'dbName' => '',
		'port' => 3306,
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => ''
	)
);
