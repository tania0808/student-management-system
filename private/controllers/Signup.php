<?php

class Signup extends Controller
{
    function index()
    {
        $errors = [];
        $mode =  isset($_GET['mode']) ? $_GET['mode'] : 'users';

        if(count($_POST) > 0){
            $user = new User();

            if($user->validate($_POST)){
                $_POST['date'] = date("Y-m-d H:i:s");
                $user->insert($_POST);
                $redirect = $mode == 'students' ? 'students' : 'users';
                $this->redirect($redirect);
            } else {
                // errors
                $errors = $user->errors;
            }
        }

        $this->view('includes/signup', [
            'errors'=>$errors,
            'mode' => $mode,
        ]);
    }
}
