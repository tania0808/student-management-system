<?php

class Home extends Controller
{
    function index()
    {
        if(!Auth::isLoggedIn()){
           $this->redirect('login');
        }
        $user = new User();
        $data = $user->findAll();

        $this->view('home', ['users' => $data]);
    }
}
