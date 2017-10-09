<?php
// check if value was posted
if($_POST){
 
    // include database and object file
    include_once 'config/database.php';
    include_once 'classes/employee.php';
 
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
 
    // prepare employee object
    $employee = new Employee($db);
     
    // set employee id to be deleted
    $employee->employeeid = $_POST['object_id'];
     
    // delete the employee
    if($employee->delete()){
        echo "Object was deleted.";
    }
     
    // if unable to delete the employee
    else{
        echo "Unable to delete employee.";
         
    }
}
?>