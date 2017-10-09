<?php
$page_title = "Update Employee";
include_once "header.php";



// get ID of the employee to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('<h1 style="color:red;"><br><br>ERROR: missing ID.</h1>');
 
// include database and object files
include_once 'config/database.php';
include_once 'classes/employee.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare employee object
$employee = new Employee($db);
 
// set ID property of employee to be edited
$employee->employeeid = $id;
 
// read the details of employee to be edited
$employee->readOne();

// if the form was submitted
if($_POST){
 
    $employeeid = $_POST['employeeid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $oname = $_POST['oname'];
    $title = $_POST['title'];
    $gender = $_POST['gender'];
    $marital_status = $_POST['marital_status'];
    $day= $_POST['bday'];
    $month= $_POST['bmonth'];
    $year= $_POST['byear'];
    

    if(empty($employeeid) || empty($fname) || empty($lname) || empty($oname) || empty($title) || empty($gender) || empty($marital_status) || empty($day) || empty($year) || empty($month)){


         echo "<br><br><div class=\"alert alert-danger alert-dismissable\">";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
            echo "Some feilds are empty";
        echo "</div>";

    }else{

        if (!preg_match("~p[0-9]{5}~i", $employeeid)) {

            echo "<div class=\"alert alert-danger alert-dismissable\">";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
            echo "Invaild Employee Id";
        echo "</div>";

        }else{

            // set employee property values
    $employee->employeeid = htmlentities($employeeid);
    $employee->fname = htmlentities($fname);
    $employee->lname = htmlentities($lname);
    $employee->oname = htmlentities($oname);
    $employee->gender = $gender;
    $employee->marital_status = $marital_status;



   // $day_c= $day;
    //$month_c= $month;
    //$year_c= $year;
    
    /*we use datetime object to format the date 
      enesi example of cosc405 (26-02-2016)
    */
    $date_object= new DateTime($year."-".$month."-".htmlentities($day));
    $date_formatted = $date_object->format("Y-m-d");
    $employee->dob = $date_formatted;
    $employee->stateid = $_POST['stateid'];
    $employee->rankid = $_POST['rankid'];
 
    // update the employee
    if($employee->update()){
        echo "<br><br><div class=\"alert alert-success alert-dismissable\">";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
            echo "employee was updated.";
        echo "</div>";
    }
 
    // if unable to update the employee, tell the user
    else{
        echo "<br><br><div class=\"alert alert-danger alert-dismissable\">";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
            echo "Unable to update employee. Possible Error Duplicated Employee ID";
        echo "</div>";
    }
}

}

}
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-success pull-right'>Read employee</a>";
echo "</div>";

?>

	<form action='update_employee.php?id=<?php echo $id; ?>' method='post'>
    <table class='table table-hover table-responsive table-bordered tabBody'>
 
    <tr>
            <td>Employee ID</td>
            <td><input type='text' name='employeeid' value='<?php echo $employee->employeeid; ?>' class='form-control' /></td>
        </tr>

        <tr>
            <td>First Name</td>
            <td><input type='text' name='fname' value='<?php echo $employee->fname; ?>' class='form-control' /></td>
        </tr>

        <tr>
            <td>Middle Name</td>
            <td><input type='text' name='oname' value='<?php echo $employee->oname; ?>' class='form-control' /></td>
        </tr>

        <tr>
            <td>Last Name</td>
            <td><input type='text' name='lname' value='<?php echo $employee->lname; ?>' class='form-control' /></td>
        </tr>

        <tr>
            <td>Title</td>
            <td>
                <?php echo $employee->title; ?><br><br>
                <select class='form-control' name='title'>
                <option value="">--Please Select Title--</option>
                <option value="Mr." <?php if($employee->title == "Mr.") echo "selected"; ?>>Mr</option>
                <option value="Mrs." <?php if($employee->title == "Mrs.") echo "selected"; ?>>Mrs</option>
                <option value="Mallam" <?php if($employee->title == "Mallam") echo "selected"; ?>>Mallam</option>
                <option value="Mallama" <?php if($employee->title == "Mallama") echo "selected"; ?>>Mallama</option>
                <option value="Chief" <?php if($employee->title == "Chief") echo "selected"; ?>>Chief</option>
                <option value="Dr." <?php if($employee->title == "Dr.") echo "selected"; ?>>Dr</option>
                <option value="Prof." <?php if($employee->title == "Prof.") echo "selected"; ?>>Prof</option>
                <option value="Hon." <?php if($employee->title == "Hon.") echo "selected"; ?>>Hon</option>
                </select>
            
        </tr>

 
        <tr>
            <td>Gender</td>
            <td>
            <?php echo strtoupper($employee->gender); ?>
            
            <br><br><input type='radio' name='gender'<?php if($employee->gender=='male') echo "checked";?> value='male' />Male
            <input type='radio' name='gender' value='female' <?php if($employee->gender=='female') echo "checked";?> value='female'/>Female

            </td>
        
        </tr>

         <tr>
            <td>Marital Status</td>
            <td>
                <?php echo strtoupper($employee->marital_status); ?><br><br>
                <select class='form-control' name='marital_status'>
                <option value="<?php echo $employee->marital_status; ?>">--Please Select Marital Status--</option>
                <option value="married" <?php if($employee->marital_status == "married") echo "selected"; ?>>Married</option>
                <option value="single" <?php if($employee->marital_status == "single") echo "selected"; ?>>Single</option>
                <option value="divorced" <?php if($employee->marital_status == "divorced") echo "selected"; ?>>Divorced</option>
                <option value="widowed" <?php if($employee->marital_status == "widowed") echo "selected"; ?>>Widowed</option>
                </select>
        </tr>

        <tr>
            <td>Date Of Birth</td>
            
            <td>
            Current DOB: <?php echo $employee->dob; 
                 $date = $employee->dob;
                  $dt_m = new DateTime($date);


            ?> <br><br>
            <input type='number' placeholder="Day" value="<?php echo $dt_m->format('d');?>" name='bday' class='form-control' />
                <select name="bmonth" class='form-control'>
            <option value="" >Select Month</option>
            <option value="1" <?php if($dt_m->format('m') == "1") echo "selected"; ?>>January</option>
            <option value="2" <?php if($dt_m->format('m') == "2") echo "selected"; ?>>February</option>
            <option value="3" <?php if($dt_m->format('m') == "3") echo "selected"; ?>>March</option>
            <option value="4" <?php if($dt_m->format('m') == "4") echo "selected"; ?>>April</option>
            <option value="5" <?php if($dt_m->format('m') == "5") echo "selected"; ?>>May</option>
            <option value="6" <?php if($dt_m->format('m') == "6") echo "selected"; ?>>June</option>
            <option value="7" <?php if($dt_m->format('m') == "7") echo "selected"; ?>>July</option>
            <option value="8" <?php if($dt_m->format('m') == "8") echo "selected"; ?>>August</option>
            <option value="9" <?php if($dt_m->format('m') == "9") echo "selected"; ?>>September</option>
            <option value="10" <?php if($dt_m->format('m') == "10") echo "selected"; ?>>October</option>
            <option value="11" <?php if($dt_m->format('m') == "11") echo "selected"; ?>>November</option>
            <option value="12" <?php if($dt_m->format('m') == "12") echo "selected"; ?>>December</option>
                        </select>

                <select name="byear" class='form-control'>
                            <?php
                                /*
                                    Notice that the year is being generated automatically in a loop
                                    Source: enesi example of cosc405 (26-02-2016)
                                */
                                $dt = new DateTime(); //current date
                                $year = $dt->format("Y");
                                for($i = $year-60; $i<=$year; $i++){
                                    if($dt_m->format('Y') == $i){
                                      echo "<option value='$i' selected>$i";  
                                    }else{
                                        echo "<option value='$i'>$i";
                                    }

                                    echo "</option>";
                                    
                                }
                            ?>
                        </select>

            </td>
        </tr>
 
        <tr>
            <td>State</td>
            <td>
                 <?php
        // read the state & rank from the database
        include_once 'classes/state.php';
 
        $state = new State($db);
        $st = $state->read();
 
        // put them in a select drop-down
        echo "<select class='form-control' name='stateid'>";
 
            echo "<option>Please select...</option>";
            while ($row_state = $st->fetch(PDO::FETCH_ASSOC)){
                extract($row_state);
 
                // current category of the employee must be selected
                if($employee->stateid==$stateid){
                    echo "<option value='$stateid' selected>";
                }else{
                    echo "<option value='$stateid'>";
                }
 
                echo "$statename </option>";
            }
        echo "</select>";
        ?>
            </td>
        </tr>

        <tr>
            <td>Rank</td>
            <td>
                 <?php
        // read the state & rank from the database
        include_once 'classes/rank.php';
 
        $rank = new Rank($db);
        $ra = $rank->read();
            

        // put them in a select drop-down
        echo "<select class='form-control' name='rankid'>";
 
            echo "<option>Please select...</option>";
            while ($row_rank = $ra->fetch(PDO::FETCH_ASSOC)){
                extract($row_rank);
 
                // current category of the employee must be selected
                if($employee->rankid==$rankid){
                    echo "<option value='$rankid' selected>";
                }else{
                    echo "<option value='$rankid'>";
                }
 
                echo "$rankname </option>";
                echo $rankname;
            }

        echo "</select>";
        ?>
            </td>
        </tr>
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Update</button>
            </td>
        </tr>
 
    </table>
</form>


