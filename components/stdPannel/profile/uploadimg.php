<?php
session_start();
 include('../../../databaseconnection.php');
 $authemail = $_SESSION['authemailStd'];
 if(empty($authemail)){
     header("Location: ../../userLogin/stdLogin.php");
     die();
 }
 $usn_number = $_SESSION['usn_number'];
 echo $usn_number;


 if($con->connect_error){
  die('Connection Failed : '.$con->connect_error);
}
else{
    $status = $statusMsg = ''; 
            if(isset($_POST["submit"])){ 
                $status = 'error'; 
                if(!empty($_FILES["image"]["name"])) { 
                    $fileName = basename($_FILES["image"]["name"]); 
                    $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
                    $allowTypes = array('jpg','png','jpeg','gif'); 
                    if(in_array($fileType, $allowTypes)){ 
                        $image = $_FILES['image']['tmp_name']; 
                        $imgContent = addslashes(file_get_contents($image));  
                        $insert = $con->query("UPDATE stddetails SET image = '$imgContent' WHERE usn_number = '$usn_number';"); 
                        if($insert){ 
                            $status = 'success'; 
                            header('Refresh: 0.125; URL=profile.php'); 
                        }else{ 
                            $statusMsg = '<script>alert("Upload failed, please try again.")</script>'; 
                            header('Refresh: 0.125; URL=profile.php'); 
                        }  
                    }else{ 
                        $statusMsg = '<script>alert("Sorry, only JPG, JPEG & PNG files are allowed to upload.")</script>'; 
                        header('Refresh: 0.125; URL=profile.php'); 
                    } 
                }else{ 
                    $statusMsg = '<script>alert("Please select an image file to upload.")</script>';
                    header('Refresh: 0.125; URL=profile.php');  
                } 
            } 
             
            echo $statusMsg; 
    }
 ?>
