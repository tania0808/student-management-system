<?php

class Students extends Controller
{
    function index($id = null){
        echo $this->view('students');
    }
}
