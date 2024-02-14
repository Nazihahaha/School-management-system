<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

if (isset($_POST['announcement']) &&
    isset($_POST['edit_date'])) {

    include '../../DBASEconnect.php';
    include "../data/teacher.php";

    $ID = $_SESSION['admin_id'];
    $announcement = $_POST['announcement'];
    $edit_date = $_POST['edit_date'];
    
 

    if (empty($ID)) {
		$em  = "Admin ID is required";
		header("Location: ../announcement-edit.php?error=$em");
		exit;
    }else if (empty($announcement)) {
		$em  = "Announcement is required";
		header("Location: ../announcement-edit.php?error=$em");
		exit;
  }else if (empty($edit_date)) {
		$em  = "Date is required";
		header("Location: ../announcement-edit.php?error=$em");
		exit;
     }
     $sql_1  = "UPDATE admin SET announcement = ? , Date = ? 
                WHERE admin_id = ?";
     $stmt_1 = $conn->prepare($sql_1);
     $stmt_1->execute([$announcement, $edit_date, $ID]);
    $sm = "New announcement made successfully";
    header("Location: ../announcement-edit.php?success=$sm");
    exit;

    }else {
  	$em = "An error occurred";
    header("Location: ../announcement-edit.php?error=$em");
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