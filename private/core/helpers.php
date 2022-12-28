<?php

function get_var($key, $default = ""){
    if(isset($_POST[$key])){
        return $_POST[$key];
    }
    return $default;
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

function show($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function get_image($image, $gender = 'female'){
    if(!file_exists($image)){
        $image = ROOT . '/images/user_female.jpg';
        if($gender == 'male'){
            $image = ROOT . '/images/user_male.jpg';
        }
    }
    return $image;
}
