<?php
 include('../../databaseConnection.php');  
 session_start();
 $usn_number = $_SESSION['usn_number'];
 $usn_number = $_POST['usn_number']; 
 $password = $_POST['password'];


 if($con->connect_error){
  die('Connection Failed : '.$con->connect_error);
}
else{
    $usn_number = stripcslashes($usn_number);  
    $password = stripcslashes($password);
    $usn_number = mysqli_real_escape_string($con, $usn_number);  
    $password = mysqli_real_escape_string($con, $password);
    $sql = "select * from stddetails where usn_number = '$usn_number' and password = '$password'";  
    $_SESSION['usn_number']=$_POST['usn_number'];
    $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
        $id = $row['id']; 
        $authemail = $row["emailid"];
        echo $authemail;
        $count = mysqli_num_rows($result);
        if($count == 1){  
            $_SESSION["id"] = "$id";
            $_SESSION['authemailStd'] = "$authemail";
            header('Location: ../stdPannel/stdForms/stdForm.php');
        }  
        else{
            echo '<script>alert("Wrong USN number OR Password !!!!!")</script>';
            header('Refresh: 0.5; URL=stdLogin.php');
    }
    
}
 ?>

