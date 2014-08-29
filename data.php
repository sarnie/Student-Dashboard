<?php
require 'inc/model.php';

 
getTheStaffEmails();

function getTheStaffEmails(){
    $dbHandle = new DBConnection();
	$sql = "SELECT * FROM staff WHERE role = 1";
	$stmt = $dbHandle->prepare($sql);
	$stmt->execute();
	$stmt->setFetchMode(PDO::FETCH_OBJ);
    
    $theHtml = '[{"key": "Cumulative Return","values": [ ';
    
    $sentMsgCount = $stmt->rowCount();
    $i = 1;
    
    while($row = $stmt->fetch()){
        $theHtml .= '{'. '"label":'.'"'.getFirstName($row->email).'","value":'.getTheData($row->email).'}';
        if($sentMsgCount != $i){
             $theHtml .= ',';
        }
    $i++;}
    $theHtml .= ']}]';
    
    $theJson = json_decode($theHtml);
   
  echo json_encode($theJson);
    
}

function getTheData($value) {
      
	$dbHandle = new DBConnection();
    
        $sql = 'SELECT * FROM message WHERE fromID  = "'.$value.'" OR toID  = "'.$value.'"';
    	$stmt = $dbHandle->prepare($sql);
    
           
       	$stmt->execute();
	$stmt->setFetchMode(PDO::FETCH_OBJ);
	$row = $stmt->fetch();
	
	$sentMsgCount = 0;
	$cleanDate = 'None';

	if($row){
		$sentMsgCount = $stmt->rowCount();
		return $sentMsgCount;
	}else{
		return 0;
	}
}


/**
 * GET FIRST NAME
 */
function getFirstName($uEmail) {
	$dbHandle = new DBConnection();
	
	
	//Db Query for Staff Table
	$sqlStaff = "SELECT firstName FROM staff WHERE email ='".$uEmail."'";
	$stmt = $dbHandle->prepare($sqlStaff);
	$stmt->execute();
	$stmt->setFetchMode(PDO::FETCH_OBJ);
	$rowStaff = $stmt->fetch();
	
	return $rowStaff->firstName;
	
	
}
?>