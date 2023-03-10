<?php

class Users extends Controller
{
    function index()
    {
        if(!Auth::isLoggedIn()){
           $this->redirect('login');
        }
        $user = new User();
        $school_id = Auth::getSchool_id();
        $limit = 4;
        $pager = new Pager($limit);
        $offset = $pager->offset;
        $query = "SELECT  * FROM users WHERE school_id = :school_id && rank not in ('student') ORDER BY id DESC LIMIT $limit offset $offset";
        $arr = ['school_id'=>$school_id];

        if(isset($_GET['search'])){
            $find = '%' . $_GET['search'] . '%';
            $query = "SELECT  * FROM users WHERE school_id = :school_id && (last_name like :lname || first_name like :fname) && rank not in ('student') ORDER BY id DESC LIMIT $limit offset $offset";
            $arr = ['school_id'=>$school_id, 'fname' => $find, 'lname' => $find];
        }
        $users = $user->query($query, $arr);
        $crumbs[] = ['Dashboard', ROOT. '/'];
        $crumbs[] = ['Staff', ROOT. ''];

        if(Auth::access('reception')){
            $this->view('users', [
                'users' => $users,
                'crumbs' => $crumbs,
                'mode' => 'users',
                'pager'=>$pager
            ]);
        } else {
            $this->view('access-denied');
        }

    }
}
