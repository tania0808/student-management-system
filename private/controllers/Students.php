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
        $users = $user->query("SELECT  * FROM users WHERE school_id = :school_id && rank in ('student') ORDER BY id DESC " , ['school_id'=>$school_id]);
        $crumbs[] = ['Dashboard', ROOT. '/'];
        $crumbs[] = ['Students', ROOT. ''];

        if(Auth::access('reception')){
            $this->view('students', [
                'users' => $users,
                'crumbs' => $crumbs,
                'mode' => 'students',
            ]);
        } else {
            $this->view('access-denied');
        }

    }
}
