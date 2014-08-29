<?php

require 'model.php';

define("SITEURL", "http://stuweb.cms.gre.ac.uk/~as563/silvershore");
//Check if session is created
if ((isset($_SESSION['login']) && $_SESSION['login'] != '')) {
    $currentUser = $_SESSION['uId'];
    $uEmail = $_SESSION['uEmail'];

    //check if staffID session exist
    if (isset($_SESSION['staffID'])) {
        $staffID = $_SESSION['staffID'];
    }
}

/**
 * GET PAGE TYPE
 */
function getPageType() {
    $query = $_SERVER['PHP_SELF'];
    $path = pathinfo($query);
    $filename = $path['basename'];
    switch ($filename) {
        case 'index.php':
            return 'home';
            break;
        case 'login.php':
            return 'login';
            break;
        case 'blog.php':
            return 'blog';
            break;
        case 'meetings.php':
            return 'meetings';
            break;
        case 'messages.php':
            return 'messages';
            break;
        case 'uploads.php':
            return 'uploads';
            break;
        case 'stats.php':
            return 'stats';
        case 'list.php':
            return 'list';
            break;
    }
}

/* ===============================================================
 * 	STUDENTS
 * =============================================================== */

/**
 * GET FIRST NAME
 */
function getFirstName($uEmail) {
    $dbHandle = new DBConnection();

    //Db Query for Student table
    $sqlStudent = "SELECT firstName FROM student WHERE email ='" . $uEmail . "'";
    $stmt = $dbHandle->prepare($sqlStudent);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $rowStudent = $stmt->fetch();

    //Db Query for Staff Table
    $sqlStaff = "SELECT firstName FROM staff WHERE email ='" . $uEmail . "'";
    $stmt = $dbHandle->prepare($sqlStaff);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $rowStaff = $stmt->fetch();

    //Check if user email exist in the student table
    if ($rowStudent) {
        echo $rowStudent->firstName;

        //Check if user email exist in the staff table	
    } else if ($rowStaff) {
        echo $rowStaff->firstName;
    }
}

/**
 * GET TUTOR FULL NAME
 */
function getUserFullName($uEmail) {
    $dbHandle = new DBConnection();

    //Db Query for Student table
    $sqlStudent = "SELECT * FROM student WHERE email ='" . $uEmail . "'";
    $stmt = $dbHandle->prepare($sqlStudent);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $rowStudent = $stmt->fetch();

    //Db Query for Staff Table
    $sqlStaff = "SELECT * FROM staff WHERE email ='" . $uEmail . "'";
    $stmt = $dbHandle->prepare($sqlStaff);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $rowStaff = $stmt->fetch();

    //Check if user email exist in the student table
    if ($rowStudent) {
        return $rowStudent->firstName . ' ' . $rowStudent->lastName;

        //Check if user email exist in the staff table	
    } else if ($rowStaff) {
        return $rowStaff->firstName . ' ' . $rowStaff->lastName;
    }
}

/**
 * GET STUDENT FULL NAME
 */
function getStudentUserFullName($uid) {
    $dbHandle = new DBConnection();

    //Db Query for Student table
    $sqlStudent = "SELECT * FROM student WHERE studentID = " . $uid;
    $stmt = $dbHandle->prepare($sqlStudent);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $rowStudent = $stmt->fetch();
    return $rowStudent->firstName . ' ' . $rowStudent->lastName;
}

/**
 * GET PROFILE PICTURE
 */
function getProfilePic($uEmail) {
    $dbHandle = new DBConnection();

    //Db Query for Student table
    $sqlStudent = "SELECT picture FROM student WHERE email ='" . $uEmail . "'";
    $stmt = $dbHandle->prepare($sqlStudent);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $rowStudent = $stmt->fetch();

    //Db Query for Staff Table
    $sqlStaff = "SELECT picture FROM staff WHERE email ='" . $uEmail . "'";
    $stmt = $dbHandle->prepare($sqlStaff);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $rowStaff = $stmt->fetch();

    //Check
    if ($rowStudent) {
        echo $rowStudent->picture;
    } else if ($rowStaff) {
        echo $rowStaff->picture;
    }
}

/**
 * CHECK IF USER IS ADMIN
 */
function is_admin($uEmail) {
    $dbHandle = new DBConnection();
    $sql = "SELECT firstName FROM staff WHERE email ='" . $uEmail . "'";
    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $rowStaff = $stmt->fetch();

    if ($rowStaff) {
        return true;
    } else {
        return false;
    }
}

/**
 * GET STAFF NAME
 */
function getStaffFullName($sId) {
    $dbHandle = new DBConnection();
    $sql = "SELECT * FROM staff WHERE staffID = " . $sId;
    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $rowStaff = $stmt->fetch();

    if ($sId != 0) {
        return $rowStaff->firstName . ' ' . $rowStaff->lastName;
    } else {
        return 'None';
    }
}

function getStaffBlogInfo($sId,$type) {
    $dbHandle = new DBConnection();
    $sql = "SELECT * FROM staff WHERE staffID = " . $sId;
    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $rowStaff = $stmt->fetch();

    if ($type == 'name') {
        return $rowStaff->firstName;
    } else if ($type == 'img') {
       return $rowStaff->picture;
    }
}

/**
 * GET STAFF EMAIL
 */
function getStaffEmail() {
    $dbHandle = new DBConnection();
    $sql = "SELECT * FROM staff WHERE staffID = " . $_SESSION['staffID'];
    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $rowStaff = $stmt->fetch();
    return $rowStaff->email;
}

