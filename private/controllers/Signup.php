<?php

class Signup extends Controller
{
    function index()
    {
        if(!Auth::isLoggedIn()){
            $this->redirect('login');
        }

        $errors = [];
        $mode =  isset($_GET['mode']) ? $_GET['mode'] : 'users';

        if(count($_POST) > 0){
            $user = new User();

            if($user->validate($_POST)){
                $_POST['date'] = date("Y-m-d H:i:s");
                if(Auth::access('reception')){
                    if($_POST['rank'] == 'super_admin' && $_SESSION['USER']->rank != 'super_admin' ){
                        $_POST['rank'] == 'admin';
                    }
                    $user->insert($_POST);
                }
                $redirect = $mode == 'students' ? 'students' : 'users';
                $this->redirect($redirect);
            } else {
                // errors
                $errors = $user->errors;
            }
        }
        if(Auth::access('reception')){
            $this->view('includes/signup', [
                'errors'=>$errors,
                'mode' => $mode,
            ]);
        } else {
            $this->view('access-denied');
        }

    }
}
