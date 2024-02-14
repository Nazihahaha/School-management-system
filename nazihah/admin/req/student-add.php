<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

if (isset($_POST['st_ID']) &&
    isset($_POST['Name']) &&
    isset($_POST['Email']) &&
    isset($_POST['Address']) &&
    isset($_POST['DOB']) &&
    isset($_POST['class']) &&
    isset($_POST['section']) &&
    isset($_POST['session']) &&
    isset($_POST['fees']) &&
    isset($_POST['due_date']) &&
    isset($_POST['Pname']) &&
    isset($_POST['Pphone']) &&
    isset($_POST['username']) &&
    isset($_POST['pass'])) {
    
    include '../../DBASEconnect.php';
    include "../data/student.php";

    $st_ID = $_POST['st_ID'];
    $Name = $_POST['Name'];
    $Email = $_POST['Email'];
    $Address = $_POST['Address'];
    $Date_of_birth = $_POST['DOB'];
    $class = $_POST['class'];
    $section = $_POST['section'];
    $session = $_POST['session'];
    $fees = $_POST['fees'];
    $due_date = $_POST['due_date'];
    $Pname = $_POST['Pname'];
    $Pphone = $_POST['Pphone'];
    $uname = $_POST['username']; 
    $pass = $_POST['pass'];
    
 

    if (empty($st_ID) || empty($Name) || empty($Address) || empty($class) || empty($section) || empty($Pname) ||
         empty($Pphone) || empty($uname) || empty($pass) || empty($session) || empty($fees) || empty($due_date) ) {
		$em  = "An error occured";
		header("Location: ../student-add.php?error=$em");
		exit;
  }else if (!studentIDIsUnique($st_ID, $conn)) {
		$em  = "Student ID is taken! Please try with another ID";
		header("Location: ../student-add.php?error=$em");
		exit;
	}else if (!unameIsUnique($uname, $conn)) {
		$em  = "Username is taken! Please try with another ID";
		header("Location: ../student-add.php?error=$em");
		exit;
  }
	
	else {
      // hashing the password
    $pass = password_hash($pass, PASSWORD_DEFAULT);

    $sql_1 = "INSERT INTO
              student(student_id, Name, Email, Address, Date_of_Birth, Parent_name, Parent_phone, username, password)
              VALUES(?,?,?,?,?,?,?,?,?)";
    $stmt_1 = $conn->prepare($sql_1);
    $stmt_1->execute([$st_ID, $Name, $Email, $Address, $Date_of_birth, $Pname, $Pphone, $uname, $pass]);
    
    $sql_2 = "INSERT INTO studies(Class_section, Class_Level, Student_ID) VALUES(?,?,?)";
    $stmt_2 = $conn->prepare($sql_2);
    $stmt_2->execute([$section, $class, $st_ID]);

    $status = 'Unpaid';
    $admin_id = $_SESSION['admin_id'];
    $sql_3 = "INSERT INTO fees(student_id, admin_id, class,session, amount, status, due_date,
              Parent_name,Parent_phone) VALUES(?,?,?,?,?,?,?,?,?)";
    $stmt_3 = $conn->prepare($sql_3);
    $stmt_3->execute([$st_ID, $admin_id, $class, $session, $fees,$status,$due_date,$Pname,$Pphone]);
    $sm = "New Student signed in successfully";
    header("Location: ../student-add.php?success=$sm");
    exit;
	}
    
  }else {
  	$em = "Error!";
    header("Location: ../student-add.php?error=$em");
    exit;
  }

  }else {
    header("Location: ../../logout.php");
    exit;
  } 
}else {
	header("Location: ../../logout.php");
	exit;
} 