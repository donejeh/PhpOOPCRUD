<?php
class Employee{
 
    // database connection and table name
    private $conn;
    private $table_name = "employee";
 
    // object properties
    public $employeeid;
    public $fname;
    public $lname;
    public $oname;
    public $title;
    public $gender;
    public $marital_status;
    public $dob;
    public $stateid;
    public $rankid;    
    
    public function __construct($db){
        $this->conn = $db;
    }
 
    // create employee
    function create(){
 
        // to get time-stamp for 'created' field
        $this->getTimestamp();
 
        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    employeeid = ?, fname = ?, lname = ?, oname = ?, title = ?, gender = ?, marital_status = ?, dob = ?, stateid = ?, rankid = ?";
 
        $stmt = $this->conn->prepare($query);
 
        $stmt->bindParam(1, $this->employeeid);
        $stmt->bindParam(2, $this->fname);
        $stmt->bindParam(3, $this->lname);
        $stmt->bindParam(4, $this->oname);
        $stmt->bindParam(5, $this->title);
        $stmt->bindParam(6, $this->gender);
        $stmt->bindParam(7, $this->marital_status);
        $stmt->bindParam(8, $this->dob);
        $stmt->bindParam(9, $this->stateid);
        $stmt->bindParam(10, $this->rankid);
 
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
 
    }

    // used for the 'created' field when creating a employee
    function getTimestamp(){
    date_default_timezone_set('Asia/Manila');
    $this->timestamp = date('Y-m-d H:i:s');
    }


    function readAll($page, $from_record_num, $records_per_page){
 
    $query = "SELECT
                employeeid, fname, lname, oname, title, gender, marital_status, dob, stateid,rankid
            FROM
                " . $this->table_name . "
            ORDER BY
                fname ASC
            LIMIT
                {$from_record_num}, {$records_per_page}";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    return $stmt;
    
    }

        // used for paging employee
    public function countAll(){
 
    $query = "SELECT employeeid FROM " . $this->table_name . "";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    $num = $stmt->rowCount();
 
    return $num;
}

    function readOne(){
 
    $query = "SELECT
                fname, lname, oname, title, gender, marital_status, dob, stateid,rankid
            FROM
                " . $this->table_name . "
            WHERE
                employeeid = ?
            LIMIT
                0,1";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->employeeid);
    $stmt->execute();
 
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    $this->fname = $row['fname'];
    $this->lname = $row['lname'];
    $this->oname = $row['oname'];
    $this->title = $row['title'];
    $this->gender = $row['gender'];
    $this->marital_status = $row['marital_status'];
    $this->dob = $row['dob'];
    $this->stateid = $row['stateid'];
    $this->rankid = $row['rankid'];
}

    function update(){
 
    $query = "UPDATE
                " . $this->table_name . "
            SET
                employeeid = :employeeid,
                fname = :fname,
                lname = :lname,
                oname = :oname,
                title = :title,
                gender = :gender,
                marital_status = :marital_status,
                dob = :dob,
                stateid = :stateid,
                rankid  = :rankid
            WHERE
                employeeid = :employeeid";
 
    $stmt = $this->conn->prepare($query);
 
    $stmt->bindParam(':fname', $this->fname);
    $stmt->bindParam(':lname', $this->lname);
    $stmt->bindParam(':oname', $this->oname);
    $stmt->bindParam(':title', $this->title);
    $stmt->bindParam(':gender', $this->gender);
    $stmt->bindParam(':marital_status', $this->marital_status);
    $stmt->bindParam(':dob', $this->dob);
    $stmt->bindParam(':stateid', $this->stateid);
    $stmt->bindParam(':rankid', $this->rankid);
    $stmt->bindParam(':employeeid', $this->employeeid);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}
    

    // delete the employee
    function delete(){
 
    $query = "DELETE FROM " . $this->table_name . " WHERE employeeid = ?";
     
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->employeeid);
 
    if($result = $stmt->execute()){
        return true;
    }else{
        return false;
    }
}

}
?>