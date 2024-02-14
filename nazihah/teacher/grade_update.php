 <?php
 session_start();

$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "school_management";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



?>

<?php

if( $_POST['submit1'] ) {

     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subject = $_POST['Subject_attendance'];
            $attendance = $_POST['attendance_'];
            $student_id = $_SESSION['student_id'];

            if ($subject != 'select' && $attendance != 'select') {
            $sql = "UPDATE `attendance` SET `Status` = ? WHERE student_id=? AND Subject=?";

            // Create a prepared statement
            $stmt = mysqli_prepare($conn, $sql);

            // Bind parameters to the prepared statement
            mysqli_stmt_bind_param($stmt, "sss", $attendance, $student_id, $subject);

            // Execute the prepared statement
            $result = mysqli_stmt_execute($stmt);

            // Check for success
            if ($result) {
                echo "Attendance updated successfully";
            } else {
                echo "Student do not do this subject " . mysqli_error($conn);
            }
        }else{echo "Select both subject and attendence to update!!";}
    }

}
else if( $_POST['submit2'] ) {

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subject = $_POST['subject_name'];
            $attendance = $_POST['subject_grade'];
            $student_id = $_SESSION['student_id'];

            if ($subject != 'select' && $attendance != 'select') {
            $sql = "UPDATE `reports` SET `Grade` = ? WHERE student_id=? AND Subject=?";

            // Create a prepared statement
            $stmt = mysqli_prepare($conn, $sql);

            // Bind parameters to the prepared statement
            mysqli_stmt_bind_param($stmt, "sss", $attendance, $student_id, $subject);

            // Execute the prepared statement
            $result = mysqli_stmt_execute($stmt);

            // Check for success
            if ($result) {
                echo "Grade updated successfully";

            } else {
                echo "Student do not do this subject " . mysqli_error($conn);
            }
        }}

}

?>


else if( $_POST['submit_2'] ) {

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subject = $_POST['subject_name'];
            $attendance = $_POST['subject_grade'];
            $student_id = $_SESSION['student_id']; // Assuming you stored the student ID in the session

            if ($subject != 'select' && $attendance != 'select') {
            $sql = "UPDATE `reports` SET `Grade` = ? WHERE student_id=? AND Subject=?";

            // Create a prepared statement
            $stmt = mysqli_prepare($conn, $sql);

            // Bind parameters to the prepared statement
            mysqli_stmt_bind_param($stmt, "sss", $attendance, $student_id, $subject);

            // Execute the prepared statement
            $result = mysqli_stmt_execute($stmt);

            // Check for success
            if ($result) {
                echo "Grade updated successfully";

            } else {
                echo "Student do not do this subject " . mysqli_error($conn);
            }
        }}

}

?>
*/