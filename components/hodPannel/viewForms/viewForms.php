<?php
    session_start();
    include('../../../databaseconnection.php');
    $authemail = $_SESSION['authemailHod'];
    if(empty($authemail)){
        header("Location: ../../userLogin/stdLogin.php");
        die();
    }



    $id = "";
    $acedemic_year = "";
    $name_of_exam = "";
    $type_of_student = "";
    $programme = "";
    $sem = "";
    $usn_number  = "";
    $name = "";
    $abc_id = "";
    $mother_name = "";
    $address = "";
    $mob_no = "";
    $university_enno = "";
    $image = "";
    $payment_mode = "";
    $transaction_id = "";
    $amount = "";
    $date_of_payment = "";
    $reference_no = "";
    $course2 = " ";
    $course3 = " ";
    $course4 = " ";
    $course5 = " ";
    $course6 = " ";
    $course7 = " ";
    $course8 = " ";
    $course9 = " ";
    $course10 = " ";
    $course11 = " ";
    $course12 = " ";
    $course13 = " ";
    $course14 = " ";
    $course15 = " ";
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $id = $_GET["id"];
        $sql = "SELECT * FROM stdforms WHERE id=$id";
        $result = $con->query($sql);
        $row = $result->fetch_assoc();
        
        $acedemic_year = $row['acedemic_year'];
        $name_of_exam = $row['name_of_exam'];
        $type_of_student = $row['type_of_student'];
        $programme = $row['programme'];
        $sem = $row['sem'];
        $usn_number = $row['usn_number'];
        $name = $row['name'];
        $abc_id = $row['abc_id'];
        $mother_name = $row['mother_name'];
        $address = $row['address'];
        $mob_no = $row['mob_no'];
        $university_enno = $row['university_enno'];

        $querry = "SELECT * FROM payment_details WHERE usn_number='$usn_number' and sem = '$sem'";
        $result = $con->query($querry);
        $row1 = $result->fetch_assoc();
        $payment_mode = $row1['payment_mode'];
        $payment_status = $row1['payment_status'];
        $transaction_id = $row1['transaction_id'];
        $amount = $row1['amount'];
        $date_of_payment = $row1['date_of_payment'];
        $reference_no = $row1['reference_no'];
        
    }
    else{
        header('location: ../dashboardPannel/dashboardPannel.php');
    }
?>
<?php
include '../navbar/navbar.php';
?>
<style>
    <?php
    include 'view.css';
    ?>