/**
 * GET STUDENT EMAIL
 */
function getStudentEmail($stuID) {
    $dbHandle = new DBConnection();
    $sql = "SELECT * FROM student WHERE studentID = " . $stuID;
    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $row = $stmt->fetch();
    return $row->email;
}

/**
 * GET THE POST
 */
function getThePost_st($uID) {
    $dbHandle = new DBConnection();
    $sql = "SELECT * FROM blog WHERE studentID = " . $uID . " ORDER BY datePosted DESC";

    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);

    while ($row = $stmt->fetch()) {

        if ($row->blogText != '') {

            $theDate = date_create($row->datePosted);
            $theHtml = '<div class="sha marginBtm30">';
            $theHtml .= '<p><span class="post-date">Posted on: ' . date_format($theDate, 'd/m/Y') . '</span>';
            $theHtml .= $row->blogText . '<br/><a href="" class="comments"><span class="glyphicon glyphicon-comment"></span> Comment</a> </p>';

            //check if post has comment
            if ($row->comment == '') {
                $theHtml .= '<div class="hide media-container"><div class="media clearfix">';
                $theHtml .= ' <div class="media-body"><h4 class="media-heading">No Comment!</h4></div>';
            } else {
                $theHtml .= '<div class="hide media-container"><div class="media clearfix">';
                $theHtml .= '<a class="pull-left" href="#"> <img src="img/'.getStaffBlogInfo($row->staffID,'img').'" class="media-object max40" alt="64x64" /> </a>';
                $theHtml .= ' <div class="media-body"><h4 class="media-heading">'.getStaffBlogInfo($row->staffID,'name').'</h4>' . $row->comment . '</div>';
            }
            $theHtml .= ' </div></div></div>';

            echo $theHtml;
        } else {
            echo 'None';
            break;
        }
    }
}

/**
 * ADD NEW POST
 * @author:Tosin
 * @date:18/02/12 - 13:04
 */
function addThePost($uId, $postContent) {
    $dbHandle = new DBConnection();
    $sql = "INSERT INTO blog (`blogText`, `datePosted`, `studentID`, `staffID`) VALUES ('" . $postContent . "',NOW()," . $uId . ", ".$_SESSION['staffID'].")";
    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();
    echo 'Done';
}

/**
 * GET THE LAST THREE POST
 * @author:Tosin
 * @date:18/02/12 - 13:04
 */
function getLastThreePost($uId) {
    $dbHandle = new DBConnection();
    $sql = "SELECT * FROM blog WHERE studentID =" . $uId . " ORDER BY datePosted DESC LIMIT 0 , 3";
    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);

    while ($row = $stmt->fetch()) {
        $theDate = date_create($row->datePosted);
        $theHtml = '<tr>';
        $theHtml .= '<td>' . trimtext($row->blogText, 120) . '</td>';
        $theHtml .= '<td>' . date_format($theDate, 'd/m/Y') . '</td></tr>';
        echo $theHtml;
    }
}

/**
 * ADD COMMENT TO POST
 * @author:Tosin
 * @date:18/02/12 - 13:04
 */
function addThePostComment($blogId, $postComment) {
    $dbHandle = new DBConnection();
    $sql = "UPDATE blog SET comment= '" . $postComment . "' WHERE blogID =" . $blogId;
    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();
    echo 'Done';
}

/**
 * GET THE POST COMMENTS
 * @author:Tosin
 * @date:18/02/12 - 13:04
 */
function getThePostComments($uId) {
    $dbHandle = new DBConnection();
    $sql = "SELECT * FROM blog WHERE blogID = " . $uId . " ORDER BY datePosted DESC";
    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    
    $row = $stmt->fetch();
    $theHtml = '<div class="media clearfix">';
    $theHtml .= '<a class="pull-left" href="#"> <img src="img/'.getStaffBlogInfo($row->staffID,'img').'" class="media-object max40" alt="64x64" /> </a>';
    $theHtml .= ' <div class="media-body"><h4 class="media-heading">'.getStaffBlogInfo($row->staffID,'name').'</h4>' . $row->comment . '</div></div>';
    
    echo $theHtml;
}

/**
 * ADD NEW MEETING
 * @author:Tosin
 * @date:20/02/12 - 21:23
 */
function createMeeting($type, $studentID, $staffID, $agenda, $meetingTime, $meetingDate) {
    $dbHandle = new DBConnection();
    $sql = "INSERT INTO `meeting` (`type`, `date`, `studentID`, `staffID`, `happened`, `agenda`, `staffDetails`, `meetingTime`, `meetingDate`) VALUES ('" . $type . "',NOW()," . $studentID . "," . $staffID . ",'Pending','" . $agenda . "','','" . $meetingTime . "','" . $meetingDate . "')";
    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();
    echo 'Done';
}

/**
 * GET ALL MEETINGS		
 */
