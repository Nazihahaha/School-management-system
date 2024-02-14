<?php
  $username= $_SESSION["admin_id"];
  $role= $_SESSION["role"];

    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $dbname = "school_management";

    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM `$role` WHERE admin_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            $admin_detail = mysqli_fetch_array($result);
            if ($admin_detail) {
                $name = $admin_detail["Name"];
                $email = $admin_detail["Email"];
                $phone = $admin_detail["Phone"];
            } else {
                echo "0 results";
            }
        } else {
            echo "Error in query: " . mysqli_error($conn);
        }
?>
