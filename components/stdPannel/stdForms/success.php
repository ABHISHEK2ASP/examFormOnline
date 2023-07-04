<style>
    <?php
     include 'payment.css';
    ?>
</style>
<?php
session_start();
include('../../../databaseconnection.php');
$authemail = $_SESSION['authemailStd'];
if(empty($authemail)){
    header("Location: ../../userLogin/stdLogin.php");
    die();
}



$usn_number = $_SESSION['usn_number'];
$name = $_POST['name'];
$email = $_SESSION['email'];
$acedemic = $_SESSION['acedemic'];
$payment_mode = $_POST['mode'];
$amount = $_SESSION['amount'];
$payment_status = "Paid";
$acedemic_year = $_SESSION['acedemic'];
$razorpay_payment_id = $_POST['razorpay_payment_id'];
$sem = $_SESSION['sem'];

$stmt = $con->prepare("insert into payment_details	(acedemic_year,sem,usn_number,name,email,payment_mode,payment_status,transaction_id,amount)
values(?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("sssssssss",$acedemic_year,$sem,$usn_number,$name,$email,$payment_mode,$payment_status,$razorpay_payment_id,$amount);
$stmt->execute();



$sql = "select * from payment_details where usn_number = '$usn_number' and acedemic_year = '$acedemic_year'";  
$result = mysqli_query($con, $sql);  
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
$name = $row['name'];
if($razorpay_payment_id == !null){
    $name_of_exam_add = $_SESSION['name_of_exam_add'];
    $type_of_student = $_SESSION['type_of_student'] ;
    $programme = $_SESSION['programme'];
    $dept = $_SESSION['dept'];
    $sem = $_SESSION['sem'];
    $abc_id = $_SESSION['abc_id'];
    $mother_name = $_SESSION['mother_name'];
    $mob_no = $_SESSION['mob_no'];
    $university_enno = $_SESSION['university_enno'];
    $address = $_SESSION['address'];
    $course1 = $_SESSION['course1'];
    $course2 = $_SESSION['course2'];
    $course3 = $_SESSION['course3'];
    $course4 = $_SESSION['course4'];
    $course5 = $_SESSION['course5'];
    $course6 = $_SESSION['course6'];
    $course7 = $_SESSION['course7'];
    $course8 = $_SESSION['course8'];
    $course9 = $_SESSION['course9'];
    $course10 = $_SESSION['course10'];
    $course11 = $_SESSION['course11'];
    $course12 = $_SESSION['course12'];

    $stmt = $con->prepare("insert into stdforms(acedemic_year,name_of_exam,type_of_student,programme,dept,sem,usn_number,name,abc_id,mother_name,address,mob_no,university_enno,course1,course2,course3,course4,course5,course6,course7,course8,course9,course10,course11,course12)
    values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssssssssssssssssssssss",$acedemic_year,$name_of_exam_add,$type_of_student,$programme,$dept,$sem,$usn_number,$name,$abc_id,$mother_name,$address,$mob_no,$university_enno,$course1,$course2,$course3,$course4,$course5,$course6,$course7,$course8,$course9,$course10,$course11,$course12);
    $stmt->execute();
    echo '<script>alert("Submited Successful")</script>';
    header('Refresh: 0.5; URL=stdForm.php');
    $stmt->close();
    $con->close();

}
?>