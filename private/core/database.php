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
        $result = false;

        if($statement){
            $check = $statement->execute($data);
            if($check){
                if($data_type == "object") {
                    $result = $statement->fetchAll(PDO::FETCH_OBJ);
                } else {
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                }
            }
        }
        // run functions after select
        if(is_array($result)){
            if(property_exists($this, 'afterSelect')){
                foreach ($this->afterSelect as $func)
                {
                    $result = $this->$func($result);
                }
            }
        }

        if(is_array($result) && count($result) > 0){
            return $result;
        }

        return false;
    }
}