function getMeeting_st($uId, $ajx = 1) {

    $dbHandle = new DBConnection();
    $sql = "SELECT * FROM meeting WHERE studentID = " . $uId . " ORDER BY date DESC";
    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);

    $theHtml = '<table class="table table-striped"><thead><tr>';
    $theHtml .= '<th>Date</th><th>Type</th><th>Agenda</th>';
    $theHtml .= '<th>Details (staff)</th><th>Meeting Date</th>';
    $theHtml .= '<th>Meeting Time (hh:mm)</th> <th>Status</th> </tr> </thead>';

    $x = 1;
    while ($row = $stmt->fetch()) {
        $theDate = date_create($row->date);
        $mDate = date_create($row->meetingDate);
        $mTime = date_create($row->meetingTime);

        if ($x == 1 && $ajx == 1) {
            $addCssClass = 'class="success"';
        } else {
            $addCssClass = '';
        }

        $theHtml .= '<tr ' . $addCssClass . '><td>' . date_format($theDate, 'd/m/Y') . '</td>';
        $theHtml .= '<td>' . $row->type . '</td><td>' . $row->agenda . '</td>';
        $theHtml .= '<td>N/A</td> <td>' . date_format($mDate, 'd/m/Y') . '</td>';
        $theHtml .= '<td>' . date_format($mTime, 'G:i') . ' <td>' . $row->happened . '</td></td>';
        $theHtml .= '</tr>';
        $x++;
    }

    $theHtml .= ' </tbody>
            </table>';
    echo $theHtml;
}

/**
 * ADD NEW FILE
 */
function getUploads() {
    $dbHandle = new DBConnection();
    $sql = "SELECT * FROM upload WHERE studentID = 0";
    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    while ($row = $stmt->fetch()) {
        $mDate = date_create($row->uploadDate);
        $theHtml = '<tr><td>' . $row->UploadTitle . '</td><th>' . date_format($mDate, 'd/m/Y') . '</th><th>
		<span class="hide uptitle">' . $row->UploadTitle . '</span> <span class="hide update">' . $row->uploadDate . '</span>
		<a href="" class="btn btn-success upload-cw-btn"><span class="glyphicon glyphicon-upload"></span> Upload</a></th></tr>';
        echo $theHtml;
    }
}

/**
 * ADD NEW FILE
 */
function uploadCW($studentID, $fileName, $tempName, $UploadTitle, $uploadDate) {
    $dbHandle = new DBConnection();
    $sql = "INSERT INTO `upload`(`fileName`, `dateTimeofUpload`, `comment`, `studentID`, `uploadDate`, `tempName`,`UploadTitle`) VALUES ('" . $fileName . "',NOW(),''," . $studentID . ",'" . $uploadDate . "','" . $tempName . "','" . $UploadTitle . "')";
    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();
    echo 'Done';
}

/**
 * GET ALL UPLOADS	
 */
function getUploadedCW_st($studentID, $ajx = 1) {
    $dbHandle = new DBConnection();

    $sql = "SELECT * FROM upload WHERE studentID = " . $studentID . " ORDER BY UploadTitle DESC, dateTimeofUpload DESC";
    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $theHtml = '<table class="table table-bordered"><thead><tr>';
    $theHtml .= '<th>Upload Type</th><th>File Name</th><th>Date/Time of Upload</th>';
    $theHtml .= '<th>Days Late</th></tr></thead><tbody>';
    $x = 1;
    while ($row = $stmt->fetch()) {
        $dateUploaded = date_create($row->dateTimeofUpload);
        $datesLate = calculateDays($row->uploadDate, $row->dateTimeofUpload);

        if ($x == 1 && $ajx == 1) {
            $addCssClass = 'class="success"';
        } else {
            $addCssClass = '';
        }

        $theHtml .= '<tr><td>' . $row->UploadTitle . '</td><td><a href="uploads/' . $row->tempName . '">' . $row->fileName . '</a></td>';
        $theHtml .= ' <td>' . date_format($dateUploaded, 'd/m/Y G:i') . '</td>';
        $theHtml .= '<td>' . $datesLate . '</td></tr>';

        if ($row->comment != '') {
            $theHtml .= '<tr><td colspan="4"> <h4 class="upCommentTitle">Comment</h4>' . $row->comment . '</td></tr>';
            $theHtml .= '<tr><td colspan="4" class="grayBg">&nbsp;</td></tr>';
        }

        $x++;
    }

    $theHtml .= ' </tbody>
            </table>';
    echo $theHtml;
}

/**
 * GET UPLOADS SUMMARY
 */
function getUploadedCWSummary($studentID) {
    $dbHandle = new DBConnection();

    $sql = "SELECT * FROM upload WHERE studentID = " . $studentID . " ORDER BY UploadTitle DESC, dateTimeofUpload DESC LIMIT 0 , 3";
    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $theHtml = '<tbody>';

    while ($row = $stmt->fetch()) {
        $dateUploaded = date_create($row->dateTimeofUpload);
        $theHtml .= '<tr><td>' . $row->UploadTitle . '</td><td>' . date_format($dateUploaded, 'd/m/Y G:i') . '</td></tr>';
    }

    $theHtml .= '</tbody>';
    echo $theHtml;
}

/**
 * GET THE MEETING SUMMARY		
 */
