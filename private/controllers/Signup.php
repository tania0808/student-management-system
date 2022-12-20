<?php

class Signup extends Controller
{
    function index()
    {
        $errors = [];

        if(count($_POST) > 0){
            $user = new User();

            if($user->validate($_POST)){
                $_POST['date'] = date("Y-m-d H:i:s");

                $user->insert($_POST);
                $this->redirect('login');
            } else {
                // errors
                $errors = $user->errors;
            }
        }

        $this->view('includes/signup', [
            'errors'=>$errors,
        ]);
    }
}
