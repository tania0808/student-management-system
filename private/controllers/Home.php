<?php

class Home extends Controller
{
    function index(){
        $db = new Database();
        $user = $this->load_model('User');
        $data = $user->findAll();
        //$user = $user->where('first_name', 'Tania');


        $this->view('home', ['users' => $data]);
    }
}