function getMeetingSummary($studentID) {
    $dbHandle = new DBConnection();
    $sqlRequest = "SELECT * FROM meeting WHERE studentID = " . $studentID;
    $rqTotal = $dbHandle->prepare($sqlRequest);
    $rqTotal->execute();

    $sqlReal = "SELECT * FROM meeting WHERE studentID = " . $studentID . " AND type = 'Real'";
    $realTotal = $dbHandle->prepare($sqlReal);
    $realTotal->execute();

    $sqlVirtual = "SELECT * FROM meeting WHERE studentID = " . $studentID . " AND type = 'Virtual'";
    $virtualTotal = $dbHandle->prepare($sqlVirtual);
    $virtualTotal->execute();

    $sqlCanceled = "SELECT * FROM meeting WHERE studentID = " . $studentID . " AND happened = 'Cancelled'";
    $canceledTotal = $dbHandle->prepare($sqlCanceled);
    $canceledTotal->execute();

    $numRequest = $rqTotal->rowCount();
    $numVirtual = $virtualTotal->rowCount();
    $numReal = $realTotal->rowCount();
    $numCanceled = $canceledTotal->rowCount();

    if (is_admin($_SESSION['uEmail'])) {
        $requestBtn = '&nbsp;';
    } else {
        $requestBtn = '<a href="meetings.php?rq=1" class="btn btn-success">Request</a>';
    }

    $theHtml = '<tr> <td class="no-top-border">Request</td><td class="no-top-border" colspan="2">' . $numRequest . '</td></tr>';
    $theHtml .= '<tr><td>Real</td><td>' . $numVirtual . '</td><td align="center">' . $requestBtn . '</td></tr>';
    $theHtml .= '<tr><td>Virtual</td><td>' . $numReal . '</td><td align="center">' . $requestBtn . '</td></tr>';
    $theHtml .= '<tr><td>Cancelled</td><td colspan="2">' . $numCanceled . '</td></tr>';
    echo $theHtml;
}

/**
 * GET THE LAST MEETING DATE		
 */
function getLastMeetingDate($studentID) {
    $dbHandle = new DBConnection();
    $sql = "SELECT * FROM meeting WHERE studentID = " . $studentID . " ORDER BY meetingDate DESC LIMIT 0 , 1";
    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $row = $stmt->fetch();
    if ($row) {
        $meetingDate = date_create($row->meetingDate);
        $theHtml = 'Last Meeting: ' . date_format($meetingDate, 'd/m/Y');
    } else {
        $theHtml = ' ';
    }

    echo $theHtml;
}

/**
 * COMPOSE MESSAGE
 */
function sendMessage($fromID, $toID, $messageText) {
    $dbHandle = new DBConnection();

    $array = explode(',', $toID);

    foreach ($array as $value) { //loop over values
        $sql = "INSERT INTO message (`fromID`, `toID`, `messageText`, `dateSent`) VALUES ('" . $fromID . "','" . $value . "','" . $messageText . "',NOW())";
        $stmt = $dbHandle->prepare($sql);
        $stmt->execute();
    }

    echo 'Done';
}

/**
 * GET THE MESSAGES	
 */
function getInboxMessage($uEmail) {
    $dbHandle = new DBConnection();
    $sql = "SELECT * FROM message WHERE toID = '" . $uEmail . "' ORDER BY dateSent DESC";

    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $x = 1;
    while ($row = $stmt->fetch()) {
        $dateSent = date_create($row->dateSent);
        $cleanDate = date_format($dateSent, 'd/m/Y');

        $theHtml = '<p class="sha"> <span class="post-date clearfix"> <span class="pull-left">From: ' . getUserFullName($row->fromID) . '</span> <span class="pull-right">Date: ' . $cleanDate . '</span> </span>' . $row->messageText . ' </p>';
        echo $theHtml;
    }
}

/**
 * GET SENT MESSAGES	
 */
function getOutboxMessage($uEmail) {
    $dbHandle = new DBConnection();
    $sql = "SELECT * FROM message WHERE fromID = '" . $uEmail . "' ORDER BY dateSent DESC";
    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $x = 1;
    while ($row = $stmt->fetch()) {
        $dateSent = date_create($row->dateSent);
        $cleanDate = date_format($dateSent, 'd/m/Y');

        $theHtml = '<p class="sha"> <span class="post-date clearfix"> <span class="pull-left">To: ' . getUserFullName($row->toID) . '</span> <span class="pull-right">Date: ' . $cleanDate . '</span> </span>' . $row->messageText . ' </p>';
        echo $theHtml;
    }
}

function toMessageSummary($uID) {
    $dbHandle = new DBConnection();
    $sql = "SELECT * FROM message WHERE fromID = '" . $uID . "' ORDER BY dateSent DESC";
    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $row = $stmt->fetch();

    $sentMsgCount = 0;
    $cleanDate = 'None';

    if ($row) {
        $sentMsgCount = $stmt->rowCount();
        $dateSent = date_create($row->dateSent);
        $cleanDate = date_format($dateSent, 'd/m/Y');
    }

    $theHtml = '<p class="circle outbox m-marginBtm"><img src="img/circleTran.png" id="circleTran" /> <span>' . $sentMsgCount . '</span></p>
            <p class="sender">To Tutor</p>
            <p class="last-date fadeTxt">Last Message: ' . $cleanDate . '</p>';

    echo $theHtml;
}

function fromMessageSummary($uID) {

    $dbHandle = new DBConnection();
    $sql = "SELECT * FROM message WHERE toID = '" . $uID . "' ORDER BY dateSent DESC";
    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $row = $stmt->fetch();

    $sentMsgCount = 0;
    $cleanDate = 'None';

    if ($row) {
        $sentMsgCount = $stmt->rowCount();
        $dateSent = date_create($row->dateSent);
        $cleanDate = date_format($dateSent, 'd/m/Y');
    }

    $theHtml = '<p class="circle inbox m-marginBtm"> <span>' . $sentMsgCount . '</span></p>
            <p class="sender">From Tutor</p>
            <p class="last-date fadeTxt">Last Message: ' . $cleanDate . '</p>';
    echo $theHtml;
}

