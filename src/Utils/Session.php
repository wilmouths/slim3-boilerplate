<?php

namespace App\Utils;

/**
 * Session.php
 *
 * Session manager
 *
 * @package    Utils
 * @author     WILMOUTH Steven
 * @version    1
 */
class Session
{
    /**
	 * Initialize the session
	 */
    public static function initSession()
    {
        if (!isset($_SESSION))
        {
            session_start();
        }
    }

    /**
     * Get session by key
     * @param null $key
     * @return bool
     */
    public static function get($key = null)
    {
        if (empty($key))
        {
            return $_SESSION;
        }
        else {
            if (isset($_SESSION[$key])) {
                return $_SESSION[$key];
            } else {
                return false;
            }
        }
    }

    /**
     * Update session by key
     * @param String $key
     * @param Object $value array, int, string ...
     * @return mixed
     */
    public static function set($key, $value)
    {
        if (empty($key))
        {
            return $_SESSION;
        }
        else {
            $_SESSION[$key] = $value;
        }
    }

    /**
     * Destroy all session
     */
    public static function destroy()
    {
        session_destroy();
    }

    /**
     * Destroy one session by key
     * @param string $key
     */
    public static function unset($key)
    {
        unset($_SESSION[$key]);
    }

    /**
     * Lets you know if a user is logged in
     * @param string $key
     * @return bool
     */
    public static function isLogged($key)
    {
        return self::exist($key);
    }

    /**
     * Lets you know if a session exists
     * @param $key
     * @return bool
     */
    public static function exist($key)
    {
        if (isset($_SESSION[$key]))
        {
            return true;
        } else {
            return false;
        }
    }

}
