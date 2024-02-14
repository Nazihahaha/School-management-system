<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="student_dashboard.css">
    <title>Student Dashboard</title>
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

    if (isset($_SESSION["username"]) && isset($_SESSION["role"])) {
        $username = $_SESSION["username"];
        $role = $_SESSION["role"];

        $sql = "SELECT *,
                attendance.Subject AS attendance_subject,
                reports.Subject AS reports_subject,
                fees.Status AS fees_status,
                attendance.Status AS attendance_status
                FROM $role
                LEFT JOIN attendance ON $role.student_id = attendance.student_id
                LEFT JOIN reports ON $role.student_id = reports.student_id
                LEFT JOIN fees ON $role.student_id = fees.student_id
                WHERE $role.username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            $student_detail = mysqli_fetch_array($result);
            if ($student_detail) {
                $name = $student_detail["Name"];
                $email = $student_detail["Email"];
                $date_of_birth = $student_detail["Date_of_Birth"];
                $student_id = $student_detail["student_id"];
                $address = $student_detail["Address"];
                $subject = $student_detail["reports_subject"];
                $grade = $student_detail["Grade"];
                $subject_attendance = $student_detail["attendance_subject"];
                $attendance= $student_detail["attendance_status"];
                $session= $student_detail["Session"];
                $fees= $student_detail["Amount"];
                $paymentStatus=$student_detail["fees_status"];
                $due_date= $student_detail["Due_Date"];
                $classsection=$student_detail["class_section"];
                $classlevel=$student_detail["class_Level"];
            } else {
                echo "0 results";
            }
        } else {
            echo "Error in query: " . mysqli_error($conn);
        }
    }
    ?>

    <div class="information_top">
        <div class='school_info'>
            <img class="logo" src="/school_management/Hogwartscrest.webp" alt="School logo">
            <h1>Hogwarts School of Witchcraft and Wizardry</h1>
            <h3>Never Tickle a Sleeping Dragon</h3>
        </div>

        <div>
            <div class="personal-info">
                <h2>Personal Information</h2>
                <p>ID: <?php echo $student_id; ?></p>
                <p>Name: <?php echo $name; ?></p>
                <p>Date of Birth: <?php echo $date_of_birth; ?></p>
                <p>Address: <?php echo $address; ?></p>
                <p>Email: <?php echo $email; ?></p>
                <p>Class Level: <?php echo $classlevel; ?></p>
            </div>
        </div>

        <div class="dashboard-container">
            <div class="result">
                <h2>Results</h2>
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
            </div>

            <div class="attendance">
                <h2>Attendance</h2>
                <ul>
                <?php
                        $query = "SELECT Subject, Status,Date FROM attendance WHERE student_id = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("s", $student_detail['student_id']);
                        $stmt->execute();

                        $result = $stmt->get_result();
                        $_SESSION["subjects"]=$subjects;
                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {

                                echo "<span>{$row['Date']}  {$row['Subject']}: {$row['Status']} </span> <br>";
                        } }else {
                            echo "No subjects assigned";
                        }

                ?>
                </ul>
            </div>

            <div class="fees">
                <h2>Fees</h2>
                <ul>
                    <?php
                    echo "Session:". $session ." <br> Amount: ". $fees ."<br>  Status :". $paymentStatus ."";
                    if($paymentStatus !="Paid") {echo "<br> Due Date: ". $due_date ."";}
                    ?>
                </ul>
            </div>

            <div class="class-routine">
                <h2>Class Routine</h2>
                <?php
                $query = "SELECT * FROM assign WHERE class_Level = ?";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, "s", $classlevel);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if ($result) {
                    $student_detail = mysqli_fetch_array($result);
                    if ($student_detail) {
                        $parts = explode(', ', $student_detail["Routine"]);
                        foreach ($parts as $part) {
                            echo "{$part} <br>" ;
                        }
                    } else {
                        echo "0 results";
                    }
                } else {
                    echo "Error in query: " . mysqli_error($conn);
                }
                ?>
            </div>
        </div>

        <a href="../logout.php" class="logout"> Log Out</a>
    </body>

    </html>
