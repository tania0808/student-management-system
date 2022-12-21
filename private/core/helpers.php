<?php

function get_var($key){
    if(isset($_POST[$key])){
        return $_POST[$key];
    }
}

function get_select($key, $value){
    if(isset($_POST[$key])){
        if($_POST[$key] == $value){
            return 'selected';
        }
    }
    return '';
}

function escape($var){
    return htmlspecialchars($var);
}

function generateRandomString($length = 20) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

function get_date($date){
    return date('jS M, Y', strtotime($date));
}