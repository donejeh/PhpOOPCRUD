<?php

class State{
 
    // database connection and table name
    private $conn;
    private $table_name = "state";
 
    // object properties
    public $stateid;
    public $statename;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used by select drop-down list
    function read(){
        //select all data
        $query = "SELECT
                    stateid, statename
                FROM
                    " . $this->table_name . "
                ORDER BY
                    statename";  
 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }

        function readName(){

        $query = "SELECT statename FROM " . $this->table_name . " WHERE stateid = ? limit 0,1";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->stateid);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->statename = $row['statename'];

}
}
?>