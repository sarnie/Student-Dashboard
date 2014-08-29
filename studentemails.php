<?php
session_start();
require 'inc/model.php';
getStudentEmails();
function getStudentEmails(){
    $dbHandle = new DBConnection();
	$sql = "SELECT * FROM student WHERE staffID = :id";
	$stmt = $dbHandle->prepare($sql);
        $stmt->bindParam(':id', $_SESSION['uId'], PDO::PARAM_INT);
	$stmt->execute();
	$stmt->setFetchMode(PDO::FETCH_OBJ);
    
    $theHtml = '[ ';
    
   $sentMsgCount = $stmt->rowCount();
   $i = 1;
    
    while($row = $stmt->fetch()){
        $theHtml .= '{'. '"label":'.'" < '.$row->firstName.' '.$row->lastName.' > '.$row->email.'"}';
        if($sentMsgCount != $i){
             $theHtml .= ',';
        }
    $i++;}
    $theHtml .= ']';
    
    $theJson = json_decode($theHtml);
   
  echo json_encode($theJson);
    
}