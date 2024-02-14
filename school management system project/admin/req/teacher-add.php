<?php
session_start();
if (isset($_SESSION['admin_id']) &&
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {


if (isset($_POST['ID']) && isset($_POST['Name']) && isset($_POST['Email']) && isset($_POST['Experience']) &&
    isset($_POST['Subject']) && isset($_POST['Phone']) && isset($_POST['username']) && isset($_POST['pass'])) {

    include '../../DBASEconnect.php';
    include "../data/teacher.php";

    $ID = $_POST['ID'];
    $Name = $_POST['Name'];
    $Email = $_POST['Email'];
    $Experience = $_POST['Experience'];
    $subject = $_POST['Subject'];
    $Phone = $_POST['Phone'];
    $uname = $_POST['username'];
    $pass = $_POST['pass'];

    if (empty($ID)) {
		$em  = "Teacher ID is required";
		header("Location: ../teacher-add.php?error=$em");
		exit;
  }else if (!teacherIDIsUnique($ID, $conn)) {
		$em  = "Teacher ID is taken! Please try with another ID";
		header("Location: ../teacher-add.php?error=$em");
		exit;
	}else if (empty($Name)) {
		$em  = "Name is required";
		header("Location: ../teacher-add.php?error=$em");
		exit;
	}else if (empty($Experience)) {
		$em  = "Experience is required";
		header("Location: ../teacher-add.php?error=$em");
		exit;
  }else if (empty($subject)) {
    $em  = "Department is required";
    header("Location: ../teacher-add.php?error=$em");
    exit;
  }else if (empty($uname)) {
    $em  = "Username is required";
    header("Location: ../teacher-add.php?error=$em");
    exit;
	}else if (!unameIsUnique($uname, $conn)) {
		$em  = "Username is taken! Please try with another ID";
		header("Location: ../teacher-add.php?error=$em");
		exit;
  }else if (empty($pass)) {
		$em  = "Password is required";
		header("Location: ../teacher-add.php?error=$em");
		exit;

	}else {
      // hashing the password
      $pass = password_hash($pass, PASSWORD_DEFAULT);

      $sql_1  = "INSERT INTO
                teacher(teacher_id, Name, Email, Experience, Subject, Phone, username, password)
                VALUES(?,?,?,?,?,?,?,?)";
      $stmt_1 = $conn->prepare($sql_1);
      $stmt_1->execute([$ID, $Name, $Email, $Experience, $subject, $Phone, $uname, $pass]);
      $sm = "New teacher signed in successfully";
      header("Location: ../teacher-add.php?success=$sm");
      exit;
	}

  }else {
  	$em = "An error occurred";
    header("Location: ../teacher-add.php?error=$em");
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