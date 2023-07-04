<?php
session_start();
$authemail = $_SESSION['authemailadmin'];
if(empty($authemail)){
    header("Location: ../../userLogin/stdLogin.php");
    die();
}
    include('../../../databaseconnection.php');
    $str="";
?>

<?php
include '../navbar/navbar.php';
?>
<style>
    <?php
    include 'admin.css';
    ?>
</style>
<div class="regbox">
    <div class="container">
        <div class="title">Register New User</div>
        <div class="content">
        <form action="registerAdmincon.php" method="POST" enctype="multipart/form-data">
            <div class="user-details">
            <div class="input-box">
                <span class="details">Full Name</span>
                <input type="text" name="name" placeholder="Enter Your Name" required>
            </div>
            <div class="input-box">
                <span class="details">Email</span>
                <input type="email" name="email" placeholder="Enter Your SBJIT Email Id" pattern=".+@sbjit.edu.in" required>
            </div>
            <div class="input-box">
                <span class="details">Mobile Number</span>
                <input type="text" name="mobile_no" placeholder="Enter Your Mobile Number" required>
            </div>
            <div class="input-box">
                <span class="details">Select Role</span>
                <select class="input" name="role" id="role" required>
                    <option>Select one</option>
                    <?php 
                    $query1 = "SELECT * FROM  admin_role";
                    $result1 = mysqli_query($con, $query1);
                    while($row1 = mysqli_fetch_array($result1)){?>
                        <option value="<?php echo $row1['role']?>"><?php echo $row1['role']?></option>
                    <?php }
                    ?>
                </select>
            </div>
            <div class="input-box">
                <span class="details">Select Department</span>
                <select class="input" name="dept" >
                    <option value= "">Select one</option>
                    <?php 
                    $query1 = "SELECT * FROM  departments";
                    $result1 = mysqli_query($con, $query1);
                    while($row1 = mysqli_fetch_array($result1)){?>
                        <option value="<?php echo $row1['dept']?>"><?php echo $row1['dept']?></option>
                    <?php }
                    ?>
                </select>
            </div>

            <div class="input-box">
                <span class="details">Date Of Joining</span>
                <input type="date" name="doj" required>
            </div>
            <div class="input-box">
                <span class="details">Upload User's Photo</span>
                <p class="alertmsg">Image should be less than 300kb</p>
                <div class="upload-btn-wrapper">
                        <button class="btn">Upload image</button>
                        <input type="file" name="image" accept="image/*" required>
                </div>
            </div>
            <div class="input-box">
            </div>
            <div class="input-box">
                <span class="details">Password</span>
                <input type="text" name="password" placeholder="Enter Your Password" required>
            </div>
            </div>
            <div class="gender-details">
            <input type="radio" name="gender" id="dot-1" value="Male">
            <input type="radio" name="gender" id="dot-2"  value="Female">
            <span class="gender-title">Gender</span>
            <div class="category">
                <label for="dot-1">
                <span class="dot one"></span>
                <span class="gender">Male</span>
            </label>
            <label for="dot-2">
                <span class="dot two"></span>
                <span class="gender">Female</span>
            </label>
            <label>
            </label>
            </div>
            </div>
            <div class="button">
            <input type="submit" name="submit" value="Register" >
            </div>
        </form>
        </div>
    </div>
    <div class="container">
        <div class="title">Add New Course</div>
        <div class="content">
        <form action="newcoursecon.php" method="POST">
            <div class="user-details">
            <div class="input-box">
                    <span class="details">Enter Department</span>
                    <select class="input" name="dept"  required>
                        <option>Select one</option>
                        <?php 
                        $query1 = "SELECT * FROM  departments";
                        $result1 = mysqli_query($con, $query1);
                        while($row1 = mysqli_fetch_array($result1)){?>
                            <option value="<?php echo $row1['dept']?>"><?php echo $row1['dept']?></option>
                        <?php }
                        ?>
                    </select>
                </div>
                <div class="input-box">
                    <span class="details">Enter Semester</span>
                    <input type="text" name="sem" placeholder="Enter Semester" required>
                </div>
                <div class="input-box">
                    <span class="details">Enter New Course Code</span>
                    <input type="text" name="course_code" placeholder="Enter Your Course Code" required>
                </div>
                <div class="input-box">
                    <span class="details">Enter New Course</span>
                    <input type="text" name="course_name" placeholder="Enter Your Course" required>
                </div>
                <div class="input-box">
                    <span class="details">Enter Theory/practical</span>
                    <select class="input" name="theory_or_practical" id="role" required>
                        <option>Select one</option>
                        <option value="Theory">Theory</option>
                        <option value="Practical">Practical</option>
                    </select>
                </div>
                <div class="input-box">
                    <span class="details">Enter Credit</span>
                    <input type="text" name="credit" placeholder="Enter Credit" required>
                </div>
            </div>
            <div class="button">
            <input type="submit" value="SUBMIT" >
            </div>
        </form>
        </div>
    </div>
