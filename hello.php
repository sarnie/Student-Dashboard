<?php

$sList = '1,3,5,6,10,15';
$array = explode(',', $sList);

foreach($array as $value) //loop over values
{
    echo  'UPDATE `student` SET `staffID` = :staffID WHERE studentID = '.$value.'<br/>';
}





?>