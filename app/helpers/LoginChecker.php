<?php
class LoginChecker
{
    private static function isLoggedIn($entity)
    {
        if (!isset($_COOKIE[session_name()])) return false;
        if (session_id() == '') {
            session_start();
        }
        if (!isset($_SESSION[$entity])) return false;
        return true;
    }


    public static function checkUserIsLoggedInOrRedirect($entity,  $location = "/")
    {
        if (self::isLoggedIn($entity)) {
            return true;
        };
        header("Location: $location");
        exit;
    }
}
