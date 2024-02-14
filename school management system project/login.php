<!-- login.php -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" type= "text/css" href="style.css">

</head>

<body class="body-home">

  <form class ="login"
        method="post"
		    action="req/log.php">
     </div>
    <h2>Login</h2>
	<?php if (isset($_GET['error'])){ ?>
	<div class="alert alert-danger" role="alert">
	   <?=$_GET['error']?>
    </div>
	<?php } ?>
   <div class="mb-3">
    <label class="form-label">Username:</label>
    <input type="text"
	       class="form-control"
		   name="uname">
   </div>

   <div class="mb-3">
    <label class="form-label">Password:</label>
    <input type="password"
	       class="form-control"
		   name="pass">
   </div>

    <div class="mb-3">
    <label class="form-label">Login As:</label>
    <select class="form-control"
	        name="role">
	   <option value="1">Admin</option>
      <option value="2">Teacher</option>
      <option value="3">Student</option>

	</select>
   </div>

    <button type="submit" class = "btn btn-primary">Login</button>

   </form>

  <br /><br />

  <div class="announcement">
    <h3>Announcement:</h3>
        <?php
        include"announcement.php"
        ?>
    </ul>

  </div>
</body>

</html>