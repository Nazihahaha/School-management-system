<?php
session_start();

if (isset($_POST['uname']) && isset($_POST['pass']) && isset($_POST['role'])) {

    include "../DBASEconnect.php";

    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    $role = $_POST['role'];

    if (empty($uname) || empty($pass) || empty($role)) {
        $em = "All fields are required";
        header("Location: ../login.php?error=$em");
        exit;
    }

    if ($role == '1') {
        $sql = "SELECT * FROM admin WHERE username = ?";
        $role = "Admin";
    } elseif ($role == '2') {
        $sql = "SELECT * FROM teacher WHERE username = ?";
        $role = "Teacher";
    } else {
        $sql = "SELECT * FROM student WHERE username = ?";
        $role = "Student";
    }

    $stmt = $conn->prepare($sql);
    $stmt->execute([$uname]);

    if ($stmt->rowCount() == 1) {
        $user = $stmt->fetch();
        $username = $user['username'];
        $password = $user['password'];

        if ($username === $uname && password_verify($pass, $password)) {
            $_SESSION['role'] = $role;

            if ($role == 'Admin') {
                $_SESSION['admin_id'] = $user['admin_id'];
                header("Location: ../admin/admin_dashboard.php");
                exit;
            } elseif ($role == "Student" || $role == "Teacher") {
                $_SESSION['username'] = $username;
                header("Location: ../{$role}/{$role}_dashboard.php");
                exit;
            } else {
                header("Location: ../wrong_credential.html");
                exit;
            }
        } else {
            header("../wrong_credential.html");
            exit;
        }
    } else {
        header("Location: ../wrong_credential.html");
        exit;
    }
} else {
    header("Location: ../wrong_credential.html");
    exit;
}
?>
