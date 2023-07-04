<?php
session_start();
include_once '../../../databaseconnection.php';
$authemail = $_SESSION['authemailexam'];
if(empty($authemail)){
    header("Location: ../../userLogin/stdLogin.php");
    die();
}
$rowid = $_GET["id"];

$sql = "DELETE FROM stddetails WHERE id='$rowid'";
if (mysqli_query($con, $sql)) {
    header('Refresh: 0.125; URL=uplaodExamDetails.php');
} else {
    echo "Error deleting record: " . mysqli_error($con);
}
mysqli_close($con);
?>