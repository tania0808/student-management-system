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
                print_r($_POST);
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

    public function edit($id = null)
    {
        if(!Auth::isLoggedIn()){
            $this->redirect('login');
        }

        $errors = [];
        $school = new School();

        if(count($_POST) > 0){


            if($school->validate($_POST)) {
                $school->update($id, $_POST);
                $this->redirect('schools');
            } else {
                // errors
                $errors = $school->errors;
            }
        }
        $row = $school->where('id', $id);

        $this->view('schools.edit', [
            'errors' => $errors,
            'row'=>$row
        ]);
    }

    public function delete($id = null)
    {
        if(!Auth::isLoggedIn()){
            $this->redirect('login');
        }

        $school = new School();
        print_r($_POST);

        if(count($_POST) > 0){
            $school->delete('id', $id);
            $this->redirect('schools');
        }
        $row = $school->where('id', $id);

        $this->view('schools.delete', [
            'row'=>$row
        ]);
    }
}
