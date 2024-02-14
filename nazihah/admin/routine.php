<?php
session_start();
if (isset($_SESSION['admin_id']) &&
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
        include "../DBASEconnect.php";
        include "data/routine.php";
        $routine = getAllRoutine($conn);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin - Routine</title>
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
        if ($routine != 0) {
     ?>
     <div class="container mt-5">
      <a href=""
           class="btn btn-dark">Student Class Routine</a>

           <div class="table-responsive">
              <table class="table table-bordered mt-3">
                <thead>
                  <tr>
                    <th scope="col">Class</th>

                    <th scope="col">Routine</th>
                    <th scope="col">Session</th>

                  </tr>
                </thead>
                <tbody>
                    <?php foreach ($routine as $routine) { ?>
                  <tr>
                    <td><?=$routine['Class_Level']?></td>

                    <td><?=$routine['Routine']?></td>
                    <td><?=$routine['Session']?></td>
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