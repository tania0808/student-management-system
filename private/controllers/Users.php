<?php

class Users extends Controller
{
    function index()
    {
        if(!Auth::isLoggedIn()){
           $this->redirect('login');
        }
        $user = new User();
        $school_id = Auth::getSchool_id();
        $users = $user->query("SELECT  * FROM users WHERE school_id = :school_id", ['school_id'=>$school_id]);
        $crumbs[] = ['Dashboard', ROOT. '/'];
        $crumbs[] = ['Staff', ROOT. ''];
        $this->view('users', [
            'users' => $users,
            'crumbs' => $crumbs
        ]);
    }
}
