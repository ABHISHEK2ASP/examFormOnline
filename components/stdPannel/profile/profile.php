<?php
    session_start();
    include('../../../databaseconnection.php');
    include '../navbar/navbar.php';
    $authemail = $_SESSION['authemailStd'];
    if(empty($authemail)){
        header("Location: ../../userLogin/stdLogin.php");
        die();
    }







    $id = $_SESSION['id'];
    $query = "SELECT * FROM stddetails WHERE id = '$id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $name = $row['name'];
    $email = $row['emailid'];
    $usn_number = $row['usn_number'];
    $dept = $row['department'];
    $abc_id = $row['abc_id'];
    $unversity_enno = $row['unversity_enno'];

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
                    <label class="labeltxt">USN Number</label>
                    <h4 class="h4txt"><?php echo $usn_number ?></h4>
                </div>
                <div class="feilds">
                    <label class="labeltxt">Email Id</label>
                    <h4 class="h4txt"><?php echo $email ?></h4>
                </div>
                <div class="feilds">
                    <label class="labeltxt">Department</label>
                    <h4 class="h4txt"><?php echo $dept ?></h4>
                </div>
                <div class="feilds">
                    <label class="labeltxt">ABC Id</label>
                    <h4 class="h4txt"><?php echo $abc_id ?></h4>
                </div>
                <div class="feilds">
                    <label class="labeltxt">University Ennrolment Number</label>
                    <h4 class="h4txt"><?php echo $unversity_enno ?></h4>
                </div>
                <div class="feilds">
                </div>
            </div>
            <div class="box2">
                <div class="feilds">

                    <?php 
                    $result = $con->query("SELECT image FROM stddetails where id = '$id'"); 
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
        <h1 class="heading">Change Password / Update Image</h1>
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
            <div class="box1">
            <form action="uploadimg.php" method="POST" enctype="multipart/form-data">
            <div class="input-box">
                <span class="details">Upload User's Photo</span>
                <p class="alertmsg">Image should be less than 300kb</p>
                <div class="upload-btn-wrapper">
                        <button class="btnupload">Upload Image</button>
                        <input type="file" name="image" accept="image/*" required>
                        <div class="button">
                <input type="submit" class="btn" name="submit" value="SUBMIT" >
            </div>
                </div>
            </div>
            
        </form>
            </div>
        </div>
    </div>
