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

    //$sql = "SELECT * FROM `$role` WHERE username = ?";

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
        </div>

    </div>
<div class="dashboard-container">
    <div class="result">
        <h2>Results</h2>

    </div>

    <div class="attendance">
        <h2>Attendance</h2>
        <ul>
            <?php
               echo "<li>" . $subject_attendance . " : " . $attendance . "</li>";
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
            $query = "SELECT * FROM assign WHERE class_section = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "s", $classsection);
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
