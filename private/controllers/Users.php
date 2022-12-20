<?php

class Users extends Controller
{
    function index()
    {
        if(!Auth::isLoggedIn()){
           $this->redirect('login');
        }
        $user = new User();
        $users = $user->findAll();
        $this->view('users', [
            'users' => $users
        ]);
    }
}
