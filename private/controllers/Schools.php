<?php

class Schools extends Controller
{
    public function index()
    {
        if(!Auth::isLoggedIn()){
           $this->redirect('login');
        }
        $schools = new School();
        $data = $schools->findAll();

        $this->view('schools', ['schools' => $data]);
    }

    public function add()
    {
        if(!Auth::isLoggedIn()){
            $this->redirect('login');
        }

        $errors = [];

        if(count($_POST) > 0){

            $school = new School();

            if($school->validate($_POST)) {
                $_POST['date'] = date("Y-m-d H:i:s");
                $school->insert($_POST);
                $this->redirect('schools');
            } else {
                // errors
                $errors = $school->errors;
            }
        }
        $this->view('schools.add', [
            'errors' => $errors
        ]);
    }

}
