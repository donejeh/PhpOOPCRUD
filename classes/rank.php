<?php

class Rank{
 
    // database connection and table name
    private $conn;
    private $table_name = "rank";
 
    // object properties
    public $rankid;
    public $rankname;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used by select drop-down list
    function read(){
        //select all data
        $query = "SELECT
                    rankid, rankname
                FROM
                    " . $this->table_name . "
                ORDER BY
                    rankname";  
 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }

        function readName(){

        $query = "SELECT rankname FROM " . $this->table_name . " WHERE rankid = ? limit 0,1";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->rankid);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->rankname = $row['rankname'];

}
}
?>