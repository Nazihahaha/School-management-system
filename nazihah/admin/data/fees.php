<?php  

// All Students 
function getAllFees($conn){
   $sql = "SELECT * FROM fees";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() >= 1) {
     $fees = $stmt->fetchAll();
     return $fees;
   }else {
   	return 0;
   }
}

// Update A FEES
function UpdateFees($ID, $conn){
    $sql = "UPDATE fees SET status = 'Paid'
            WHERE student_id=?";
    $stmt = $conn->prepare($sql);
    $re   = $stmt->execute([$ID]);
  
    if ($re) {
      return 1;
    }else {
      return 0;
    }
  }
