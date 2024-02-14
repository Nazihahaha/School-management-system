
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="teacher_dashboard.css">
  <title>Teacher Dashboard</title>
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
   // echo "Username: $username, Role: $role";

    $sql = "SELECT * FROM `$role` WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $name=null;
    $email=null;
    $teacher_id=null;
    $experience=null;
    $department =null;
    $phone=null;


    if ($result) {
        $teacher_detail = mysqli_fetch_array($result);
        if ($teacher_detail) {
            $name= $teacher_detail["Name"];
            $email=$teacher_detail["Email"];
            $teacher_id=$teacher_detail["teacher_id"];
            $experience= $teacher_detail["Experience"];
            $department=$teacher_detail["Department"];
            $phone=$teacher_detail["Phone"];
        } else {
            echo "0 results";
        }
    } else {
        echo "Error in query: " . mysqli_error($conn);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['search_term'];

}



}


?>

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


                    $sql = "SELECT * FROM `students` WHERE student_id = '$searchTerm'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Display search results
                        while ($row = $result->fetch_assoc()) {
                            echo "<h3>Current Student Information:</h3>
                                <p>Name: " . $row['Name'] . "</p>
                                <p>Roll Number: " . $row['student_id'] . "</p>";
                        }
                    } else {
                        echo "No results found.";
                    }
                }

                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                ?>

        <h3>Update Student Grade:</h3>
        <form method="post" action="">
            <label for="student_subject">Choose Subjects: </label>
            <select id="subject">
                <option value="Bangla">Bangla</option>
                <option value="English">English</option>
                 <option value="Math">Math</option>

            </select>
            <label for="student_grade">Enter New Grade:</label>
            <input type="text" name="student_grade" id="student_grade" required>
            <input type="submit" value="Update Grade">
        </form>

        <?php
            // Handle the form submission to update the student grade
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                 $newGrade = $_POST['student_grade'];

            // Validate and update the student grade in the database
            // Add appropriate validation and security measures
            // Sample update query: UPDATE grades SET grade = :grade WHERE student_id = :student_id;

                echo '<p class="success">Student grade updated successfully!</p>';
     }
        ?>
    </div>
    </div>

    </div>

</div>

</body>
</html>
