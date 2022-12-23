<?php

class Profile extends Controller
{
    function index($id = ''){
        $user = new User();
        $row = $user->first('student_id', $id);
        $crumbs[] = ['Dashboard', ROOT. '/'];
        if($row) {
            $crumbs[] = ['Profile', ROOT . '/profile/' . $row->student_id];
            $crumbs[] = [$row->first_name, ROOT . ''];
        }
        $this->view('profile', [
            'user'=>$row,
            'crumbs' => $crumbs
        ]);
    }
}
