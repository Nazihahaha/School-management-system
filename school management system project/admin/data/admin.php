<?php  

// All Teachers 
function getAllAdmins($conn){
   $sql = "SELECT * FROM admin";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() >= 1) {
     $admin = $stmt->fetchAll();
     return $admin;
   }else {
   	return 0;
   }
}