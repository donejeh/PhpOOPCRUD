<?php
// set page headers
$page_title = "Create Employee";
include_once "header.php";


echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-success pull-right'>View Employees</a>";
echo "</div>";


// get database connection
include_once 'config/database.php';
 
$database = new Database();
$db = $database->getConnection();

?>

<?php
	// if the form was submitted
	if($_POST){
	 
    // instantiate employee object
    include_once 'classes/employee.php';
    $employee = new Employee($db);
    $employeeid = $_POST['employeeid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $oname = $_POST['oname'];
    $title = $_POST['title'];
    $gender = $_POST['gender'];
    $marital_status = $_POST['marital_status'];
    $day= $_POST['bday'];

    if(empty($employeeid) || empty($fname) || empty($lname) || empty($oname) || empty($title) || empty($gender) || empty($marital_status) || empty($day)){


         echo "<div class=\"alert alert-danger alert-dismissable\">";
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
    //$rand = mt_rand(10000,99999)+1; 
    //$employee->employeeid = strtolower("p").$rand;
    $employee->employeeid = strtolower($employeeid);
    $employee->fname =  $fname;
    $employee->lname = $lname;
    $employee->oname = $oname;
    $employee->title = $title;
    $employee->gender = $gender;
    $employee->marital_status = $marital_status;


    $day= $_POST['bday'];
    $month= $_POST['bmonth'];
    $year= $_POST['byear'];
    
    /*we use datetime object to format the date 
      enesi example of cosc405 (26-02-2016)
    */
    $date_object= new DateTime($year."-".$month."-".$day);
    $date_formatted = $date_object->format("Y-m-d");
    $employee->dob = $date_formatted;
    $employee->stateid = $_POST['stateid'];
    $employee->rankid = $_POST['rankid'];
 
    // create the employee
    if($employee->create()){
        echo "<div class=\"alert alert-success alert-dismissable\">";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
            echo "Employee was created.";
        echo "</div>";
    }
 
    // if unable to create the Employee, tell the user
    else{
        echo "<div class=\"alert alert-danger alert-dismissable\">";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
            echo "Unable to create Employee. Possible Error Duplicated Employee ID";
        echo "</div>";
        }

    }
}
}
?>




