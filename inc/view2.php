<?php
require 'controller.php';

session_start();
if ((isset($_SESSION['login']) && $_SESSION['login'] != '')) {
    $currentUser = $_SESSION['uId'];
    $uEmail = $_SESSION['uEmail'];
    //check if staffID session exist
    if (isset($_SESSION['staffID'])) {
        $staffID = $_SESSION['staffID'];
    }
}

/**
 * GETS THE POST 
 */
if (isset($_GET['thePost'])) {
    if (is_admin($uEmail)) {
        getThePost_tu($currentUser);
    } else {
        getThePost_st($currentUser);
    }
}

/**
 * GETS THE POST COMMENT
 */
if (isset($_GET['loadPostComment'])) {
    getThePostComments($currentUser);
}


/**
 * ADD NEW BLOG POST
 */
if (isset($_POST['postContent'])) {
    $postContent = trim($_POST['postContent']);
    $string = nl2br($postContent);
    addThePost($currentUser, $string);
}

/**
 * ADD NEW MESSAGE
 */
if(isset($_POST['messageText'])) {
    $postContent = trim($_POST['messageText']);
    $string = nl2br($postContent);
    $toEmail = $_POST['toEmail'];
    sendMessage($uEmail, $toEmail, $string);
}

if (isset($_GET['getSentMsg'])) {
    getOutboxMessage($uEmail);
}


/**
 * ADD NEW BLOG POST COMMENT
 */
if (isset($_POST['postComment'])) {
    //clean the content (security reasons)
    $postContent = trim($_POST['postComment']);
    $blogId = trim($_POST['BlogId']);
    $string = nl2br($postContent);
    addThePostComment($blogId, $string);
}


/**
 * ADD NEW MEETING
 */
if (isset($_POST['meetingDate'])) {

    $type = $_POST['type'];
    $studentID = $currentUser;
    $staffID = $staffID;
    $agenda = trim($_POST['agenda']);
    $meetingTime = $_POST['meetingTime'];
    $meetingDate = $_POST['meetingDate'];

    $string = nl2br($agenda);

    //Chaneg the date format
    $meetingDate = str_replace('/', '-', $meetingDate);
    $date = new DateTime($meetingDate);
    $newDate = $date->format('Y-m-d');

    createMeeting($type, $studentID, $staffID, $string, $meetingTime, $newDate);
}

/**
 * GET MEETINGS
 */
if (isset($_POST['getMeetings'])) {
    getMeeting_st($currentUser);
}

if(isset($_POST['updateMeetings'])){
    getMeeting_tu($currentUser,0,'Accepted');
}

if(isset($_POST['pendingMeetings'])){
    getMeeting_tu($currentUser,0,'Pending');
}


/**
 * ADD STAFF DETAILS TO MEETING
 */
if(isset($_POST['staffDetails'])){
    //clean the content (security reasons)
    $staffDetails = trim($_POST['staffDetails']);
    $meetingId = trim($_POST['meetingID']);
    $string = nl2br($staffDetails);
    updateMeeting_tu($meetingId,$string);
}

/**
 * ACCEPT/DECLINE MEETING
 */
if(isset($_POST['happened'])){
    //clean the content (security reasons)
    $happened = trim($_POST['happened']);
    $meetingId = trim($_POST['meetingID']);
    
    acceptMeeting_tu($meetingId,$happened);
}


/**
 * UPLOAD FILE
 */
if (isset($_FILES["FileInput"])) {

    $UploadTitle = $_POST['UploadTitle'];
    $uploadDate = $_POST['uploadDate'];

    ############ Edit settings ##############
    $UploadDirectory = '../uploads/'; //specify upload directory ends with / (slash)
    ##########################################

    /*
      Note : You will run into errors or blank page if "memory_limit" or "upload_max_filesize" is set to low in "php.ini".
      Open "php.ini" file, and search for "memory_limit" or "upload_max_filesize" limit
      and set them adequately, also check "post_max_size".
     */

    //check if this is an ajax request
    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
        die();
    }


    //Is file size is less than allowed size 20MB. 
    if ($_FILES["FileInput"]["size"] > 20971520) {
        die("File size is too big!");
    }

    //allowed file type Server side check
    switch (strtolower($_FILES['FileInput']['type'])) {
        //allowed file types
        /*  case 'image/png': 
          case 'image/gif':
          case 'image/jpeg':
          case 'image/pjpeg':
          case 'text/plain':
          case 'text/html': //html file */
        case 'application/x-zip-compressed':
        case 'application/pdf':
        case 'application/msword':
        case 'application/vnd.ms-excel':
            // case 'video/mp4':
            break;
        default:
            die('Unsupported File!'); //output error
    }

    $File_Name = strtolower($_FILES['FileInput']['name']);
    $File_Ext = substr($File_Name, strrpos($File_Name, '.')); //get file extention
    $Random_Number = rand(0, 9999999999); //Random number to be added to name.
    $NewFileName = $Random_Number . $File_Ext; //new file name

    if (move_uploaded_file($_FILES['FileInput']['tmp_name'], $UploadDirectory . $NewFileName)) {
        // do other stuff   uploadCW($fileName,$tempName,$UploadTitle,$uploadDate,$studentID) 
        uploadCW($currentUser, $File_Name, $NewFileName, $UploadTitle, $uploadDate, 3);
        die('Success! File Uploaded.');
    } else {
        die('error uploading File!');
    }
}


/**
 * GET UPLOADs
 */
if (isset($_POST['getUploads'])) {
    getUploadedCW_st($currentUser);
}

/**
 * FILTER BY STUDENT TUTOR STATE
 */
if (isset($_GET['tutorFilter'])) {
    $theVal = $_GET['tutorFilter'];
    filterByTutorState($theVal);
}

/**
 * ALLOCATE STUDENTS
 */
if (isset($_GET['studIds'])) {
    $theVal = $_GET['studIds'];
    $stafVal = $_GET['staffID'];

    allocateTutor($theVal, $stafVal);
}

/**
 * FILTER STUDENT -  NO INTERACTION
 */
if (isset($_GET['theDays'])) {
    $theVal = $_GET['theDays'];
    filterNoAction($theVal);
}

/**
 * FILTER STUDENT - MSG Last 7 Days
 */
if (isset($_GET['msgSeven'])) {
    listAllStudents($currentUser, true);
}

/**
 * FILTER STUDENT - MSG Last 7 Days
 */
if (isset($_GET['uploadComment'])) {
    $uploadComment = $_GET['uploadComment'];
    $uploadID = $_GET['uploadID'];
    // $string = nl2br($uploadComment);
    addUploadComment($uploadID, $uploadComment);
}
