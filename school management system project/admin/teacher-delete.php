<?php
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role']) &&
    isset($_GET['teacher_id'])) {
    
    if ($_SESSION['role'] == 'Admin') {
        include "../DBASEconnect.php";
        include "data/teacher.php";

        $ID = $_GET['teacher_id'];
        if (removeTeacher($ID, $conn)) {
            $sm = "Teacher removed successfully";
            header("Location: teacher.php?success=$sm");
            exit;
        }else {
            $em = "Error";
            header("Location: teacher.php?error=$em");
            exit;

        }

    }else {
        header("Location: teacher.php");
        exit;
      } 
    }else {
        header("Location: teacher.php");
        exit;
    } 
?>