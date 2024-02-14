<?php  

// All Teachers 
function getAllTeachers($conn){
   $sql = "SELECT * FROM teacher";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() >= 1) {
     $teacher = $stmt->fetchAll();
     return $teacher;
   }else {
   	return 0;
   }
}

// Check if the username Unique
function unameIsUnique($uname, $conn){
  $sql = "SELECT username FROM teacher
          WHERE username=?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$uname]);

  if ($stmt->rowCount() >= 1) {
    return 0;
  }else {
    return 1;
  }
}

function teacherIDIsUnique($ID, $conn){
  $sql = "SELECT teacher_id FROM teacher
          WHERE teacher_id=?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$ID]);

  if ($stmt->rowCount() >= 1) {
    return 0;
  }else {
    return 1;
  }
}

// DELETE A TEACHER
function removeTeacher($ID, $conn){
  $sql = "DELETE FROM teacher
          WHERE teacher_id=?";
  $stmt = $conn->prepare($sql);
  $re   = $stmt->execute([$ID]);

  if ($re) {
    return 1;
  }else {
    return 0;
  }
}