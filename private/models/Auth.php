<?php

/*
 * Authentication class
 */
class Auth
{
    public static function authenticate($row) {
        $_SESSION['USER'] = $row;
    }

    public static function logout() {
        if(isset($_SESSION['USER'])){
            unset($_SESSION['USER']);
        }
    }

    public static function isLoggedIn() {
        if(isset($_SESSION['USER'])){
            return true;
        }
        return false;
    }
}