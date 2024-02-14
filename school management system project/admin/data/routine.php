<?php

// All Teachers
function getAllRoutine($conn){
   $sql = "SELECT Class_Level,Routine,Session FROM assign";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() >= 1) {
     $routine = $stmt->fetchAll();
     return $routine;
   }else {
   	return 0;
   }
}
