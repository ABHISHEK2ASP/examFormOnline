<?php
session_start();
$authemail = $_SESSION['authemailadmin'];
if(empty($authemail)){
    header("Location: ../../userLogin/stdLogin.php");
    die();
}
 include('../../../databaseconnection.php');
 $name = $_POST['name']; 
 $email=$_POST['email'];
 $mobile_no = $_POST['mobile_no']; 
 $role = $_POST['role']; 
 $doj = $_POST['doj']; 
 $password = $_POST['password']; 
 $gender = $_POST['gender']; 
 $dept = $_POST['dept'];


 if($con->connect_error){
  die('Connection Failed : '.$con->connect_error);
}
else{
    $email = stripcslashes($email);  
    $email = mysqli_real_escape_string($con, $email);
    $sql = "select * from adminlogin where email = '$email'";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);
        if($count == 0){ 
            $status = $statusMsg = ''; 
            if(isset($_POST["submit"])){ 
                $status = 'error'; 
                if(!empty($_FILES["image"]["name"])) { 
                    $fileName = basename($_FILES["image"]["name"]); 
                    $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
                    $allowTypes = array('jpg','png','jpeg'); 
                    if(in_array($fileType, $allowTypes)){ 
                        $image = $_FILES['image']['tmp_name']; 
                        $imgContent = addslashes(file_get_contents($image));  
                        $insert = $con->query("INSERT into adminlogin (image,name,email,mobile_no,dept,role,doj,password,gender) VALUES ('$imgContent','$name','$email','$mobile_no','$dept','$role','$doj','$password','$gender')"); 
                        if($insert){ 
                            $status = 'success'; 
                            $statusMsg = '<script>alert("Registration Successful")</script>';
                            header('Refresh: 0.125; URL=registerAdmin.php'); 
                        }else{ 
                            $statusMsg = '<script>alert("Registration failed, please try again.")</script>'; 
                            header('Refresh: 0.125; URL=registerAdmin.php'); 
                        }  
                    }else{ 
                        $statusMsg = '<script>alert("Sorry, only JPG, JPEG & PNG files are allowed to upload.")</script>'; 
                        header('Refresh: 0.125; URL=registerAdmin.php'); 
                    } 
                }else{ 
                    $statusMsg = '<script>alert("Please select an image file to upload.")</script>';
                    header('Refresh: 0.125; URL=registerAdmin.php');  
                } 
            } 
             
            echo $statusMsg; 
        }  
        else{
            echo '<script>alert("Email Id Is Already Registerd")</script>';
            header('Refresh: 0.125; URL=registerAdmin.php');        }
    }

 ?>

