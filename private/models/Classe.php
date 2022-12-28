<?php
/*
 * School Model
 * It's here to interact with the users table
 */

class Classe extends Model
{
    protected $table = 'classes';

    protected $allowedColumns = [
        'class_name',
        'date',
    ];

    protected $beforeInsert = [
        'make_school_id',
        'make_class_id',
        'make_user_id',
    ];

    protected $afterSelect = [
        'get_user',
    ];

    public function validate($data)
    {
        $this->errors = [];

        // check for school name
        if (empty($data['class_name']) || !preg_match('/^[a-zA-Z çéèêÇÉÈÊË]+$/', $data['class_name'])) {
            $this->errors['class_name'] = 'Only letters are allowed in class name!';
        }

        if (count($this->errors) == 0) {
            return true;
        }
        return false;
    }

    public function make_user_id($data)
    {
        if(isset($_SESSION['USER']->student_id)){
            $data['user_id'] = $_SESSION['USER']->student_id;
        }
        return $data;
    }

    public function make_school_id($data)
    {
        if(isset($_SESSION['USER']->school_id)){
            $data['school_id'] = $_SESSION['USER']->school_id;
        }
        return $data;
    }

    public function make_class_id($data)
    {
        $data['class_id'] = generateRandomString();
        return $data;
    }

    public function get_user($data)
    {
        $user = new User();
        foreach ($data as $key => $row){

            $result = $user->where('student_id', $row->user_id);
            $data[$key]->user = is_array($result) ? $result[0] : false;
        }

        return $data;
    }

}