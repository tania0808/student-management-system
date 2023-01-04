<?php

class Students extends Controller
{
    function index()
    {
        if(!Auth::isLoggedIn()){
            $this->redirect('login');
        }
        $user = new User();
        $school_id = Auth::getSchool_id();

        $limit = 10;
        //$page_number = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        //$page_number = $page_number < 1 ? 1 : $page_number;
        $pager = new Pager($limit);
        $offset = $pager->offset;


        $query = "SELECT  * FROM users WHERE school_id = :school_id && rank in ('student') ORDER BY id DESC LIMIT $limit offset $offset";
        $arr = ['school_id'=>$school_id];
        if(isset($_GET['search'])){
            $find = '%' . $_GET['search'] . '%';
            $query = "SELECT * FROM users WHERE school_id = :school_id && (last_name like :lname || first_name like :fname) && rank in ('student') ORDER BY id DESC ";
            $arr = ['school_id'=>$school_id, 'fname' => $find, 'lname' => $find];
        }
        $users = $user->query($query, $arr);
        $crumbs[] = ['Dashboard', ROOT. '/'];
        $crumbs[] = ['Students', ROOT. ''];

        if(Auth::access('reception')){
            $this->view('students', [
                'users' => $users,
                'crumbs' => $crumbs,
                'mode' => 'students',
                'pager'=>$pager
            ]);
        } else {
            $this->view('access-denied');
        }

    }
}
