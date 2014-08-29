<?php
require 'model.php';

/* 
 * CHECK IF EMAIL AND PASSWORD EXIST
 */
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    getUserInfo($email, $password);
}

/* 
 * CHECK THE LOGIN INFO
 */
function getUserInfo($email, $password) {
    $dbHandle = new DBConnection();

    $sqlStudent = "SELECT * FROM student WHERE email = '" . $email . "' AND password = '" . MD5($password) . "'";
    $checkStudent = $dbHandle->prepare($sqlStudent);
    $checkStudent->execute();
    $checkStudent->setFetchMode(PDO::FETCH_OBJ);
    $rowStudent = $checkStudent->fetch();

    $sqlStaff = "SELECT * FROM staff WHERE email = '" . $email . "' AND password = '" . MD5($password) . "'";
    $checkStaff = $dbHandle->prepare($sqlStaff);
    $checkStaff->execute();
    $checkStaff->setFetchMode(PDO::FETCH_OBJ);
    $rowStaff = $checkStaff->fetch();

    if (!$rowStudent && !$rowStaff) {
        header('Location: ../login.php?wrong=1');
        exit;
    } else if ($rowStudent) {
        session_start();
        $_SESSION['login'] = "1";
        $_SESSION['uId'] = $rowStudent->studentID;
        $_SESSION['uEmail'] = $rowStudent->email;
        $_SESSION['staffID'] = $rowStudent->staffID;
        updateStudentLastLogin($rowStudent->studentID);
        header("Location: ../index.php");
    } else if ($rowStaff) {
        session_start();
        $_SESSION['login'] = "1";
        $_SESSION['uId'] = $rowStaff->staffID;
        $_SESSION['uEmail'] = $rowStaff->email;
        header("Location: ../index.php");
    }
}

function updateStudentLastLogin($stuID){
    $dbHandle = new DBConnection();
    $sql = "UPDATE student SET lastLogin= NOW() WHERE studentID = $stuID";
    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();
    echo 'Done';
}
