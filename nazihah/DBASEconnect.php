<?php //start
$servername = "localhost"; //variable
$username = "root"; //mysql -u root -p
$password  = "";
$dbname = "school_management";


try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
	echo "Connection failed: ". $e->getMessage();
	exit;
}
