<?php

session_start();
if (isset($_SESSION['admin_id']) &&
    isset($_SESSION['role']) &&
    isset($_GET['student_id'])) {

    if ($_SESSION['role'] == 'Admin') {
        include "../DBASEconnect.php";
        include "data/fees.php";

        $ID = $_GET['student_id'];
        if (UpdateFees($ID, $conn)) {
            $sm = "Updated successfully";
            header("Location: fees.php?success=$sm");
            exit;
        }else {
            $em = "Error";
            header("Location: fees.php?error=$em");
            exit;

        }

    }else {
        header("Location: fees.php");
        exit;
      }
    }else {
        header("Location: fees.php");
        exit;
    }
?>