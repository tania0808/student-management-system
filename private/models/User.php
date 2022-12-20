<?php
/*
 * User Model
 * It's here to interact with the users table
 */

class User extends Model
{
    protected $table = 'users';

    protected $allowedColumns = [
        'first_name',
        'last_name',
        'email',
        'password',
        'gender',
        'rank',
        'date'
    ];

    protected $beforeInsert = [
        'make_user_id',
        'make_school_id',
        'hash_password'
    ];

    public function validate($data)
    {
        $this->errors = [];

        // check for first name
        if (empty($data['first_name']) || !preg_match('/^[a-zA-Z]+$/', $data['first_name'])) {
            $this->errors['first_name'] = 'Only letters allowed in first name!';
        }

        // check for last name
        if (empty($data['last_name']) || !preg_match('/^[a-zA-Z]+$/', $data['last_name'])) {
            $this->errors['last_name'] = 'Only letters allowed in last name!';
        }

        // check for email
        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Email is not valid !';
        }

        // check for password
        if (empty($data['password']) || $data['password'] != $data['password2']) {
            $this->errors['password'] = 'The passwords did not match!';
        }
        if (strlen($data['password']) <= 8) {
            $this->errors['password'] = 'Password must be at least 8 characters long !';
        }

        // check for gender
        $genders = ['female', 'male'];

        if (empty($data['gender']) || !in_array($data['gender'], $genders)) {
            $this->errors['gender'] = 'Gender is not valid !';
        }

        // check for rank
        $ranks = ['student', 'reception', 'lecturer', 'admin', 'super_admin'];

        if (empty($data['rank']) || !in_array($data['rank'], $ranks)) {
            $this->errors['rank'] = 'Rank is not valid !';
        }

        if (count($this->errors) == 0) {
            return true;
        }
        return false;
    }

    public function make_user_id($data)
    {
        $data['student_id'] = $this->generateRandomString();
        return $data;
    }

    public function make_school_id($data)
    {
        $data['school_id'] = $this->generateRandomString();
        return $data;
    }

    public function hash_password($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $data;
    }

    public function generateRandomString($length = 20) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

}