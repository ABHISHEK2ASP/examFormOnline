<?php
session_start();
    $authemail = $_SESSION['authemailHod'];
    if(empty($authemail)){
        header("Location: ../../userLogin/stdLogin.php");
        die();
    }
    if(isset($_POST['but_update'])){
        if(isset($_POST['update'])){
            foreach($_POST['update'] as $updateid){
                $updateUser = "UPDATE stdforms SET 
                formstatus='Approved'
                WHERE id=".$updateid;
                mysqli_query($con,$updateUser); 
            }
             
        }
        
    }
    
?> 