<?php 
	

	try{
		$dbh = new PDO("mysql:host=localhost;dname=employee","root","");

		echo "Conneted";
	}catch(PDOExecption $e){
		echo $e->getMessage();
	}

	
	//print_r(PDO::getAvailableDrivers());


	# creating the statement
$STH = $dbh->query('SELECT * from state');
 
# setting the fetch mode
//$STH->setFetchMode(PDO::FETCH_OBJ);
 
# showing the results
while($row = $STH->fetch(PDO::FETCH_OBJ)) {
    echo $row->statname . "\n";
   
}


?>