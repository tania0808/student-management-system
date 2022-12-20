<?php

class Signup extends Controller
{
    function index()
    {
        $errors = [];

        if(count($_POST) > 0){
            $user = new User();

            if($user->validate($_POST)){
                $user_data = $_POST;
                unset($user_data['password2']);
                //$user_data['school_id'] = 10;
                $user_data['date'] = date("Y-m-d H:i:s");
                //$user_data['student_id'] = '10kjnhbgfekuiOPKF';
                $user_data['password'] = $_POST['password'];
                $user->insert($user_data);
                $this->redirect('login');
                echo $_POST;
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
