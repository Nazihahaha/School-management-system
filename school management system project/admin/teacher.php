<?php
session_start();
if (isset($_SESSION['admin_id']) &&
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
        include "../DBASEconnect.php";
        include "data/teacher.php";
        $teacher = getAllTeachers($conn);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin - Teachers</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../style.css">
  <link rel="stylesheet" href="admin.css">
	<link rel="icon" href="../Hogwartscrest.webp">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
     <?php
        include "inc/navbar.php";
        if ($teacher != 0) {
     ?>
     <div class="container mt-5">
        <a href="teacher-add.php"
           class="btn btn-dark">Add New Teacher</a>

           <div class="table-responsive">
              <table class="table table-bordered mt-3">
                <thead>
                  <tr>
                    <th scope="col">Teacher ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Experience</th>
                    <th scope="col">Department</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php foreach ($teacher as $teacher) { ?>
                  <tr>
                    <td><?=$teacher['teacher_id']?></td>
                    <td><?=$teacher['Name']?></td>
                    <td><?=$teacher['Email']?></td>
                    <td><?=$teacher['Experience']?></td>
                    <td><?=$teacher['Subject']?></td>
                    <td><?=$teacher['Phone']?></td>
                    <td>

                    <a href="teacher-delete.php?teacher_id=<?=$teacher['teacher_id']?>" class="btn btn-danger">Delete</a>

                  </td>
                </tr>
            <?php } ?>
           </tbody>
        </table>
        <a href="admin_dashboard.php"
           class="btn btn-dark">Go Back</a>
    </div>
     <?php }else{ ?>
        <div class="alert alert-info .w-450 m-5" role="alert">
             Empty!
        </div>
     <?php } ?>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(2) a").addClass('active');
        });
    </script>
</body>
</html>
<?php

  }else {
    header("Location: ../login.php");
    exit;
  }
}else {
    header("Location: ../login.php");
    exit;
}

?>