</style>
<div class="container">
    <h1 class="heading">Academic Details</h1>
    <div class="row">
        <div class="box1">
            <div class="feilds">
                <label class="labeltxt">Academic Year</label>
                <h4 class="h4txt"><?php echo $acedemic_year ?></h4>
            </div>
            <div class="feilds">
                <label class="labeltxt">Name Of Examination</label>
                <h4 class="h4txt"><?php echo $name_of_exam ?></h4>
            </div>
            <div class="feilds">
                <label class="labeltxt">Type Of Student</label>
                <h4 class="h4txt"><?php echo $type_of_student ?></h4>
            </div>
            <div class="feilds">
                <label class="labeltxt">Programme</label>
                <h4 class="h4txt"><?php echo $programme ?></h4>
            </div>
            <div class="feilds">
                <label class="labeltxt">Semester</label>
                <h4 class="h4txt"><?php echo $sem ?></h4>
            </div>
            <div class="feilds">
            </div>
        </div>
        <div class="box2">
        <?php 
                $result = $con->query("SELECT image FROM stddetails where usn_number = '$usn_number'"); 
                if($result->num_rows > 0){ ?> 
                    <?php while($row = $result->fetch_assoc()){ ?> 
                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" /> 
                    <?php } ?> 
                    <?php }else{ ?> 
                        <p class="status error">Image(s) not found...</p> 
                    <?php } ?>
            </div>
    </div>
    <h1 class="heading">Student Details</h1>
    <div class="row">
        <div class="box1">
            <div class="feilds">
                <label class="labeltxt">Student's Registration Number</label>
                <h4 class="h4txt"><?php echo $usn_number ?></h4>
            </div>
            <div class="feilds">
                <label class="labeltxt">Name</label>
                <h4 class="h4txt"><?php echo $name ?></h4>
            </div>
            <div class="feilds">
                <label class="labeltxt">Student's ABC Id</label>
                <h4 class="h4txt"><?php echo $abc_id ?></h4>
            </div>
            <div class="feilds">
                <label class="labeltxt">Mother's Name</label>
                <h4 class="h4txt"><?php echo $mother_name ?></h4>
            </div>
            <div class="feilds">
                <label class="labeltxt">Address</label>
                <h4 class="h4txt"><?php echo $address ?></h4>
            </div>
            <div class="feilds">
                <label class="labeltxt">Mobile Number</label>
                <h4 class="h4txt"><?php echo $mob_no ?></h4>
            </div>
            <div class="feilds">
                <label class="labeltxt">University Enrolment No</label>
                <h4 class="h4txt"><?php echo $university_enno ?></h4>
            </div>
            <div class="feilds">
            </div>
        </div>
    </div>
    <h1 class="heading">Courses Details</h1>
    <div class="row">
        <div class="box3">
                <label class="labeltxt">Courses in which the Candidate want to appear</label><br><br>
                <div class="table">
                    <div class="table_section">
                        <table>
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Course Code</th>
                                    <th>Course Name</th>
                                    <th>Theory/Practical</th>
                                    <th>Credit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "Select * from stdforms where usn_number='$usn_number' and id='$id'";
                                    $res = $con->query($sql);
                                    $rw = $res->fetch_object();
                                    for($x=1;$x<=12;$x++){
                                        $name = 'course'.$x;
                                        $course_code = $rw->$name;
                                        $query = "SELECT * FROM `courses` where course_code='$course_code';";
                                        $result = $con->query($query);
                                        
                                        if ($result->num_rows > 0){
                                            $cnt=$x;
                                        while($row=$result->fetch_object()) {
                                            ?>
                                            <?php
                                                echo  "       
                                                    <tr>
                                                        <td>$cnt</td>
                                                        <td>$row->course_code </td>
                                                        <td>$row->course_name </td>
                                                        <td>$row->theory_or_practical</td>
                                                        <td>$row->credit </td>
                                                    </tr>";    
                                                ?>
                                            <?php   
                                            $cnt = $cnt+1;                                          
                                        }
                                    }}
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>           
        </div>
    </div>
    <h1 class="heading">Previous Examination Details</h1>
    <div class="row">
        <div class="box3">
                <label class="labeltxt">Marks In Semister's</label><br><br>
                <div class="table">
                    <div class="table_section">
                        <table>
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Name Of Examination</th>
                                    <th>Credit</th>
                                    <th>SGPA</th>
                                    <th>Successful/Unsuccessful</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                for ($x = 1; $x <= 8; $x++) {
                                    $table = 'sem'.$x.'result';
                                    $query = "SELECT * FROM `$table` where usn_number='$usn_number';";
                                    $result = $con->query($query);
                                    $cnt = $x;
                                    if ($result->num_rows > 0){
                                    while($row=$result->fetch_object()) {
                                        ?>
                                        <?php
                                            echo  "       
                                                <tr>
                                                    <td>$cnt</td>
                                                    <td>$row->name_of_exam </td>
                                                    <td>$row->credit </td>
                                                    <td>$row->sgpa</td>
                                                    <td>$row->status</td>
                                                </tr>";    
                                            ?>
                                        <?php                               
                                    }
                                }}
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>           
        </div>
    </div>
    <h1 class="heading">Payment Details</h1>
    <div class="row">
        <div class="box1">
            <?php
              if($payment_mode == 'Online'){?>
              
                <div class="feilds">
                <label class="labeltxt">Payment Mode</label>
                <h4 class="h4txt"><?php echo $payment_mode ?></h4>
                </div>
                                <div class="feilds">
                    <label class="labeltxt">Payment Status</label>
                    <h4 class="h4txt"><?php echo $payment_status ?></h4>
                </div>
                <div class="feilds">
                    <label class="labeltxt">Transaction Id</label>
                    <h4 class="h4txt"><?php echo $transaction_id ?></h4>
                </div>
                <div class="feilds">
                    <label class="labeltxt">Amount</label>
                    <h4 class="h4txt"><?php echo $amount ?></h4>
                </div>
                <div class="feilds">
                    <label class="labeltxt">Date of Payment</label>
                    <h4 class="h4txt"><?php echo $date_of_payment ?></h4>
                </div>
                <div class="feilds">
                </div>
            <?php  } 
            elseif($payment_mode == 'Cash'){?>
                <div class="feilds">
                    <label class="labeltxt">Payment Mode</label>
                    <h4 class="h4txt"><?php echo $payment_mode ?></h4>
                </div>
                <div class="feilds">
                    <label class="labeltxt">Reference Number</label>
                    <h4 class="h4txt"><?php echo $reference_no ?></h4>
                </div>
                <div class="feilds">
                    <label class="labeltxt">Payment Status</label>
                    <h4 class="h4txt"><?php echo $payment_status ?></h4>
                </div>
                <div class="feilds">
                    <label class="labeltxt">Amount</label>
                    <h4 class="h4txt"><?php echo $amount ?></h4>
                </div>
                <div class="feilds">
                </div>
            <?php } ?>

            
        </div>
    </div>
</div>
