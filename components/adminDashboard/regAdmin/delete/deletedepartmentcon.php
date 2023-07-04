<?php
session_start();
$authemail = $_SESSION['authemailadmin'];
if(empty($authemail)){
    header("Location: ../../../userLogin/stdLogin.php");
    die();
}
include_once '../../../../databaseconnection.php';
$sql = "DELETE FROM departments WHERE id='" . $_GET["id"] . "'";
if (mysqli_query($con, $sql)) {
    header('Refresh: 0.125; URL=../registerAdmin.php');
} else {
    echo "Error deleting record: " . mysqli_error($con);
}
mysqli_close($con);
?>