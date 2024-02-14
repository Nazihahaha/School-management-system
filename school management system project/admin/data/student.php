<?php  

// All Students 
function getAllStudents($conn){
   $sql = "SELECT S.student_id, S.Name, St.Class_Level, F.session,S.Date_of_Birth, S.Address, S.Parent_name, S.Parent_phone
              FROM student S, studies St, fees F WHERE S.student_id = St.student_id AND F.student_id = S.student_id ORDER BY S.student_id ASC";
   $stmt = $conn->prepare($sql);
   $stmt->execute();
   if ($stmt->rowCount() >= 1) {
     $students = $stmt->fetchAll();
     return $students;
   }else {
   	return 0;
   }
}



// Check if the username Unique
function unameIsUnique($uname, $conn){
   $sql = "SELECT username FROM student WHERE username=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$uname]);

   if ($stmt->rowCount() >= 1) {
     return 0;
   }else {
   	return 1;
   }
}

function studentIDIsUnique($st_ID, $conn){
  $sql = "SELECT student_id FROM student
          WHERE student_id=?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$st_ID]);

  if ($stmt->rowCount() >= 1) {
    return 0;
  }else {
    return 1;
  }
}

// DELETE A STUDENT
function removeStudent($ID, $conn){
  $sql = "DELETE FROM student
          WHERE student_id=?";
  $stmt = $conn->prepare($sql);
  $re   = $stmt->execute([$ID]);

  if ($re) {
    return 1;
  }else {
    return 0;
  }
}