/* ===============================================================
 * 	STAFFS
 * =============================================================== */

/**
 * CHECK IF SUPER ADMIN
 */
function is_superAdmin() {
    $dbHandle = new DBConnection();
    $sql = 'SELECT * from staff WHERE email = :email AND role = 2 ';

    $stmt = $dbHandle->prepare($sql);
    $stmt->bindParam(':email', $_SESSION['uEmail'], PDO::PARAM_STR); // <-- Automatically sanitized by PDO
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);

    $row = $stmt->fetch();

    if ($row) {
        return true;
    } else {
        return false;
    }
}

/**
 * GET POST - (TUTOR)
 */
function getThePost_tu($uID) {
    $dbHandle = new DBConnection();
    if (!is_superAdmin()) {
        $sql = "SELECT blog.* FROM staff INNER JOIN (student INNER JOIN blog ON student.studentID = blog.studentID) ON staff.staffID = student.staffID WHERE (((student.staffID)=" . $uID . ")) ORDER BY datePosted DESC";
    } else {
        $sql = "SELECT * FROM blog ORDER BY datePosted DESC";
    }
    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);

    while ($row = $stmt->fetch()) {

        if ($row->blogText != '') {

            $theDate = date_create($row->datePosted);
            $theHtml = '<div class="sha marginBtm30">';
            $theHtml .= '<p><span class="post-date pull-left">By: ' . getStudentUserFullName($row->studentID) . '</span> <span class="post-date pull-right">Posted on: ' . date_format($theDate, 'd/m/Y') . '</span>
        <span class="clear"></span>';
            $theHtml .= $row->blogText . '<br/><a href="" class="comments"><span class="glyphicon glyphicon-comment"></span> Comment</a>';

            //Check if User is Admin
            if (!is_superAdmin()) {
                $theHtml .= '<a href="" class="addComment-btn">Add Comment</a>';
            }
            $theHtml .= '</p>';

            //Check if User is Admin
            if (!is_superAdmin()) {
                $theHtml .= '<div class="addComment hide"><form role="form" id="add-post-comment"><input type="hidden" value="' . $row->blogID . '" class="blogId"/><div class="form-group">';
                $theHtml .= '<textarea class="form-control" rows="3" placeholder="Enter your comment.." id="p-comment"></textarea> </div> <div class="form-group">';
                $theHtml .= '<button type="submit" class="btn btn-success">Add Comment</button></div></form></div>';
            }
            //check if post has comment

            if ($row->comment == '') {
                $theHtml .= '<div class="hide media-container" id="'.$row->blogID.'"><div class="media clearfix">';
                $theHtml .= ' <div class="media-body"><h4 class="media-heading">No Comment!</h4></div>';
            } else {
                $theHtml .= '<div class="hide media-container" id="'.$row->blogID.'"><div class="media clearfix">';
                $theHtml .= '<a class="pull-left" href="#"> <img src="img/'.getStaffBlogInfo($row->staffID,'img').'" class="media-object max40" alt="64x64" /> </a>';
                $theHtml .= ' <div class="media-body"><h4 class="media-heading">'.getStaffBlogInfo($row->staffID,'name').'</h4>' . $row->comment . '</div>';
            }

            $theHtml .= ' </div></div></div>';
            echo $theHtml;
        } else {
            echo 'None';
            break;
        }
    }
}

/**
 * GET ALL MEETINGS - (TUTOR)		
 */
function getMeeting_tu($uId, $ajx = 1, $status = 'Pending') {
    $dbHandle = new DBConnection();
    
    if(!is_superAdmin()){
        if($status == 'Accepted'){
            $sql = "SELECT * FROM meeting WHERE staffID = " . $uId . " AND NOT happened = 'Pending' ORDER BY date DESC";
        }else{
          $sql = "SELECT * FROM meeting WHERE staffID = " . $uId . " AND happened = '" . $status . "' ORDER BY date DESC";
        }
    }else{
        $sql = "SELECT * FROM meeting WHERE happened = '" . $status . "' ORDER BY date DESC"; 
    }
    
    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);

    $theHtml = '<table class="table table-striped"><thead><tr><th>Date</th>';
    $theHtml .= '<th>Type</th><th>Agenda</th>';
    if ($status != 'Pending') {
    $theHtml .= '<th>Details (staff)</th>';
    }
    $theHtml .= '<th>Meeting Date</th>';
    $theHtml .= '<th>Meeting Time (hh:mm)</th>';
    
    if ($status != 'Pending') {
        $theHtml .= '<th>Status</th>';
        
        if(!is_superAdmin()){
        $theHtml .= '<th>Action</th>';
        }
    } else if(!is_superAdmin()) {
        
        $theHtml .= '<th>Action</th>';
        
    }
    $theHtml .='</tr> </thead>';

    $x = 1;
    while ($row = $stmt->fetch()) {
        $theDate = date_create($row->date);
        $mDate = date_create($row->meetingDate);
        $mTime = date_create($row->meetingTime);

        if ($x == 1 && $ajx == 1) {
            $addCssClass = 'class="success"';
        } else {
            $addCssClass = '';
        }

        $theHtml .= '<tr ' . $addCssClass . '><td>' . date_format($theDate, 'd/m/Y') . '</td>';
        $theHtml .= '<td>' . $row->type . '</td><td>' . $row->agenda . '</td>';
        
        
        if($row->staffDetails == '' && $status != 'Pending' ) {
            $theHtml .= '<td>N/A</td>';
        }else if($status != 'Pending'){
            $theHtml .= '<td>'.$row->staffDetails.'</td>';
        }

        $theHtml .= '<td>'.date_format($mDate,'d/m/Y').'</td> <td>'.date_format($mTime, 'G:i').'</td>';

        if ($status == 'Pending' && !is_superAdmin()) {
            $theHtml .= '<td> <form role="form" id="meeting-action"><input type="hidden" id="meetAct" /><div class="btn-group">';
            $theHtml .= '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span>';
            $theHtml .= '</button><ul class="dropdown-menu pull-right" role="menu"><li><a href="" class="acc" value="Accept">';
            $theHtml .= '<span class="glyphicon glyphicon-ok accept"></span> Accept<span class="hide">'.$row->meetingID.'</span></a></li>';
            $theHtml .= '<li class="divider"></li><li><a href="" class="dec" value="Decline"><span class="glyphicon glyphicon-remove decline"></span>';
            $theHtml .= 'Decline<span class="hide">'.$row->meetingID.'</span></a></li></ul></div> </form></td>';
        } else if ($status == 'Accepted') {
            $theHtml .= '<td> ' . $row->happened . ' </td>';
            if(!is_superAdmin()){
            $theHtml .= '<td><a href="" class="btn btn-success sam">Edit meeting <span class="hide">'.$row->meetingID.'</span></a></td>';
            }
        }

        $theHtml .= '</tr>';
        $x++;
    }

    $theHtml .= ' </tbody></table>';
    echo $theHtml;
}

