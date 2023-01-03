<?php

class Switch_school extends Controller
{
    function index($id = '')
    {
        if(Auth::access('super_admin')){
            Auth::switch_school($id);
            $this->redirect('schools');
        } else {
            $this->view('access-denied');
        }
    }
}