</div>
<div class="regbox">
    <div class="container">
        <div class="title">Enter New Department</div>
        <div class="content">
        <form action="newdeptcon.php" method="POST">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Enter New Department</span>
                    <input type="text" name="dept" placeholder="Enter New Department" required>
                </div>
            </div>
            <div class="button">
            <input type="submit" value="SUBMIT" >
            </div>
        </form>
        </div>
    </div>
</div>

<div class="table">
        <div class="table_header">
            <p>Admin Details</p>
        </div>
        <div class="table_section">
            <table>
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Name</th>
                        <th>Email Id</th>                   
                        <th>Mobile Number</th>     
                        <th>Role</th>     
                        <th>Date of Joining</th>
                        <th>Gender</th>     
                        <th>Action</th>              
                    </tr>
                </thead>
                <tbody>
                <?php
                $query = "SELECT * FROM `adminlogin` ORDER BY id DESC;";
                $result = $con->query($query);
                if ($result->num_rows > 0) 
                {
                    $cnt=1;
                    while($row=$result->fetch_object()) {
                            ?>
                    <?php
                        echo  "       
                            <tr>
                                <td>$cnt</td>
                                <td>$row->name</td>
                                <td>$row->email</td>
                                <td>$row->mobile_no</td>
                                <td>$row->role</td>
                                <td>$row->doj</td>
                                <td>$row->gender</td>
                                <td><button><a href='delete/deleteUsercon.php?id=$row->id'><img class='btnimg' src='../../../assets/icons8-delete-48.png' alt='deletelogo'></a></button></td> 
                            </tr>";    
                        ?>
                    <?php
                    $cnt=$cnt+1;
                    } 
                }                
                ?>
                </tbody>
            </table>
        </div>
    </div><br><br>

<div class="table">
    <div class="table_header">
        <p>Manage Courses</p>
    </div>
    <div class="table_section">
        <table>
            <thead>
                <tr>
                    <th>Sr No</th>
                    <th>Department</th>    
                    <th>Semester</th>              
                    <th>Course Code</th>              
                    <th>Course Name</th>              
                    <th>Theory/Practical</th>              
                    <th>Credit</th>           
                    <th>Action</th>           
                </tr>
            </thead>
            <tbody>
            <?php
            $query = "SELECT * FROM `courses` ORDER BY id DESC;";
            $result = $con->query($query);
            if ($result->num_rows > 0) 
            {
                $cnt=1;
                while($row=$result->fetch_object()) {
                        ?>
                <?php
                    echo  "       
                        <tr>
                            <td>$cnt</td>
                            <td>$row->dept</td>
                            <td>$row->sem</td>
                            <td>$row->course_code</td>
                            <td>$row->course_name</td>
                            <td>$row->theory_or_practical</td>
                            <td>$row->credit</td>
                            <td><button><a href='delete/deletecoursecon.php?id=$row->id'><img class='btnimg' src='../../../assets/icons8-delete-48.png' alt='deletelogo'></a></button></td> 
                        </tr>";    
                    ?>
                <?php
                $cnt=$cnt+1;
                } 
            }                
            ?>
            </tbody>
        </table>
    </div>
</div>
</div><br><br>

<div class="table">
    <div class="table_header">
        <p>Manage Department</p>
    </div>
    <div class="table_section">
        <table>
            <thead>
                <tr>
                    <th>Sr No</th>
                    <th>Department</th>    
                    <th>Action</th>           
                </tr>
            </thead>
            <tbody>
            <?php
            $query = "SELECT * FROM `departments` ORDER BY id DESC;";
            $result = $con->query($query);
            if ($result->num_rows > 0) 
            {
                $cnt=1;
                while($row=$result->fetch_object()) {
                        ?>
                <?php
                    echo  "       
                        <tr>
                            <td>$cnt</td>
                            <td>$row->dept</td>
                            <td><button><a href='delete/deletedepartmentcon.php?id=$row->id'><img class='btnimg' src='../../../assets/icons8-delete-48.png' alt='deletelogo'></a></button></td> 
                        </tr>";    
                    ?>
                <?php
                $cnt=$cnt+1;
                } 
            }                
            ?>
            </tbody>
        </table>
    </div>
</div>