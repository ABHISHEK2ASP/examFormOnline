<?php
use SimpleExcel\SimpleExcel;
session_start();
include('../../../databaseconnection.php');
$authemail = $_SESSION['authemailadmin'];
if(empty($authemail)){
   header("Location: ../../userLogin/stdLogin.php");
   die();
}

if(isset($_POST['import'])){

if(move_uploaded_file($_FILES['excel_file']['tmp_name'],$_FILES['excel_file']['name'])){
    require_once('SimpleExcel/SimpleExcel.php'); 
    
    $excel = new SimpleExcel('csv');                  
    
    $excel->parser->loadFile($_FILES['excel_file']['name']);           
    
    $foo = $excel->parser->getField(); 

    $count = 1;

    while(count($foo)>$count){
        $name = $foo[$count][0];
        $emailid = $foo[$count][1];
        $usn_number = $foo[$count][2];
        $password = $foo[$count][3]; 
        $department = $foo[$count][4]; 
        $abc_id = $foo[$count][5]; 
        $unversity_enno = $foo[$count][6]; 


        $query = "INSERT INTO stddetails (name,emailid,usn_number,password,department,abc_id,unversity_enno) ";
        $query.="VALUES ('$name','$emailid','$usn_number','$password','$department','$abc_id','$unversity_enno')";
        mysqli_query($con,$query);
        $count++;
    }
    echo "<script>window.location.href='addStddetails.php';</script>";
    
               
    
    
               
    
    
}
   
    
    
}
?>