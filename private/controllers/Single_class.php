<?php

class Single_class extends Controller
{
    function index($id = ''){
        $classes = new Classe();
        $row = $classes->first('class_id', $id);

        $crumbs[] = ['Dashboard', ROOT. '/'];
        $crumbs[] = ['Classes', ROOT . '/classes'];
        if($row) {
            $crumbs[] = [$row->class_name, ROOT . ''];
        }
        $page_tab = isset($_GET['tab']) ? $_GET['tab'] : 'lecturers';
        $results = false;

        if($page_tab == 'lecturers_add' && count($_POST) > 0) {
            //add lecturer
            $user = new User();
            $name = "%" . $_POST['name'] . "%";
            $query = "SELECT * FROM users WHERE (last_name like :lname || first_name like :fname) && rank = 'lecturer' LIMIT 10";
            $results = $user->query($query, ['fname'=>$name, 'lname'=>$name]);
        }


        $this->view('single_class', [
            'row'=>$row,
            'crumbs' => $crumbs,
            'page_tab' => $page_tab,
            'results' => $results
        ]);
    }
}