<!-- HTML form for creating a employee -->
<form action='create_employee.php' method='post'>
 
    <table class='table table-hover table-responsive table-bordered tabBody'>
        
        <tr>
            <td>Employee ID</td>
            <td><input type='text'  placeholder="p17919" name='employeeid' value="<?php if(isset($_POST['employeeid'])) echo $_POST['employeeid']; ?>" class='form-control' maxLength='6'/></td>
        </tr>

        <tr>
            <td>First Name</td>
            <td><input type='text' placeholder="First Name" name='fname' value="<?php if(isset($_POST['fname'])) echo $_POST['fname']; ?>" class='form-control' /></td>
        </tr>

        <tr>
            <td>Middle Name</td>
            <td><input type='text' placeholder="Middle Name" name='oname' value="<?php if(isset($_POST['oname'])) echo $_POST['oname']; ?>" class='form-control' /></td>
        </tr>

        <tr>
            <td>Last Name</td>
            <td><input type='text' placeholder="Last Name" Name" name='lname' value="<?php if(isset($_POST['lname'])) echo $_POST['lname']; ?>" class='form-control' /></td>
        </tr>

        <tr>
            <td>Title</td>
            <td>
                <select class='form-control' name='title'>
                <option value="">--Please Select Title--</option>
                <option value="Mr." <?php if(isset($title) && $title == "Mr.") echo "selected"; ?> >Mr</option>
                <option value="Mrs." <?php if(isset($title) && $title == "Mrs.") echo "selected"; ?> >Mrs</option>
                <option value="Mallam" <?php if(isset($title) && $title == "Mallam") echo "selected"; ?> >Mallam</option>
                <option value="Mallama" <?php if(isset($title) && $title == "Mallama") echo "selected"; ?> >Mallama</option>
                <option value="Chief" <?php if(isset($title) && $title == "Chief") echo "selected"; ?> >Chief</option>
                <option value="Dr." <?php if(isset($title) && $title == "Dr.") echo "selected"; ?> >Dr</option>
                <option value="Prof." <?php if(isset($title) && $title == "Prof.") echo "selected"; ?> >Prof</option>
                <option value="Hon." <?php if(isset($title) && $title == "Hon.") echo "selected"; ?> >Hon</option>
                </select>
            
        </tr>

 
        <tr>
            <td>Gender</td>
            <td>
            <br><br>
            <input type='radio'  checked="checked" name='gender' value='male' <?php if (isset($gender) && $gender=='male') echo "checked";  ?> />Male
            <input type='radio' name='gender' value='female' <?php if (isset($gender) && $gender=='female') echo "checked"; ?> />Female

            </td>
        
        </tr>

         <tr>
            <td>Marital Status</td>
            <td>
                <select class='form-control' name='marital_status'>
                <option value="single">--Please Select Marital Status--</option>
                <option value="married" <?php if(isset($marital_status) && $marital_status == "married") echo "selected"; ?> >Married</option>
                <option value="single" <?php if(isset($marital_status) && $marital_status == "single") echo "selected"; ?> selected>Single</option>
                <option value="divorced" <?php if(isset($marital_status) && $marital_status == "divorced") echo "selected"; ?> >Divorced</option>
                <option value="widowed" <?php if(isset($marital_status) && $marital_status == "widowed") echo "selected"; ?> >Widowed</option>
                </select>
        </tr>

        <tr>
            <td>Date Of Birth</td>
            
            <td>
            <input type='number' placeholder="Day" value="<?php if(isset($_POST['bday'])) echo $_POST['bday']; ?>" name='bday' class='form-control' />
              <select name="bmonth" class='form-control'>
                            <option value="">Select Month</option>
                            <option value="1" <?php if(isset($month) && $month == "1") echo "selected"; ?>>January</option>
                            <option value="2" <?php if(isset($month) && $month == "2") echo "selected"; ?>>February</option>
                            <option value="3" <?php if(isset($month) && $month == "3") echo "selected"; ?>>March</option>
                            <option value="4" <?php if(isset($month) && $month == "4") echo "selected"; ?>>April</option>
                            <option value="5" <?php if(isset($month) && $month == "5") echo "selected"; ?>>May</option>
                            <option value="6" <?php if(isset($month) && $month == "6") echo "selected"; ?>>June</option>
                            <option value="7" <?php if(isset($month) && $month == "7") echo "selected"; ?>>July</option>
                            <option value="8" <?php if(isset($month) && $month == "8") echo "selected"; ?>>August</option>
                            <option value="9" <?php if(isset($month) && $month == "9") echo "selected"; ?>>September</option>
                            <option value="10" <?php if(isset($month) && $month == "10") echo "selected"; ?>>October</option>
                            <option value="11" <?php if(isset($month) && $month == "11") echo "selected"; ?>>November</option>
                            <option value="12" <?php if(isset($month) && $month == "12") echo "selected"; ?>>December</option>
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
                                    echo "<option value='$i' ".((isset($year) && $year == $i)?("selected"):("")).">$i</option>";
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
                if (isset($_POST['stateid']) == $stateid) {
                  echo "<option value='$stateid' selected>$statename";  
                }else{
                    echo "<option value='$stateid'>$statename";  
                }
                   echo "</option>"; 
            }
                
 
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
                
                if (isset($rankid)==$rankid) {
                    
                     echo "<option value='$rankid' selected>$rankname"; 
                }else{
                    echo "<option value='$rankid'>$rankname";
                }
                    echo "</option>";
               
            }    
        ?>
            </td>
        </tr>
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Create</button>
            </td>
        </tr>
 
    </table>
</form>


<?php


//include_once "footer.php";
?>