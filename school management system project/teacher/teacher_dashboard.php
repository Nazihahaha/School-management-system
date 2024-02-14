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

if (isset($_SESSION["username"]) && isset($_SESSION["role"])) {
    $username = $_SESSION["username"];
    $role = $_SESSION["role"];

    $sql = "SELECT * FROM `$role` WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $teacher_detail = mysqli_fetch_array($result);
        if ($teacher_detail) {
            $name = $teacher_detail["Name"];
            $email = $teacher_detail["Email"];
            $teacher_id = $teacher_detail["teacher_id"];
            $experience = $teacher_detail["Experience"];
            $department = $teacher_detail["Department"];
            $phone = $teacher_detail["Phone"];
        } else {
            echo "0 results";
        }
    } else {
        echo "Error in query: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="teacher_dashboard.css">
    <title>Teacher Dashboard</title>
</head>
<body>

<div class="dashboard-container">
    <div class='school_info'>
        <img class="logo" src="/school_management/Hogwartscrest.webp" alt="School logo">
        <h1>Hogwarts School of Witchcraft and Wizardry</h1>
        <h3>Never Tickle a Sleeping Dragon</h3>
    </div>

    <div class="inner_container">
        <div class="teacher-info">
            <h2>Teacher Information</h2>
            <p>ID: <?php echo $teacher_id; ?></p>
            <p>Name: <?php echo $name; ?></p>
            <p>Email: <?php echo $email; ?></p>
            <p>Phone: <?php echo $phone; ?></p>
            <p>Department: <?php echo $department; ?></p>
            <p>Experience: <?php echo $experience; ?></p>
            <a href="../logout.php" class="logout_button">Log Out</a>
        </div>

        <div class="student-info">
            <h2>Student Information</h2>
            <h3>Search Student</h3>

            <form method="post" action="">
                <label for="search_term">Enter student ID:</label>
                <input type="text" name="search_term" id="search_term" required>
                <button type="submit">Search</button>
            </form>

            <div class="student-info">
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $searchTerm = $_POST['search_term'];
                    $_SESSION["studID"]=$searchTerm;


                    $sql = "SELECT *, attendance.Subject as attended_subject, attendance.Status as presence,
                            reports.Subject as report_subject
                            FROM student
                            LEFT JOIN reports ON student.student_id = reports.student_id
                            LEFT JOIN attendance ON student.student_id = attendance.student_id
                            WHERE student.student_id = ?";

                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "s", $searchTerm);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if ($result) {
                        $student_detail = mysqli_fetch_array($result);
                        if ($student_detail) {

                ?>
                            <?php $_SESSION['Name']=$student_detail['Name'];?>
                            <p>Student ID: <?php echo $student_detail['student_id']; ?></p>
                            <p>Name: <?php echo $student_detail['Name']; ?></p>
                            <p>Email: <?php echo $student_detail['Email']; ?></p>
                            <p>Parent's Name: <?php echo $student_detail['parent_name']; ?></p>
                            <p>Parent's Phone: <?php echo $student_detail['Parent_phone']; ?></p>
                            <p>Class: <?php echo $student_detail['class_Level']; ?></p>
                            <p>Section: <?php echo $student_detail['class_section']; ?></p>
                            <h4>Subject: Grade</h4>
                            <p>
                                <?php
                                        $query = "SELECT Subject, Grade FROM reports WHERE student_id = ?";
                                        $stmt = $conn->prepare($query);
                                        $stmt->bind_param("s", $student_detail['student_id']);
                                        $stmt->execute();

                                        $result = $stmt->get_result();


                                        if ($result->num_rows > 0) {

                                            while ($row = $result->fetch_assoc()) {
                                                echo "<p>{$row['Subject']}: {$row['Grade']}</p>";
                                            }
                                        } else {
                                            echo "No subjects assigned";
                                        }
                                ?>


                            </p>
                            <h4>Attendance</h4>
                            <p>
                                <?php
                                        $query = "SELECT Subject, Status,Date FROM attendance WHERE student_id = ?";
                                        $stmt = $conn->prepare($query);
                                        $stmt->bind_param("s", $student_detail['student_id']);
                                        $stmt->execute();

                                        $result = $stmt->get_result();
                                        $_SESSION["subjects"]=$subjects;
                                        if ($result->num_rows > 0) {

                                            while ($row = $result->fetch_assoc()) {

                                                echo "<span>{$row['Date']}  {$row['Subject']}: {$row['Status']} <br>";
                                            }
                                        } else {
                                            echo "No subjects assigned";
                                        }
                                        $_SESSION["student_id"]=$student_detail['student_id'];

                                ?>

                            </p>
                            <br>
                            <a href="student_grade_update.php"><button>Update</button></a>

                <?php

                        } else {
                            echo "No results found.";
                        }
                    } else {
                        echo "Error in query: " . mysqli_error($conn);
                    }
                }
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>
