<?php
use SimpleExcel\SimpleExcel;
session_start();
include('../../../databaseconnection.php');
$authemail = $_SESSION['authemailexam'];
if(empty($authemail)){
    header("Location: ../../userLogin/stdLogin.php");
    die();
}
$sem = $_POST['sem'];
if(isset($_POST['import'])){

if(move_uploaded_file($_FILES['excel_file']['tmp_name'],$_FILES['excel_file']['name'])){
    require_once('SimpleExcel/SimpleExcel.php'); 
    
    $excel = new SimpleExcel('csv');                  
    
    $excel->parser->loadFile($_FILES['excel_file']['name']);           
    
    $foo = $excel->parser->getField(); 

    $count = 1;

    while(count($foo)>$count){
        $table = 'sem'.$sem.'result';
        $usn_number = $foo[$count][0];
        $name = $foo[$count][1];
        $name_of_exam = $foo[$count][2];
        $credit = $foo[$count][3];
        $sgpa = $foo[$count][4];
        $status = $foo[$count][5];



        $query = "INSERT INTO $table (usn_number,name,name_of_exam,credit,sgpa,status) ";
        $query.="VALUES ('$usn_number','$name','$name_of_exam','$credit','$sgpa','$status')";
        mysqli_query($con,$query);
        $count++;
    }
    echo "<script>window.location.href='uplaodExamDetails.php';</script>";
    
               
    
    
               
    
    
}
   
    
    
}
?>