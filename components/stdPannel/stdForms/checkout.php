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
 $amount = '3300';
 $acedemic = $_SESSION['acedemic'];
 $name_of_exam = $_POST['name_of_exam'];
 $season = $_POST['season'];
 $sem = $_POST['sem'];
 $_SESSION['sem'] = "$sem";
 $name_of_exam_add = $name_of_exam.' '.$season;
 $_SESSION['name_of_exam_add'] = $name_of_exam_add;
 $_SESSION['type_of_student'] = $_POST['type_of_student'];
 $_SESSION['programme'] = $_POST['programme'];
 $_SESSION['dept'] = $_POST['dept'];
 $_SESSION['sem'] = $_POST['sem'];
 $_SESSION['abc_id'] = $_POST['abc_id'];
 $_SESSION['mother_name'] = $_POST['mother_name'];
 $_SESSION['mob_no'] = $_POST['mob_no'];
 $_SESSION['university_enno'] = $_POST['university_enno'];
 $_SESSION['address'] = $_POST['address'];
 $_SESSION['course1'] = $_POST['course1'];
 $_SESSION['course2'] = $_POST['course2'];
 $_SESSION['course3'] = $_POST['course3'];
 $_SESSION['course4'] = $_POST['course4'];
 $_SESSION['course5'] = $_POST['course5'];
 $_SESSION['course6'] = $_POST['course6'];
 $_SESSION['course7'] = $_POST['course7'];
 $_SESSION['course8'] = $_POST['course8'];
 $_SESSION['course9'] = $_POST['course9'];
 $_SESSION['course10'] = $_POST['course10'];
 $_SESSION['course11'] = $_POST['course11'];
 $_SESSION['course12'] = $_POST['course12'];




 $query = "SELECT * FROM stdforms WHERE usn_number = '$usn_number' and sem= '$sem'";
 $result = mysqli_query($con, $query);
 $row = mysqli_fetch_array($result);
 
 if (mysqli_num_rows($result) > 0) {
    echo '<script>alert("Exam Form Is Already Registerd")</script>';
    header('Refresh: 0.125; URL=stdForm.php');
    }
    else{ ?>
        <div class="container">
            <div class="formbox">
                <h2>Choose Payment Method</h2>
                <form action="payscript.php" method="post" id="payment-form">
                    <div class="form-group">
                        <span class="details">Name</span>
                        <input class = "inputtxt" type="text" name ="name" value=<?php echo $name?> readonly="readonly" required>
                    </div>
                    <div class="form-group">
                        <span class="details">Email</span>
                        <input class = "inputtxt" type="text" name ="email" value=<?php echo $email?> readonly="readonly" required>
                    </div>
                    <div class="form-group">
                        <span class="details">USN Number</span>
                        <input class = "inputtxt" type="text" name ="usn_number" value=<?php echo $usn_number?> readonly="readonly" required>
                    </div>
                    <div class="form-group">
                        <span class="details">Amount</span>
                        <input class = "inputtxt" type="text" name ="amount" value=<?php echo $amount?> readonly="readonly" required>
                    </div>
                    <div class="form-group">
                        <span class="details">Payment Mode</span>
                        <div class="radio-container">
                            <div class="radio-wrapper">
                                <label class="radio-button">
                                <input class = "inputtxt" type="radio" name="mode" value="Online" id="option1" required>
                                <span class="radio-checkmark"></span>
                                <span class="radio-label">Online</span>
                                </label>
                            </div>

                            <div class="radio-wrapper">
                                <label class="radio-button">
                                <input class = "inputtxt" type="radio" name="mode" value="Cash" id="option2" required>
                                <span class="radio-checkmark"></span>
                                <span class="radio-label">Cash</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="button1">
                        <input  class="button" type="submit" value="Proceed For Payment">
                    </div>
                </form>    
            </div>
        </div>
    <?php
    }
?>
