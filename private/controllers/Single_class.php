<?php

class Single_class extends Controller
{
    function index($id = ''){
        if(!Auth::isLoggedIn()){
            $this->redirect('login');
        }

        $classes = new Classe();
        $row = $classes->first('class_id', $id);

        $crumbs[] = ['Dashboard', ROOT. '/'];
        $crumbs[] = ['Classes', ROOT . '/classes'];
        if($row) {
            $crumbs[] = [$row->class_name, ROOT . ''];
        }
        $page_tab = isset($_GET['tab']) ? $_GET['tab'] : 'lecturers';
        $lecturer = new Lecturer();
        $results = false;
        $error = '';

        if($page_tab == 'lecturers_add' && count($_POST) > 0) {
            if(isset($_POST['search'])){
                // find lecturer
                $user = new User();
                $name = "%" . trim($_POST['name']) . "%";
                $query = "SELECT * FROM users WHERE (last_name like :lname || first_name like :fname) && rank = 'lecturer' LIMIT 10";
                $results = $user->query($query, ['fname'=>$name, 'lname'=>$name]);
                //show($_SESSION['USER']);
            }

            if(isset($_POST['select'])){
                // add lecturer
                $user_id = $_POST['select'];
                $arr = [];
                $arr['user_id'] =  $user_id;
                $arr['class_id'] =  $id;
                $arr['disabled'] =  0;
                $arr['date'] =  date("y-m-d h:i:s");
                $is_user_exists = $lecturer->where('user_id', $user_id);
                if(count($is_user_exists) > 0){
                    $error = 'User already exists !';
                } else {

                    $lecturer->insert($arr);
                    $this->redirect("single_class/$id?tab=lecturers");
                }
            }
        } elseif($page_tab == 'lecturers') {
            // display lecturers
            $lecturers = $lecturer->where('class_id', $id);
            $data['lecturers'] = $lecturers;
        }

        $data['row'] = $row;
        $data['crumbs'] = $crumbs;
        $data['page_tab'] = $page_tab;
        $data['results'] = $results;
        $data['error'] = $error;

        $this->view('single_class', $data);
    }
}
