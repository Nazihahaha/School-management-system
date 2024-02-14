<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(249,234,215);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 400px;
            text-align: center;
            background-color: rgb(210,213,214);
        }

        form {
            margin-top: 20px;
        }

        label, select, button {
            display: block;
            margin-bottom: 15px;
        }

        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;

            align-items: center;

        }

        button:hover {
            background-color: #45a049;
        }
        a{
            text-decoration: none;
        }
    </style>
</head>
<body>

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

<div class="container">
    <div>
    <h2>Update Attendance for <?php echo $_SESSION['Name']?></h2>
    <form method="post" action="">
        <label for="Subject_attendance">Select Subject:</label>
        <select name="Subject_attendance" id="Subject_attendance">
            <option value="select">Select</option>
            <option value="Transfiguration">Transfiguration</option>
            <option value="Potions">Potions</option>
            <option value="Herbology">Herbology</option>
            <option value="Flying">Flying</option>
            <option value="Divination">Divination</option>
            <option value="Defence Against Dark Arts">Defence Against Dark Arts</option>
        </select>

        <label for="attendance_">Select Attendance:</label>
        <select name="attendance_" id="attendance_">
            <option value="select">Select</option>
            <option value="Absent">Absent</option>
            <option value="Present">Present</option>
        </select>
        <button type="submit" name='submit1'>Update</button>
    </form>
    <?php


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

            if ($result) {
                echo "Attendence updated successfully";

            } else {
                echo "Student do not do this subject " . mysqli_error($conn);
            }
        }else{echo "Select both subject and attendence to update!!";}
    }
    ?>
    </div>
    <div>
    <h2>Update Grade for <?php echo $_SESSION['Name']?></h2>
    <form method="post" action="">
        <label for="subject_name">Select Subject:</label>
        <select name="subject_name" id="subject_name">
            <option value="select">Select</option>
            <option value="Transfiguration">Transfiguration</option>
            <option value="Potions">Potions</option>
            <option value="Herbology">Herbology</option>
            <option value="Flying">Flying</option>
            <option value="Divination">Divination</option>
            <option value="Defence Against Dark Arts">Defence Against Dark Arts</option>
        </select>

        <label for="subject_grade">Select Grade:</label>
        <select name="subject_grade" id="subject_grade">
            <option value="select">Select</option>
            <option value="A+">A+</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
            <option value="E">E</option>
            <option value="U">U</option>
        </select>

        <button type="submit" name="submit2">Update</button>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subject = $_POST['subject_name'];
            $attendance = $_POST['subject_grade'];
            $student_id = $_SESSION['student_id'];

            if ($subject != 'select' && $attendance != 'select') {
            $sql = "UPDATE `reports` SET `Grade` = ? WHERE student_id=? AND Subject=?";
            $stmt = mysqli_prepare($conn, $sql);


            mysqli_stmt_bind_param($stmt, "sss", $attendance, $student_id, $subject);


            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                echo "Grade updated successfully";

            } else {
                echo "Student do not do this subject " . mysqli_error($conn);
            }
        }else{
            echo "Select both to update";
        }
    }

    ?>
    </div>
    <a href="../teacher/teacher_dashboard.php"><button>Go back</button></a>
    </div>


</body>
</html>
