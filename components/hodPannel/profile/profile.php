<?php
    session_start();
    include('../../../databaseconnection.php');
    include '../navbar/navbar.php';
    $authemail = $_SESSION['authemailHod'];
    if(empty($authemail)){
        header("Location: ../../userLogin/stdLogin.php");
        die();
    }


    $id = $_SESSION['id'];
    $query = "SELECT * FROM adminlogin WHERE id = '$id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $name = $row['name'];
    $email = $row['email'];
    $_SESSION['email']=$email;
    $mobile_no = $row['mobile_no'];
    $dept = $row['dept'];
    $doj = $row['doj'];
    $image = $row['image'];
    $gender = $row['gender'];
?>
<style>
    <?php
    include 'profile.css';
    ?>
</style>
    <div class="container">
        <h1 class="heading">Profile</h1>
        <div class="row">
            <div class="box1">
                <div class="feilds">
                    <label class="labeltxt">Name</label>
                    <h4 class="h4txt"><?php echo $name ?></h4>
                </div>
                <div class="feilds">
                    <label class="labeltxt">Email</label>
                    <h4 class="h4txt"><?php echo $email ?></h4>
                </div>
                <div class="feilds">
                    <label class="labeltxt">Mobile Number</label>
                    <h4 class="h4txt"><?php echo $mobile_no ?></h4>
                </div>
                <div class="feilds">
                    <label class="labeltxt">Department</label>
                    <h4 class="h4txt"><?php echo $dept ?></h4>
                </div>
                <div class="feilds">
                    <label class="labeltxt">Date Of Joining</label>
                    <h4 class="h4txt"><?php echo $doj ?></h4>
                </div>
                <div class="feilds">
                    <label class="labeltxt">Gender</label>
                    <h4 class="h4txt"><?php echo $gender ?></h4>
                </div>
                <div class="feilds">
                </div>
            </div>
            <div class="box2">
            <div class="feilds">

                <?php 
                $result = $con->query("SELECT image FROM adminlogin where id = '$id'"); 
                if($result->num_rows > 0){ ?> 
                    <?php while($row = $result->fetch_assoc()){ ?> 
                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" /> 
                    <?php } ?> 
                    <?php }else{ ?> 
                        <p class="status error">Image(s) not found...</p> 
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h1 class="heading">Change Password</h1>
        <div class="row">
            <form action="chngpass.php" method="POST">
                <div class="box1">
                    <div class="feilds">
                        <label class="labeltxt">Current Password</label><br>
                        <input class="passform" type="password" name="currentpassword" placeholder="Enter Your Current Password">
                    </div>
                    <div class="feilds">
                    </div>
                    <div class="feilds">
                        <label class="labeltxt">New Password</label>
                        <input class="passform" type="password" name="newpassword" placeholder="Enter Your New Password">
                    </div>
                    <div class="feilds">
                    </div>
                    <div class="feilds">
                        <label class="labeltxt">Confirm Password</label>
                        <input class="passform" type="password" name="confirmpassword" placeholder="Confirm Password">
                    </div>
                    <div class="feilds">
                    </div>
                    <div class="feilds">
                        <button class="btn" type="submit" id="submit">SUBMIT</button>
                    </div>
                    <div class="feilds">
                    </div>
                </div>
            </form>
        </div>
    </div>
