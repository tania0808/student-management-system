<?php

class Students extends Controller
{
    function index($id = null){
        $this->view('students');
    }
}