/**
 * ACCEPT MEETING - (TUTOR)     
 */
function acceptMeeting_tu($meetingId, $happened) {

    if ($happened == 0) {
        $meetState = 'Pending';
    } else if ($happened == 1) {
        $meetState = 'Accepted';
    } else if ($happened == 2) {
        $meetState = 'Cancelled';
    }

    $dbHandle = new DBConnection();
    $sql = "UPDATE meeting SET happened = '" . $meetState . "' WHERE meetingID = " . $meetingId;
    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();

    echo 'Done';
}

/**
 * UPDATE MEETINGS - (TUTOR)        
 */
function updateMeeting_tu($meetingId, $staffDetails) {

    $dbHandle = new DBConnection();
    $sql = "UPDATE meeting SET staffDetails = '" . $staffDetails . "' WHERE meetingID = " . $meetingId;
    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();

    echo 'Done';
}

/**
 * GET ALL UPLOADS	- (TUTOR)
 */
function getUploadedCW_tu($uID, $ajx = 1) {
    $dbHandle = new DBConnection();

    if (!is_superAdmin()) {
        $sql = "SELECT upload.* FROM staff INNER JOIN (student INNER JOIN upload ON student.studentID = upload.studentID) ON staff.staffID = student.staffID WHERE (((student.staffID)=" . $uID . "))";
    } else {
        $sql = "SELECT * from upload";
    }
    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $theHtml = '<table class="table table-bordered"><thead><tr>';
    $theHtml .= '<th>Upload Type</th><th>File Name</th><th>Date/Time of Upload</th>';
    $theHtml .= '<th>Days Late</th></tr></thead><tbody>';
    $x = 1;
    while ($row = $stmt->fetch()) {
        $dateUploaded = date_create($row->dateTimeofUpload);
        $datesLate = calculateDays($row->uploadDate, $row->dateTimeofUpload);

        if ($x == 1 && $ajx == 1) {
            $addCssClass = 'class="success"';
        } else {
            $addCssClass = '';
        }

        $theHtml .= '<tr><td>' . $row->UploadTitle . '</td><td><a href="uploads/' . $row->tempName . '">' . $row->fileName . '</a></td>';
        $theHtml .= ' <td>' . date_format($dateUploaded, 'd/m/Y G:i') . '</td>';
        $theHtml .= '<td>' . $datesLate . '</td></tr>';

        if ($row->comment == '' && !is_superAdmin()) {
            $theHtml .= '<tr><td colspan="4" id="' . $row->uploadID . '"><h4 class="upCommentTitle">Comment</h4>';
            $theHtml .= '<p class="hide"></p><a href="" class="btn btn-success btn-sm addCommentBtn">Add Comment</a>';
            $theHtml .= '<div class="addComment hide"><form role="form" id="add-upload-comment"><input type="hidden" value="7" class="blogId">';
            $theHtml .= '<div class="form-group"><textarea class="form-control" rows="3" placeholder="Enter your comment.." id="p-comment"></textarea></div>';
            $theHtml .= '<div class="form-group"><button type="submit" class="btn btn-success btn-sm">Add Comment</button></div></form></div></td></tr>';
            $theHtml .= '<tr><td colspan="4">&nbsp;</td></tr>';
        } else {
            $theHtml .= '<tr><td colspan="4"><h4 class="upCommentTitle">Comment</h4> <p>' . $row->comment . '</p></td></tr>';
            $theHtml .= '<tr><td colspan="4" class="grayBg">&nbsp;</td></tr>';
        }

        $x++;
    }

    $theHtml .= ' </tbody>
            </table>';
    echo $theHtml;
}

/**
 * ADD COMMENT TO POST
 */
function addUploadComment($upID, $upComment) {
    $dbHandle = new DBConnection();
    $sql = 'UPDATE upload SET comment = :comment WHERE uploadID = :id';
    $stmt = $dbHandle->prepare($sql);
    $stmt->bindParam(':comment', $upComment, PDO::PARAM_STR);
    $stmt->bindParam(':id', $upID, PDO::PARAM_INT);
    $stmt->execute();
    echo 'Done';
}

