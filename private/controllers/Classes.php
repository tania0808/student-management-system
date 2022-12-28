<?php

class Classes extends Controller
{
    public function index()
    {
        if(!Auth::isLoggedIn()){
           $this->redirect('login');
        }
        $classes = new Classe();
        $data = $classes->findAll();
        $crumbs[] = ['Dashboard',  ROOT. '/'];
        $crumbs[] = ['Classes',  ROOT. '/classes'];
        $this->view('classes', [
            'classes' => $data,
            'crumbs'=>$crumbs
        ]);
    }

    public function add()
    {
        if(!Auth::isLoggedIn()){
            $this->redirect('login');
        }

        $errors = [];

        if(count($_POST) > 0){

            $class = new Classe();

            if($class->validate($_POST)) {
                $_POST['date'] = date("Y-m-d H:i:s");
                print_r($_POST);
                $class->insert($_POST);
                $this->redirect('classes');
            } else {
                // errors
                $errors = $class->errors;
            }
        }
        $crumbs[] = ['Dashboard',  ROOT. '/'];
        $crumbs[] = ['Classes',  ROOT. '/classes'];
        $crumbs[] = ['Add',  ROOT. '/classes/add'];
        $this->view('classes.add', [
            'errors' => $errors,
            'crumbs'=>$crumbs
        ]);
    }

    public function edit($id = null)
    {
        if(!Auth::isLoggedIn()){
            $this->redirect('login');
        }

        $errors = [];
        $class = new Classe();

        if(count($_POST) > 0){


            if($class->validate($_POST)) {
                $class->update($id, $_POST);
                $this->redirect('classes');
            } else {
                // errors
                $errors = $class->errors;
            }
        }
        $row = $class->where('id', $id);

        $crumbs[] = ['Dashboard', ROOT. '/'];
        $crumbs[] = ['Classes', ROOT. '/classes'];
        $crumbs[] = ['Edit',  ROOT. ''];
        $this->view('classes.edit', [
            'errors' => $errors,
            'row'=>$row,
            'crumbs'=>$crumbs
        ]);
    }

    public function delete($id = null)
    {
        if(!Auth::isLoggedIn()){
            $this->redirect('login');
        }

        $class = new Classe();
        print_r($_POST);

        if(count($_POST) > 0){
            $class->delete('id', $id);
            $this->redirect('classes');
        }
        $row = $class->where('id', $id);

        $crumbs[] = ['Dashboard',  ROOT. '/'];
        $crumbs[] = ['Classes',  ROOT. '/classes'];
        $crumbs[] = ['Delete', ''];
        $this->view('classes.delete', [
            'row'=>$row,
            'crumbs'=>$crumbs
        ]);
    }
}