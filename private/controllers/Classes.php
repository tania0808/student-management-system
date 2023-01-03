<?php

class Classes extends Controller
{
    public function index()
    {
        if (!Auth::isLoggedIn()) {
            $this->redirect('login');
        }
        $classes = new Classe();

        $school_id = Auth::getSchool_id();
        if (Auth::access('admin')) {
            $query = "SELECT  * FROM classes WHERE school_id = :school_id ORDER BY id DESC ";
            $arr =  ['school_id' => $school_id];
            if(isset($_GET['search'])){
                $find = '%' . $_GET['search'] . '%';
                $query = "SELECT  * FROM classes WHERE school_id = :school_id && class_name like :class_name ORDER BY id DESC ";
                $arr = ['school_id'=>$school_id, 'class_name' => $find];
            }
            $data = $classes->query($query, $arr);
        } else {
            $class = new Classe();
            $mytable = 'students';

            if (Auth::getRank() == 'lecturer') {
                $mytable = 'lecturers';
            }

            $query = "SELECT * FROM $mytable WHERE user_id = :user_id && disabled = 0";
            $arr['stud_classes'] = $class->query($query, ['user_id' => Auth::getStudent_id()]);
            $data = [];

            if ($arr['stud_classes']) {
                foreach ($arr['stud_classes'] as $key => $value) {
                    $data[] = $class->first('class_id', $value->class_id);
                }
            }
        }
        $crumbs[] = ['Dashboard', ROOT . '/'];
        $crumbs[] = ['Classes', ROOT . '/classes'];
        $this->view('classes', [
            'classes' => $data,
            'crumbs' => $crumbs
        ]);
    }

    public
    function add()
    {
        if (!Auth::isLoggedIn()) {
            $this->redirect('login');
        }

        $errors = [];

        if (count($_POST) > 0) {

            $class = new Classe();

            if ($class->validate($_POST)) {
                $_POST['date'] = date("Y-m-d H:i:s");
                print_r($_POST);
                $class->insert($_POST);
                $this->redirect('classes');
            } else {
                // errors
                $errors = $class->errors;
            }
        }
        $crumbs[] = ['Dashboard', ROOT . '/'];
        $crumbs[] = ['Classes', ROOT . '/classes'];
        $crumbs[] = ['Add', ROOT . '/classes/add'];
        $this->view('classes.add', [
            'errors' => $errors,
            'crumbs' => $crumbs
        ]);
    }

    public
    function edit($id = null)
    {
        if (!Auth::isLoggedIn()) {
            $this->redirect('login');
        }

        $errors = [];
        $class = new Classe();
        $row = $class->where('id', $id);

        if (count($_POST) > 0 && Auth::access('lecturer') && Auth::i_own_content($row)) {
            if ($class->validate($_POST)) {
                $class->update($id, $_POST);
                $this->redirect('classes');
            } else {
                // errors
                $errors = $class->errors;
            }
        }

        $crumbs[] = ['Dashboard', ROOT . '/'];
        $crumbs[] = ['Classes', ROOT . '/classes'];
        $crumbs[] = ['Edit', ROOT . ''];

        if (Auth::access('lecturer') && Auth::i_own_content($row)) {
            $this->view('classes.edit', [
                'errors' => $errors,
                'row' => $row,
                'crumbs' => $crumbs
            ]);
        } else {
            $this->view('access-denied');
        }


    }

    public
    function delete($id = null)
    {
        if (!Auth::isLoggedIn()) {
            $this->redirect('login');
        }
        $class = new Classe();

        if (count($_POST) > 0 && Auth::access('lecturer')) {
            $class->delete('id', $id);
            $this->redirect('classes');
        }
        $row = $class->where('id', $id);

        $crumbs[] = ['Dashboard', ROOT . '/'];
        $crumbs[] = ['Classes', ROOT . '/classes'];
        $crumbs[] = ['Delete', ''];

        if (Auth::access('lecturer') && Auth::i_own_content($row)) {
            $this->view('classes.delete', [
                'row' => $row,
                'crumbs' => $crumbs
            ]);
        } else {
            $this->view('access-denied');
        }

    }


}
