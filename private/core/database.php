<?php
/*
 * Database connection
 */
class Database
{
    private $db_host = DB_HOST;
    private $db_name = DB_NAME;
    private $db_username = DB_USERNAME;
    private $db_pwd = DB_PWD;

    private function connect()
    {
        $dsn = "mysql:host=$this->db_host;dbname=$this->db_name";
        if(!$connection = new PDO($dsn, $this->db_username, $this->db_pwd)){
            die('Could not connect to the database');
        }

        return $connection;
    }

    public function query ($query, $data = [], $data_type = "object")
    {
        $connection = $this->connect();
        $statement = $connection->prepare($query);
        if($statement){
            $check = $statement->execute($data);
            if($check){
                if($data_type == "object") {
                    $data = $statement->fetchAll(PDO::FETCH_OBJ);
                } else {
                    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
                }

                if(is_array($data) && count($data) > 0){
                    return $data;
                }
            }
        }
        return false;
    }
}