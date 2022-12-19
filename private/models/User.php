<?php
/*
 * User Model
 * It's here to interact with the users table
 */

class User extends Model
{
    protected $table = 'users';
    public function validate($data)
    {
        $this->errors = [];

        // check for first name
        if(empty($data['firstname']) || !preg_match('/^[a-zA-Z]+$/', $data['firstname'])){
            $this->errors['firstname'] = 'Only letters allowed in first name!';
        }

        // check for last name
        if(empty($data['lastname']) || !preg_match('/^[a-zA-Z]+$/', $data['lastname'])){
            $this->errors['lastname'] = 'Only letters allowed in last name!';
        }

        // check for email
        if(empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            $this->errors['email'] = 'Email is not valid !';
        }

        // check for password
        if(empty($data['password']) || $data['password'] != $data['password2']){
            $this->errors['password'] = 'The passwords did not match!';
        }
        if(strlen($data['password']) <= 8){
            $this->errors['password'] = 'Password must be at least 8 characters long !';
        }

        // check for gender
        $genders = ['female', 'male'];

        if(empty($data['gender']) || !in_array($data['gender'], $genders) ){
            $this->errors['gender'] = 'Gender is not valid !';
        }

        // check for rank
        $ranks = ['student', 'reception', 'lecturer', 'admin', 'super_admin'];

        if(empty($data['rank']) || !in_array($data['rank'], $ranks) ){
            $this->errors['rank'] = 'Rank is not valid !';
        }

        if(count($this->errors) == 0){
            return true;
        }
        return false;
    }

}