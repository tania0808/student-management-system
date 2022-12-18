<?php

class Home extends Controller
{
    function index()
    {

        $user = new User();
        $arr = [
            "first_name" => "Tania",
            "last_name" => "His",
            "date" =>date("Y-m-d H:i:s"),
            "student_id" => "uicfghkdnjk98jhg56",
            "gender" => "female",
            "school_id" => "67",
            "rank" => "student"
        ];

        //$user->insert($arr);
        $data = $user->findAll();

        //$user = $user->where('first_name', 'Tania');
        $user->update(3, $arr);
        //$user->delete('student_id', 'uicfghkdnjk98jhg56');


        $this->view('home', ['users' => $data]);
    }
}
