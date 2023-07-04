<?php
session_start();
    $authemail = $_SESSION['authemailHod'];
    if(empty($authemail)){
        header("Location: ../../userLogin/stdLogin.php");
        die();
    }
include_once '../../../databaseconnection.php';
$rowid = $_GET["id"];


$sql = "DELETE FROM stdforms WHERE id='$rowid'";
if (mysqli_query($con, $sql)) {
    header('Refresh: 0.125; URL=hodDashboard.php');
} else {
    echo "Error deleting record: " . mysqli_error($con);
}
mysqli_close($con);
?>