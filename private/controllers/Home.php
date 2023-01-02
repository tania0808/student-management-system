<?php

class Home extends Controller
{
    function index()
    {
        if(!Auth::isLoggedIn()){
           $this->redirect('login');
        }

        $this->view('home');
    }
}
