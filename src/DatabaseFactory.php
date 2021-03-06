<?php

namespace App;

use App\Utils\Utils;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * DatabaseFactory.php
 *
 * Create a connection to the database
 *
 * @package    swilm
 * @author     WILMOUTH Steven
 * @version    1
 */
class DatabaseFactory
{

    /**
     * @var string $connectionName Name of current connection
     */
    private static $connectionName;

    /**
     * @var array $dbConfig Array of configuration
     */
	private static $dbConfig;

	/**
	 * Loading configuration file
	 */
	public static function setConfig() {
		if (is_null(self::$dbConfig)) {
			$conf = require(SRC . DS . 'Config' . DS . 'db.conf.php');
			self::$connectionName = $conf['default'];
			self::$dbConfig = $conf[$conf['default']];
		}
	}

	/**
	 * Creating the connection to the database
	 */
	public static function makeConnection() {
		if (!is_null(self::$dbConfig)) {
			$db = new DB();
			$db->addConnection(
				[
					'driver'    => self::$dbConfig['driver'],
					'host'      => self::$dbConfig['host'],
					'port'      => self::$dbConfig['port'],
					'database'  => self::$dbConfig['dbName'],
					'username'  => self::$dbConfig['user'],
					'password'  => self::$dbConfig['pass'],
					'charset'   => self::$dbConfig['charset'],
					'collation' => self::$dbConfig['collation'],
					'prefix'    => self::$dbConfig['prefix']
				]
			);
			$db->setAsGlobal();
			$db->bootEloquent();
		}
	}

}
