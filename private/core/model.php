<?php

class Model extends Database
{
    public $errors = [];

    public function __construct()
    {
        if (property_exists($this, 'table')) {
            $this->table = strtolower($this::class) . "s";
        }
    }


    public function where($column, $value, $orderby = 'desc')
    {
        $column = addslashes($column);
        $query = "SELECT * FROM $this->table WHERE $column = :value ORDER BY id $orderby";

        $data = $this->query($query, [
            'value' => $value
        ]);

        // run functions after select
        if(is_array($data)){
            if(property_exists($this, 'afterSelect')){
                foreach ($this->afterSelect as $func)
                {
                    $data = $this->$func($data);
                }
            }
        }
        return $data;
    }

    public function first($column, $value)
    {
        $column = addslashes($column);
        $query = "SELECT * FROM $this->table WHERE $column = :value";

        $data = $this->query($query, [
            'value' => $value
        ]);

        // run functions after select
        if(is_array($data)){
            if(property_exists($this, 'afterSelect')){
                foreach ($this->afterSelect as $func)
                {
                    $data = $this->$func($data);
                }
            }
        }
        if(is_array($data)){
            $data = $data[0];
        }
        return $data;
    }

    public function findAll($order = 'desc')
    {
        $query = "SELECT * FROM $this->table ORDER BY id $order";
        $data = $this->query($query);

        // run functions after select
        if(is_array($data)){
            if(property_exists($this, 'afterSelect')){
                foreach ($this->afterSelect as $func)
                {
                    $data = $this->$func($data);
                }
            }
        }
        return $data;
    }

    public function insert($data)
    {
        // remove unwanted columns
        if(property_exists($this, 'allowedColumns')){
            foreach ($data as $key => $column)
            {
                if(!in_array($key, $this->allowedColumns)){
                    unset($data[$key]);
                }
            }
        }

        // run functions before insert
        if(property_exists($this, 'beforeInsert')){
            foreach ($this->beforeInsert as $func)
            {
                $data = $this->$func($data);
            }
        }

        $keys = array_keys($data);
        $columns = implode(', ', $keys);
        $values = implode(', :', $keys);
        $query = "INSERT INTO $this->table ($columns) VALUES (:$values)";

        return $this->query($query, $data);
    }

    public function update($id, $data)
    {
        // remove unwanted columns
        if(property_exists($this, 'allowedColumns')){
            foreach ($data as $key => $column)
            {
                if(!in_array($key, $this->allowedColumns)){
                    unset($data[$key]);
                }
            }
        }

        // run functions before insert
        if(property_exists($this, 'beforeUpdate')){
            foreach ($this->beforeUpdate as $func)
            {
                $data = $this->$func($data);
            }
        }

        $str = "";
        foreach ($data as $key => $value) {
            $str .= $key . ' = :'. $key . ', ';
        }

        $str = rtrim($str, ', ');
        $data['id'] = $id;
        $query = "UPDATE $this->table SET $str WHERE id = :id";
        return $this->query($query, $data);
    }

    public function delete($column, $value)
    {
        $query = "DELETE FROM $this->table WHERE $column = :value";
        return $this->query($query, [
            'value' => $value
        ]);
    }


}