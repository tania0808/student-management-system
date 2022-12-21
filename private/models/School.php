<?php
/*
 * School Model
 * It's here to interact with the users table
 */

class School extends Model
{
    protected $table = 'schools';

    protected $allowedColumns = [
        'school_name',
        'date',
    ];

    protected $beforeInsert = [
        'make_school_id',
        'make_user_id',
    ];

    public function validate($data)
    {
        $this->errors = [];

        // check for school name
        if (empty($data['school_name']) || !preg_match('/^[a-zA-Z çéèêÇÉÈÊË]+$/', $data['school_name'])) {
            $this->errors['school_name'] = 'Only letters allowed in school name!';
        }

        if (count($this->errors) == 0) {
            return true;
        }
        return false;
    }

    public function make_user_id($data)
    {
        if(isset($_SESSION['USER'])){
            $data['user_id'] = $_SESSION['USER']->student_id;
        }
        return $data;
    }

    public function make_school_id($data)
    {
        $data['school_id'] = generateRandomString();
        return $data;
    }

}