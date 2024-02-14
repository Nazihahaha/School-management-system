<?php
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role']) &&
    isset($_GET['student_id'])) {
    
    if ($_SESSION['role'] == 'Admin') {
        include "../DBASEconnect.php";
        include "data/student.php";

        $ID = $_GET['student_id'];
        if (removeStudent($ID, $conn)) {
            $sm = "Student removed successfully";
            header("Location: student.php?success=$sm");
            exit;
        }else {
            $em = "Error";
            header("Location: student.php?error=$em");
            exit;

        }

    }else {
        header("Location: student.php");
        exit;
      } 
    }else {
        header("Location: student.php");
        exit;
    } 
?>