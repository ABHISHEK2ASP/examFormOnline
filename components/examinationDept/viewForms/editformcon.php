<?php
 session_start();
 include('../../../databaseconnection.php');
 $authemail = $_SESSION['authemailexam'];
 if(empty($authemail)){
     header("Location: ../../userLogin/stdLogin.php");
     die();
 }


 $sem = $_POST['sem'];
 $name_of_exam = $_POST['name_of_exam'];
 $credit = $_POST['credit']; 
 $sgpa = $_POST['sgpa']; 
 $status = $_POST['status']; 
 $usn_number = $_SESSION["usn_number"];
 $id = $_SESSION['id'];

 if($con->connect_error){
  die('Connection Failed : '.$con->connect_error);
}
else{
    $table = 'sem'.$sem.'result';
    $sql = "update $table set name_of_exam = '$name_of_exam', credit = '$credit' , sgpa = '$sgpa' , status = '$status' where usn_number = '$usn_number' ";
    $result = mysqli_query($con, $sql);
    header("Location: viewForms.php?id=$id");
}
 ?>

