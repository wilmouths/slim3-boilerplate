<?php

use App\DatabaseFactory;

require '../vendor/autoload.php';

define('DS', DIRECTORY_SEPARATOR);
define('SRC', dirname(__DIR__) . DS . 'src');

DatabaseFactory::setConfig();
DatabaseFactory::makeConnection();

// Require files
require 'auth.php';