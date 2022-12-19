<?php

class Signup extends Controller
{
    function index()
    {
        $errors = [];

        if(count($_POST) > 0){
            $user = new User();

            if($user->validate($_POST)){
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
