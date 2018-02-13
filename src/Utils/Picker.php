<?php

namespace App\Utils;

/**
 * Paginator.php
 *
 * Get vars in configuration files
 *
 * @package    Utils
 * @author     WILMOUTH Steven
 * @version    1
 */
class Picker
{

    /**
     * Get var in configuration file
     * @param string $var Configuration name and var name (config.var)
     * @return string
     */
    public static function get($var)
    {
        $datas = array();
        $vars = explode('.', $var);
        $p = SRC . DS . 'Config' . DS . $vars[0] . '.conf.php';
        if (file_exists($p))
        {
            $datas = require $p;
            if (array_key_exists($vars[1], $datas))
            {
                return $datas[$vars[1]];
            } else {
                return "VARIABLE_NOT_FOUND";
            }
        } else {
            return "VARIABLE_NOT_FOUND";
        }
    }

}