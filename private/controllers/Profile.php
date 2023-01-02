<?php

class Profile extends Controller
{
    function index($id = ''){
        $id = trim($id == '') ? Auth::getStudent_id() : $id;


        $user = new User();
        $row = $user->first('student_id', $id);
        $crumbs[] = ['Dashboard', ROOT. '/'];
        if($row) {
            $crumbs[] = ['Profile', ROOT . '/profile/' . $row->student_id];
            $crumbs[] = [$row->first_name, ROOT . ''];
        }

        $data['page_tab'] = isset($_GET['tab']) ?  $_GET['tab'] : 'infos';

        if($data['page_tab'] == 'classes'){
            $class = new Classe();

            if($row->rank == 'student'){

                $student = new Student();
                $query = "SELECT * FROM students WHERE user_id = :user_id && disabled = 0";
                $data['stud_classes'] = $student->query($query, ['user_id' => $id]);

                $data['student_classes'] = [];

                if($data['stud_classes']){
                    foreach ($data['stud_classes'] as $key => $value){
                        $data['student_classes'][] = $class->first('class_id', $value->class_id);
                    }
                }
            } else {
                $lecturer = new Lecturer();
                $query = "SELECT * FROM lecturers WHERE user_id = :user_id && disabled = 0";
                $data['lect_classes'] = $lecturer->query($query, ['user_id' => $id]);
                $data['lecturer_classes'] = [];

                if(isset($data['lect_classes']) ){
                    foreach ($data['lect_classes'] as $key => $value){
                        $data['lecturer_classes'][] = $class->first('class_id', $value->class_id);
                    }
                }
            }


        }


        $data['user'] = $row;
        $data['crumbs'] = $crumbs;
        $data['id'] = $id;

        $this->view('profile', $data);
    }
}
