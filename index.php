<?php
// NAME: DON_EJEH
// WEBSITE: www.zariaBlog.com
// Reg_No: U12CS1100
$page_title = "Employee Crud";
include_once "header.php";

echo "<div class='right-button-margin'>";
    echo "<a href='create_employee.php' class='btn btn-primary pull-right'>Create Employee</a>";
echo "</div>";

// page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// set number of records per page
$records_per_page = 5;

// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;

// include database and object/classes files
include_once 'config/database.php';
include_once 'classes/employee.php';
include_once 'classes/state.php';
include_once 'classes/rank.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

$employee = new Employee($db);

// query products
$stmt = $employee->readAll($page, $from_record_num, $records_per_page);
$num = $stmt->rowCount();

// display the products if there are any
if($num>0){

    $state = new State($db);
    $rank = new Rank($db);

    

    echo "<table class='table table-hover table-responsive table-bordered tabBody' >";
        echo "<tr class='headTr'>";
            echo "<th>S/N</th>";
            echo "<th>Employee Id</th>";
            echo "<th>First Name</th>";
            echo "<th>Middle Name</th>";
            echo "<th>Last Name</th>";
            echo "<th>Title</th>";
            echo "<th>Gender</th>";
            echo "<th>Marital Status</th>";
            echo "<th>DOB</th>";
            echo "<th>State</th>";
            echo "<th>Rank</th>";
            echo "<th>Action</th>";
        echo "</tr>";
            $no = 1;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row);

            echo "<tr>";
                echo "<td>{$no}</td>";
                echo "<td>{$employeeid}</td>";
                echo "<td>{$fname}</td>";
                echo "<td>{$lname}</td>";
                echo "<td>{$oname}</td>";
                echo "<td>{$title}</td>";
                echo "<td>{$gender}</td>";
                echo "<td>{$marital_status}</td>";
                echo "<td>{$dob}</td>";
                echo "<td>";

                    $state->stateid = $stateid;
                    $state->readName();
                    echo $state->statename;
                echo "</td>";
                 echo "<td>";
                    $rank->rankid = $rankid;
                    $rank->readName();
                    echo $rank->rankname;
                echo "</td>";

                echo "<td>";
                    // edit and delete button will be here
                    echo "<a href='update_employee.php?id={$employeeid}' class='btn btn-default left-margin'>Modify</a>";
                    echo "<a delete-id='{$employeeid}' class='btn btn-danger delete-object'>Delete</a>";
                echo "</td>";

            echo "</tr>";
        $no++;
        }

    echo "</table>";

    // paging buttons will be here
    // paging buttons here
    include_once 'paging_employee.php';
}

// tell the user there are no products
else{
    echo "<div>No Employee found.</div>";
}
?>


<script>
$(document).on('click', '.delete-object', function(){
         
    var id = $(this).attr('delete-id');
    var q = confirm("Are you sure?");
     
    if (q == true){
 
        $.post('delete_employee.php', {
            object_id: id
        }, function(data){
            location.reload();
        }).fail(function() {
            alert('Unable to delete.');
        });
 
    }
         
    return false;
});
</script>



<?php
include_once "footer.php";
?>