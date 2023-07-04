<?php
 session_start();
 include('../../../databaseconnection.php');
 $authemail = $_SESSION['authemailadmin'];
 if(empty($authemail)){
     header("Location: ../../userLogin/stdLogin.php");
     die();
 }
 $usn_number = $_SESSION["usn_number"]; 
 $sem = $_SESSION['sem'];

 $Paid=$_POST['Paid'];
 if($con->connect_error){
  die('Connection Failed : '.$con->connect_error);
}
else{
    $usn_number = stripcslashes($usn_number);  
    $usn_number = mysqli_real_escape_string($con, $usn_number);
    $sql = "select * from payment_details where usn_number = '$usn_number' and sem = '$sem'";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);
        if($count == 1){  
            if($_POST['Paid']== "on"){
                $sql = "update payment_details set payment_status = 'Paid' where usn_number = '$usn_number' and sem = '$sem'";
                $result = mysqli_query($con, $sql);
                header('Location: ../cashPayment/cashPayment.php');
        } 
        else{
            alert("Please select the toggel button ! ");
        } 
    }
   }
 ?>

