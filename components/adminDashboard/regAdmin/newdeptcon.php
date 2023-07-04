<?php
session_start();
$authemail = $_SESSION['authemailadmin'];
if(empty($authemail)){
    header("Location: ../../userLogin/stdLogin.php");
    die();
}
 include('../../../databaseconnection.php');
 $dept = $_POST['dept']; 

 if($con->connect_error){
  die('Connection Failed : '.$con->connect_error);
}
else{
    $sql = "select * from departments where dept = '$dept'";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);
    if($count == 0){  
        $stmt = $con->prepare("insert into departments(dept)
        values(?)");
        $stmt->bind_param("s",$dept);
        $stmt->execute();
        echo '<script>alert("Department Add Successful")</script>';
        header('Refresh: 0.125; URL=registerAdmin.php');
        $stmt->close();
        $con->close();
    }
    
    else{
        echo '<script>alert("Department Already Exist")</script>';
        header('Refresh: 0.125; URL=registerAdmin.php');
    }
}
?>