/**
 * LIST ALL STAFF STUDENTS
 */
function listAllStudents($uID, $msgFilter = false) {
    $dbHandle = new DBConnection();

    //Check if super admin
    if (is_superAdmin()) {
        $sql = "SELECT * from student";
        $stmt = $dbHandle->prepare($sql);
    } else {
        $sql = "SELECT * from student WHERE staffID = :id";
        $stmt = $dbHandle->prepare($sql);
        $stmt->bindParam(':id', $uID, PDO::PARAM_INT); // <-- Automatically sanitized by PDO
    }


    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $theHtml = '<table class="table table-striped">
              <thead>
                <tr>';

    if (is_superAdmin()) {
        $theHtml .= '<th><input type="checkbox" id="select-all" /></th>';
    }

    $theHtml .= '<th>First Name</th>
				  <th>Last Name</th>
				  <th>Email</th>
				  <th>Tutor</th>
                  <th class="text-center">Last Login</th>
                  <th class="text-center">Number of Messages</th>
                </tr>
              </thead>
              <tbody>';


    while ($row = $stmt->fetch()) {
        $theDate = date_create($row->lastLogin);

        if (is_superAdmin()) {
            $theHtml .= '<tr>';
            $theHtml .= "<td><input type='checkbox' value='$row->studentID' id='checkbox-$row->studentID' class='addStudent' /></td>";
        }

        $theHtml .= '<td>' . $row->firstName . '</td> <td>' . $row->lastName . '</td>
				  <td>' . $row->email . '</td>
				  <td>' . getStaffFullName($row->staffID) . '</td>
                  <td class="text-center">' . date_format($theDate, 'd/m/Y') . '</td>';

        if (!$msgFilter) {
            $theHtml .= '<td class="text-center">' . studentSentMsgCount($row->email) . '</td></tr>';
        } else {
            $theHtml .= '<td class="text-center">' . studentSentMsgCount($row->email, true) . '</td></tr>';
        }
    }

    $theHtml .= ' </tbody>
            </table>';

    echo $theHtml;
}

/**
 * FILTER STUDENT
 */
function filterByTutorState($theValue) {
    $dbHandle = new DBConnection();

    //Check if super admin
    if ($theValue == 'notutor') {
        $sql = "SELECT * from student WHERE staffID = 0";
    } else if ($theValue == 'all' && is_superAdmin()) {
        $sql = "SELECT * from student";
    } else {
        $sql = "SELECT * from student WHERE staffID =" . $_SESSION['uId'];
    }

    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $theHtml = '<table class="table table-striped"><thead><tr>';

    if (is_superAdmin()) {
        $theHtml .= '<th><input type="checkbox" id="select-all" /></th>';
    }

    $theHtml .= '<th>First Name</th><th>Last Name</th><th>Email</th>';
    $theHtml .= '<th>Tutor</th><th class="text-center">Last Login</th>';
    $theHtml .= '<th class="text-center">Number of Messages</th></tr></thead><tbody>';


    while ($row = $stmt->fetch()) {
        $theDate = date_create($row->lastLogin);

        if (is_superAdmin()) {
            $theHtml .= '<tr>';
            $theHtml .= "<td><input type='checkbox' value='$row->studentID' id='checkbox-$row->studentID' class='addStudent' /></td>";
        }

        $theHtml .= '<td>' . $row->firstName . '</td> <td>' . $row->lastName . '</td><td>' . $row->email . '</td>';
        $theHtml .= '<td>' . getStaffFullName($row->staffID) . '</td><td class="text-center">' . date_format($theDate, 'd/m/Y') . '</td>';
        $theHtml .= '<td class="text-center">' . studentSentMsgCount($row->email) . '</td></tr>';
    }

    $theHtml .= ' </tbody></table>';

    echo $theHtml;
}

/**
 * FILTER STUDENT -  NO INTERACTION
 */
function filterNoAction($theDays) {
    $dbHandle = new DBConnection();


    //Check if super admin
    if (is_superAdmin()) {
        $sql = "SELECT * FROM student WHERE lastLogin < DATE_SUB( CURDATE( ) , INTERVAL " . $theDays . " DAY ) ORDER BY lastLogin DESC ";
        $stmt = $dbHandle->prepare($sql);
    } else {
        $sql = "SELECT * FROM student WHERE lastLogin < DATE_SUB( CURDATE( ) , INTERVAL " . $theDays . " DAY ) AND staffID = :id ORDER BY lastLogin DESC";
        $stmt = $dbHandle->prepare($sql);
        $stmt->bindParam(':id', $_SESSION['uId'], PDO::PARAM_INT); // <-- Automatically sanitized by PDO  
    }


    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);

    $theHtml = '<table class="table table-striped">
              <thead>
                <tr>';

    if (is_superAdmin()) {
        $theHtml .= '<th><input type="checkbox" id="select-all" /></th>';
    }

    $theHtml .= '<th>First Name</th><th>Last Name</th><th>Email</th><th>Tutor</th>';
    $theHtml .= '<th class="text-center">Last Login</th><th class="text-center">Number of Messages</th>';
    $theHtml .= '</tr></thead><tbody>';


    while ($row = $stmt->fetch()) {
        $theDate = date_create($row->lastLogin);

        if (is_superAdmin()) {
            $theHtml .= '<tr>';
            $theHtml .= "<td><input type='checkbox' value='$row->studentID' id='checkbox-$row->studentID' class='addStudent' /></td>";
        }

        $theHtml .= '<td>' . $row->firstName . '</td> <td>' . $row->lastName . '</td><td>' . $row->email . '</td>';
        $theHtml .= '<td>' . getStaffFullName($row->staffID) . '</td><td class="text-center">' . date_format($theDate, 'd/m/Y') . '</td>';
        $theHtml .= '<td class="text-center">' . studentSentMsgCount($row->email) . '</td></tr>';
    }

    $theHtml .= ' </tbody></table>';

    echo $theHtml;
}

