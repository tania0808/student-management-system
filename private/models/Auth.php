<?php

/*
 * Authentication class
 */
class Auth
{
    public static function authenticate($row) {
        $school = new School();
        $school_row = $school->where('school_id', $row->school_id);
        $row->school_name = $school_row[0]->school_name;
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

    public static function user() {
        if(isset($_SESSION['USER'])){
            return $_SESSION['USER']->first_name;
        }
        return false;
    }

    public static function __callStatic ($method, $params){
        $prop = strtolower(str_replace('get', '', $method));
        if(isset($_SESSION['USER']->$prop)){
            return $_SESSION['USER']->$prop;
        }
        return 'Unknown';
    }

    public static function switch_school($id) {
        if(isset($_SESSION['USER']) && $_SESSION['USER']->rank === 'super_admin'){
            $user = new User();
            $school = new School();
            $school_row = $school->where('id', $id);

            if($school_row){
                $school_row = $school_row[0];
                $arr['school_id'] = $school_row->school_id;
                if(!$user->update($_SESSION['USER']->id, $arr)){
                    $_SESSION['USER']->school_id = $school_row->school_id;
                    $_SESSION['USER']->school_name = $school_row->school_name;
                }

            }
            return true;
        }
        return false;
    }
}