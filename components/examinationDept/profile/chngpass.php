<?php
 session_start();
 include('../../../databaseconnection.php');
 $authemail = $_SESSION['authemailexam'];
 if(empty($authemail)){
    header("Location: ../../userLogin/stdLogin.php");
    die();
 }
 $currentpassword = $_POST['currentpassword']; 
 $newpassword = $_POST['newpassword']; 
 $confirmpassword = $_POST['confirmpassword']; 
 $email = $_SESSION['email'];

 if($con->connect_error){
  die('Connection Failed : '.$con->connect_error);
}
else{
    $sql = "SELECT * FROM adminlogin WHERE email = '$email' ";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();
    $password = $row['password'];
    echo $password;
    if($currentpassword == $password){
        if($newpassword == $confirmpassword){
            $sql = "update adminlogin set password = '$newpassword' where email = '$email'";
            $result = $con->query($sql);
            echo '<script>alert("Passwords changed successfully ")</script>';
            header('Refresh: 0.125; URL=profile.php');

        }
        else{
            echo '<script>alert("Passwords do not match")</script>';
            header('Refresh: 0.125; URL=profile.php');
        }
    }
    else{
        echo '<script>alert("Current password is wrong")</script>';
        header('Refresh: 0.125; URL=profile.php');        
    }
}                                   

?>

