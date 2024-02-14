<?php
session_start();
if (isset($_SESSION['admin_id']) &&
    isset($_SESSION['role']) ) {

    if ($_SESSION['role'] == 'Admin') {
        include "../DBASEconnect.php";


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin - Edit Announcement</title>
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
        <a href="announcement.php"
           class="btn btn-dark">Go Back</a>

    <form method="post" class="shadow p-3 mt-5 form-w" action="req/announcement-edit.php">
    <h3>Update Announcement</h3><hr>
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

    <div class="mb-2">
        <?php $admin_id = $_SESSION['admin_id'] ?>
        <label class="form-label">Admin ID</label>
        <input type="text" class="form-control" value="Make sure your Admin ID is <?=$admin_id?>" name="ID">
    </div>

    <div class="mb-3">
        <label class="form-label">Announcement</label>
        <input type="text" class="form-control" value="" name="announcement">
    </div>

    <div class="mb-3">
        <label class="form-label">Date of Edit</label>
        <input type="date" class="form-control" value="" name="edit_date">
    </div>


   <div class="mb-3 text-center">
    <button type="submit" class="btn btn-dark col-2">Add</button>
    </div>
</form>
     </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php

  }else {
    echo "error";
    header("Location: announcement.php");
    exit;
  }
}else {
    echo "error";
	header("Location: announcement.php");
	exit;
}

?>