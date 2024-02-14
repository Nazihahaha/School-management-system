<?php
session_start();
if (isset($_SESSION['admin_id']) &&
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
        include "../DBASEconnect.php";


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin - Add Student</title>
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
     ?>
     <div class="container mt-5">
        <a href="student.php"
           class="btn btn-dark">Go Back</a>

    <form method="post" class="shadow p-3 mt-5 form-w" action="req/student-add.php">
    <h3>Add New Student</h3><hr>
    <?php if (isset($_GET['error'])) { ?>
        <div class="alert alert-danger" role="alert">
            <?=$_GET['error']?>
        </div>
    <?php } ?>
    <?php if (isset($_GET['success'])) { ?>
        <div class="alert alert-success" role="alert">
            <?=$_GET['success']?>
        </div>
    <?php } ?>

    <div class="mb-3">
        <label class="form-label">Student ID</label>
        <input type="text" class="form-control" value="" name="st_ID">
    </div>

    <div class="mb-3 row">
        <div class="col">
        <label class="form-label">Name</label>
        <input type="text" class="form-control" value="" name="Name">
    </div>
    <div class="col">
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="text" class="form-control" value="" name="Email">
    </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Address</label>
        <input type="text" class="form-control" value="" name="Address">
    </div>

    <div class="mb-3">
        <label class="form-label">Date of Birth</label>
        <input type="date" class="form-control" value="" name="DOB">
    </div>

    <div class="mb-3 row">
        <div class="col">
        <label class="form-label">Class</label>
        <input type="text" class="form-control" value="" name="class">
    </div>
    <div class="col">
    <div class="mb-3">
        <label class="form-label">Section</label>
        <input type="text" class="form-control" value="" name="section">
    </div>
    </div>

    <div class="mb-3 row">
        <div class="col">
        <label class="form-label">Session</label>
        <input type="text" class="form-control" value="" name="session">
    </div>
    <div class="col">
    <div class="mb-3">
        <label class="form-label">Fees</label>
        <input type="text" class="form-control" value="" name="fees">
    </div>
    </div>
    <div class="col">
    <div class="mb-3">
        <label class="form-label">Due Date</label>
        <input type="date" class="form-control" value="" name="due_date">
    </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Parent name</label>
        <input type="text" class="form-control" value="" name="Pname">
    </div>


    <div class="mb-3">
        <label class="form-label">Parent Phone</label>
        <input type="text" class="form-control" value="" name="Pphone">
    </div>

    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" class="form-control" value="" name="username">
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <div class="input-group">
            <input type="text" class="form-control" name="pass" id="passInput">
            <button class="btn btn-secondary" id="gBtn">Random</button>
        </div>
    </div>

    <div class="mb-3 text-center">
    <button type="submit" class="btn btn-dark col-2">Add</button>
    </div>
</form>
     </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(2) a").addClass('active');
        });

        function makePass(length) {
            var result           = '';
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
              result += characters.charAt(Math.floor(Math.random() *
         charactersLength));

           }
           var passInput = document.getElementById('passInput');
           passInput.value = result;
        }

        var gBtn = document.getElementById('gBtn');
        gBtn.addEventListener('click', function(e){
          e.preventDefault();
          makePass(4);
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