<?php
session_start();
$authemail = $_SESSION['authemailadmin'];
if(empty($authemail)){
    header("Location: ../../userLogin/stdLogin.php");
    die();
}
 include('../../../databaseconnection.php');
 $dept = $_POST['dept']; 
 $sem=$_POST['sem'];
 $course_code = $_POST['course_code']; 
 $course_name = $_POST['course_name']; 
 $theory_or_practical = $_POST['theory_or_practical']; 
 $credit = $_POST['credit']; 



 if($con->connect_error){
  die('Connection Failed : '.$con->connect_error);
}
else{
    $sql = "select * from courses where course_code = '$course_code'";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);
    if($count == 0){  
        $stmt = $con->prepare("insert into courses(dept,sem,course_code,course_name,theory_or_practical,credit)
        values(?,?,?,?,?,?)");
        $stmt->bind_param("ssssss",$dept,$sem,$course_code,$course_name,$theory_or_practical,$credit);
        $stmt->execute();
        echo '<script>alert("Course Add Successful")</script>';
        header('Refresh: 0.5; URL=registerAdmin.php');
        $stmt->close();
        $con->close();
    }
    
    else{
        echo '<script>alert("Course Is Already Registerd")</script>';
            header('Refresh: 0.125; URL=registerAdmin.php'); 
    }
}
 ?>

