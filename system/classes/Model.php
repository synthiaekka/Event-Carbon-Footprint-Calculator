<?php

class Model {

    private $host = HOST;
    private $user = USER;
    private $database = DATABASE;
    private $password = PASSWORD;

    public $con;

    public $obj;

    public function __construct () {

        $host = $this->host;
        $user = $this->user;
        $db = $this->database;
        $pswd = $this->password; 
        
        try{
            $this->con = new PDO('mysql:host='.$host.';dbname='.$db, $user, $pswd);
        } catch (PDOException $e) {
            showDBConnectionError($e);
        }
    }

    // for making database queries
    public function query ($qry, $params = []) {
        if(empty($params)) {
            $result = $this->con->prepare($qry);
            if ($result->execute()) {
                return $result->fetchAll();
            }
            return array();  
        } else {
            $result = $this->con->prepare($qry);
            if($result->execute($params)) { 
                return $result->fetchAll();
            }
            return array();
        }
    }

    // function to search one field with a condition
    public function fetch (string $field) {
        $this->obj = "SELECT `$field` FROM `$this->table` WHERE ";

        // return $this so, this can be chained with ->where()
        return $this;
    }

    // this function can only be chained with fetch()
    public function where (string $condition) {
        
    }


    // for fetching all records
    public function fetchall () {
        return $this->con->query("SELECT * FROM `$this->table` WHERE 1")->fetchAll();
    }

    // create a function to fetch selective values


    // function to insert into database
    public function insert ($inserts) {
        $columns = [];
        $values = [];

        foreach ($inserts as $column => $value) {
            $columns[] = $column;
            $values[] = $value;
        }

        $query = "insert into $this->table (";

        foreach($columns as $key => $column) {

            if ($key == 0) {
                $query .= "$column";
            }
            else {
                $query .= ",$column";
            }
        }

        $query .= ") values (";

        foreach ($values as $key => $value) {
            if ($key == 0) {
                $query .= "?";
            }
            else {
                $query .= ",?";
            }
        }

        $query .= ")";

        $prepared = $this->con->prepare($query);
        return $prepared->execute($values);
    }

    
}