/**
 * STUDENT SENT MESSAGE COUNT
 */
function studentSentMsgCount($studentEmail, $filterMsg = false) {
    $dbHandle = new DBConnection();

    // if(is_superAdmin()){
    if (!$filterMsg) {
        $sql = 'SELECT * FROM message WHERE fromID = :email ORDER BY dateSent DESC';
    } else {
        $sql = 'SELECT * FROM message WHERE fromID = :email AND dateSent > DATE_SUB( CURDATE( ) , INTERVAL 7 DAY ) ORDER BY dateSent DESC';
    }

    $stmt = $dbHandle->prepare($sql);
    $stmt->bindParam(':email', $studentEmail, PDO::PARAM_STR); // <-- Automatically sanitized by PDO


    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $row = $stmt->fetch();

    $sentMsgCount = 0;
    $cleanDate = 'None';

    if ($row) {
        $sentMsgCount = $stmt->rowCount();
        return $sentMsgCount;
    } else {
        return 0;
    }
}

/**
 * ALLOCATE TO STUDENT TO TUTORS
 */
function allocateTutor($stuId, $staffID) {
    $dbHandle = new DBConnection();

    $array = explode(',', $stuId);

    foreach ($array as $value) { //loop over values
        $sql = 'UPDATE student SET staffID = ' . $staffID . ' WHERE studentID =' . $value;
        $stmt = $dbHandle->prepare($sql);
        $stmt->execute();
    }

    echo 'Done';
}

function studentDropDown() {
    $dbHandle = new DBConnection();
    //Check if super admin
    if (!is_superAdmin()) {
        $sql = "SELECT * FROM student WHERE staffID = :id";
        $stmt = $dbHandle->prepare($sql);
        $stmt->bindParam(':id', $_SESSION['uId'], PDO::PARAM_INT); // <-- Automatically sanitized by PDO  
    } else {
        $sql = "SELECT * FROM student";
        $stmt = $dbHandle->prepare($sql);
    }

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    
    while ($row = $stmt->fetch()) {
        if ($_GET['id'] == $row->studentID) {
            $isActive = 'selected';
        } else {
            $isActive = '';
        }
        $theHtml .= '<option value="'.SITEURL.'?id=' . $row->studentID . '" ' . $isActive . '> ' . $row->firstName . ' ' . $row->lastName . ' </option>';
    }


    echo $theHtml;
}

function getTutorOptionList() {
    $dbHandle = new DBConnection();
    $sql = "SELECT * FROM staff WHERE role = 1";
    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    while ($row = $stmt->fetch()) {
        $theHtml .= '<option value="' . $row->staffID . '"> ' . $row->firstName . ' ' . $row->lastName . ' </option>';
    }
    return $theHtml;
}

/**
 * GET TUTOR SUMMARY	
 */
function getStudentTutorSummary($uID) {
    $dbHandle = new DBConnection();
    $sql = 'SELECT staff.* FROM staff INNER JOIN student ON staff.staffID = student.staffID WHERE (((student.studentID)=' . $uID . '))';

    $stmt = $dbHandle->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $row = $stmt->fetch();
    if ($row) {
        $theHtml = '<p class="posRel"><img src="img/' . $row->picture . '" class="img-circle" /></p>';
        $theHtml .= '<p>' . $row->firstName . ' ' . $row->lastName . '<br/> Room: ' . $row->room . ' </p>';
    } else {
        $theHtml = '<p class="posRel"><img src="img/notutor.jpg" class="img-circle" /></p>';
        $theHtml .= '<p>Not Allocated a tutor </p>';
    }

    return $theHtml;
}

/* ===============================================================
 * 	GENERAL FUNCTIONS
 * =============================================================== */

/* This function will calculate the days difference
 */

function calculateDays($dateDue, $dateUploaded) {
    $date1 = new DateTime($dateDue);
    $date2 = new DateTime($dateUploaded);
    $interval = $date1->diff($date2);
    //$dd = date_create($dateUploaded);
//	$dateUpld = date_format($dateUploaded,'Y-m-d');
    $curdate = strtotime($dateDue);
    $mydate = strtotime($dateUploaded);

    if ($mydate > $curdate) {
        $days = 0;
    } else {
        $days = $interval->d;
    }

    return $days;
}

/* This function will trim text without 
  cutting it in the middle of the word and
  adding &hellip; if longer
 */

function trimtext($text, $length) {
    $words = explode(" ", $text);
    $newtext = "";
    $addhellip = "";
    foreach ($words as $word) {

        if (strlen($newtext . " " . $word) < $length) {
            $newtext .= " " . $word;
        } else {
            $addhellip = 1;
            break;
        }
    }


    if ($addhellip) {
        $newtext .= "&hellip;";
    }

    return $newtext;
}
