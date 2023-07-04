<?php
    session_start();
    include('../../../databaseconnection.php');
    $authemail = $_SESSION['authemailStd'];
    if(empty($authemail)){
        header("Location: ../../userLogin/stdLogin.php");
        die();
    }











    $usn_number = $_SESSION["usn_number"];
    $query = "SELECT * FROM stddetails WHERE usn_number = '$usn_number'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $name=$row['name'];
    $_SESSION['name'] = $name;
    $department=$row['department'];
    $_SESSION['department'] = $department;
    $acedemic= date("Y");
    $_SESSION['acedemic'] = $acedemic;
    $university_enno=$row['unversity_enno'];
    $_SESSION['university_enno'] = $university_enno;
    $email = $row['emailid'];
    $_SESSION['email'] = $email;
    $abc_id=$row['abc_id'];
    $_SESSION['abc_id'] = $abc_id;
    $query2 = "SELECT * FROM stdforms where usn_number='$usn_number'";
    $result2 = mysqli_query($con, $query2);
    $row2 = mysqli_fetch_array($result2);
    $year = substr($acedemic,0,4);
    
?>
<?php
include '../navbar/navbar.php';
?>
<style>
    <?php include 'form.css';
    ?>
</style>

<div class="regbox">
    <div class="container">
        <div class="title">Examination Form</div>
        <div class="content">
            <form action="checkout.php" method="POST">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Acedemic Year</span>
                        <span class="details"><?php echo $acedemic."-".$acedemic+1; ?></span>
                    </div>
                </div>
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Name of Examination</span>
                        <select class="input" name="name_of_exam" id="exam" required>
                             <option value="">Select one</a>
                            <option value="End Semester Examination">End Semester Examination</option>
                            <option value="Re-Sit Examination">Re-Sit Examination</option>
                            <option value="Improvement Examination">Improvement Examination</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Summer/Winter</span>
                        <select class="input" name="season" id="season" required>
                             <option value="">Select one</a>
                            <option value="Summer-<?php echo $year?>">Summer-<?php echo $year?></option>
                            <option value="Winter-<?php echo $year?>">Winter-<?php echo $year?></option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Type of Student</span>
                        <select class="input" name="type_of_student" id="type_of_student" required>
                             <option value="">Select one</a>
                            <option value="Regular Student">Regular Student</option>
                            <option value="Ex-Student">Ex-Student</option>
                        </select>
                    </div>
                    <div class="input-box">
                    </div>
                </div>
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Programme</span>
                        <select class="input" name="programme" id="programme" required>
                             <option value="">Select one</a>
                            <option value="UG: B.Tech">UG: B.Tech</option>
                            <option value="PG: M.Tech/MBA">PG: M.Tech/MBA</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Department</span>
                        <input type="text" name="dept" value="<?php echo $department ?>" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Semester</span>
                        <select class="input" name="sem" id="semester" required>
                             <option value="">Select one</a>
                            <option value="Sem 1">1</option>
                            <option value="Sem 2">2</option>
                            <option value="Sem 3">3</option>
                            <option value="Sem 4">4</option>
                            <option value="Sem 5">5</option>
                            <option value="Sem 6">6</option>
                            <option value="Sem 7">7</option>
                            <option value="Sem 8">8</option>
                        </select>                    
                    </div>
                    <div class="input-box">
                    </div>
                </div>
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Registration Number</span>
                        <input class = "inputtxt"type="text" name ="usn_number" value=<?php echo $usn_number?> readonly="readonly"  required>
                    </div>
                    <div class="input-box">
                        <span class="details">Student's Full Name </span>
                        <input class = "inputtxt"type="text" name ="name" value=<?php echo $name?> readonly="readonly" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Student's ABC Id</span>
                        <input class = "inputtxt"type="text" name ="abc_id" value=<?php echo $abc_id?> readonly="readonly" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Mother Name</span>
                        <input class = "inputtxt"type="text" name ="mother_name" placeholder="Enter Your Mother Name" required>
                    </div>
                </div>
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Corresponding Address</span>
                        <input class = "inputtxt"type="text" name ="address" placeholder="Enter Your Address" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Mobile Number</span>
                        <input class = "inputtxt"type="text" name ="mob_no" placeholder="Enter Your Mobile Number" required>
                    </div>
                    <div class="input-box">
                        <span class="details">University Enrolement No</span>
                        <input class = "inputtxt"type="text" name ="university_enno" value=<?php echo $university_enno?> readonly="readonly" required>
                    </div>
                    <div class="input-box">
                    </div>
                </div>

                <div class="title">Previous Semester Marks</div>
                <div class="row">
            <div class="box3"><br>
                <div class="table">
                    <div class="table_section">
                        <table>
                            <thead>
                                <tr>
                                    <th>Semester</th>
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
                                    $sem = 'Semester'.' '.$x;
                                    $query = "SELECT * FROM `$table` where usn_number='$usn_number';";
                                    $result = $con->query($query);
                                    $cnt = $x;
                                    if ($result->num_rows > 0){
                                    while($row=$result->fetch_object()) {
                                        ?>
                                        <?php
                                            echo  "       
                                                <tr>
                                                    <td>$sem</td>
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





                <div class="title">Courses</div>
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Course 1</span>
                        <select class="input-choice" name="course1" id="course1" required >
                             <option value="">Select one</a>
                            <?php 
                            $query1 = "SELECT * FROM courses WHERE dept = '$department'";
                            $result1 = mysqli_query($con, $query1);
                            while($row1 = mysqli_fetch_array($result1)){?>
                                <option value="<?php echo $row1['course_code']?>"><?php echo $row1['course_code'].'    '.$row1['course_name']?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Course 2</span>
                        <select class="input-choice" name="course2" id="course2" >
                             <option value="">Select one</a>
                            <?php 
                            $query1 = "SELECT * FROM courses WHERE dept = '$department'";
                            $result1 = mysqli_query($con, $query1);
                            while($row1 = mysqli_fetch_array($result1)){?>
                                <option value="<?php echo $row1['course_code']?>"><?php echo $row1['course_code'].'    '.$row1['course_name']?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="input-box">
                    </div>
                </div>
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Course 3</span>
                        <select class="input-choice" name="course3" id="course3" >
                             <option value="">Select one</a>
                            <?php 
                            $query1 = "SELECT * FROM courses WHERE dept = '$department'";
                            $result1 = mysqli_query($con, $query1);
                            while($row1 = mysqli_fetch_array($result1)){?>
                                <option value="<?php echo $row1['course_code']?>"><?php echo $row1['course_code'].'    '.$row1['course_name']?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Course 4</span>
                        <select class="input-choice" name="course4" id="course4" >
                             <option value="">Select one</a>
                            <?php 
                            $query1 = "SELECT * FROM courses WHERE dept = '$department'";
                            $result1 = mysqli_query($con, $query1);
                            while($row1 = mysqli_fetch_array($result1)){?>
                                <option value="<?php echo $row1['course_code']?>"><?php echo $row1['course_code'].'    '.$row1['course_name']?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="input-box">
                    </div>
                </div>
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Course 5</span>
                        <select class="input-choice" name="course5" id="course5" >
                             <option value="">Select one</a>
                            <?php 
                            $query1 = "SELECT * FROM courses WHERE dept = '$department'";
                            $result1 = mysqli_query($con, $query1);
                            while($row1 = mysqli_fetch_array($result1)){?>
                                <option value="<?php echo $row1['course_code']?>"><?php echo $row1['course_code'].'    '.$row1['course_name']?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Course 6</span>
                        <select class="input-choice" name="course6" id="course6" >
                             <option value="">Select one</a>
                            <?php 
                            $query1 = "SELECT * FROM courses WHERE dept = '$department'";
                            $result1 = mysqli_query($con, $query1);
                            while($row1 = mysqli_fetch_array($result1)){?>
                                <option value="<?php echo $row1['course_code']?>"><?php echo $row1['course_code'].'    '.$row1['course_name']?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="input-box">
                    </div>
                </div>
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Course 7</span>
                        <select class="input-choice" name="course7" id="course7" >
                             <option value="">Select one</a>
                            <?php 
                            $query1 = "SELECT * FROM courses WHERE dept = '$department'";
                            $result1 = mysqli_query($con, $query1);
                            while($row1 = mysqli_fetch_array($result1)){?>
                                <option value="<?php echo $row1['course_code']?>"><?php echo $row1['course_code'].'    '.$row1['course_name']?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Course 8</span>
                        <select class="input-choice" name="course8" id="course8" >
                             <option value="">Select one</a>
                            <?php 
                            $query1 = "SELECT * FROM courses WHERE dept = '$department'";
                            $result1 = mysqli_query($con, $query1);
                            while($row1 = mysqli_fetch_array($result1)){?>
                                <option value="<?php echo $row1['course_code']?>"><?php echo $row1['course_code'].'    '.$row1['course_name']?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="input-box">
                    </div>
                </div>
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Course 9</span>
                        <select class="input-choice" name="course9" id="course9" >
                             <option value="">Select one</a>
                            <?php 
                            $query1 = "SELECT * FROM courses WHERE dept = '$department'";
                            $result1 = mysqli_query($con, $query1);
                            while($row1 = mysqli_fetch_array($result1)){?>
                                <option value="<?php echo $row1['course_code']?>"><?php echo $row1['course_code'].'    '.$row1['course_name']?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Course 10</span>
                        <select class="input-choice" name="course10" id="course10" >
                             <option value="">Select one</a>
                            <?php 
                            $query1 = "SELECT * FROM courses WHERE dept = '$department'";
                            $result1 = mysqli_query($con, $query1);
                            while($row1 = mysqli_fetch_array($result1)){?>
                                <option value="<?php echo $row1['course_code']?>"><?php echo $row1['course_code'].'    '.$row1['course_name']?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="input-box">
                    </div>
                </div>
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Course 11</span>
                        <select class="input-choice" name="course11" id="course11" >
                             <option value="">Select one</a>
                            <?php 
                            $query1 = "SELECT * FROM courses WHERE dept = '$department'";
                            $result1 = mysqli_query($con, $query1);
                            while($row1 = mysqli_fetch_array($result1)){?>
                                <option value="<?php echo $row1['course_code']?>"><?php echo $row1['course_code'].'    '.$row1['course_name']?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Course 12</span>
                        <select class="input-choice" name="course12" id="course12" >
                             <option value="">Select one</a>
                            <?php 
                            $query1 = "SELECT * FROM courses WHERE dept = '$department'";
                            $result1 = mysqli_query($con, $query1);
                            while($row1 = mysqli_fetch_array($result1)){?>
                                <option value="<?php echo $row1['course_code']?>"><?php echo $row1['course_code'].'    '.$row1['course_name']?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="input-box">
                    </div>
                </div>
                <div class="button">
                    <input type="submit" value="Next">
                </div>
            </form>
        </div>
    </div>
</div>


