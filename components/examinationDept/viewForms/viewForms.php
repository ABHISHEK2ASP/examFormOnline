<?php
    session_start();
    include('../../../databaseconnection.php');
    $authemail = $_SESSION['authemailexam'];
    if(empty($authemail)){
        header("Location: ../../userLogin/stdLogin.php");
        die();
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $id = $_GET["id"];
        $_SESSION['id'] = "$id";
        $sql = "SELECT * FROM stddetails WHERE id=$id";
        $result = $con->query($sql);
        $row = $result->fetch_assoc();
        $usn_number = $row['usn_number'];
        $_SESSION["usn_number"]=$usn_number;
        

        
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
<div class="container1">
    
    <h1 class="heading">Previous Examination Details</h1>
    <div class="row">
        <div class="box3">
                <label class="labeltxt">Marks In Semister's</label><br><br>
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
                                    $query = "SELECT * FROM `$table` where usn_number='$usn_number';";
                                    $result = $con->query($query);
                                    $sem = 'Semester'.' '.$x;
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
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>           
        </div>
    </div>
    
</div>


<div class="cantainerbox2">
<div class="regbox">
    <div class="container">
        <div class="title">Edit Examination Details</div>
        <div class="content">
        <form action='editformcon.php?id="$id"' method="POST">
            <div class="user-details">
            <div class="input-box">
                <span class="details">Semester</span>
                <input type="text" name="sem" placeholder="Enter Semester" required>
            </div>
            <div class="input-box">
                <span class="details">Name Of Examination</span>
                <select class="input" name="name_of_exam"  required>
                    <option>Select one</option>
                    <option value="End Semester Examination">End Semester Examination</option>
                    <option value="Re-Sit Examination">Re-Sit Examination</option>
                    <option value="Improvement Examination">Improvement Examination</option>              
                </select>            
            </div>
            <div class="input-box">
                <span class="details">Credit</span>
                <input type="text" name="credit" placeholder="Enter Credit" required>
            </div>
            <div class="input-box">
                <span class="details">Sgpa</span>
                <input type="text" name="sgpa" placeholder="Enter SGPA" required>
            </div>
            <div class="input-box">
                <span class="details">Status</span>
                <select class="input" name="status"  required>
                    <option>Select one</option>
                    <option value="Successfull">Successfull</option>
                    <option value="Unsuccessfull">Unsuccessfull</option>             
                </select>  
            </div>
            <div class="input-box">

            </div>
            <div class="button">
            <input type="submit" value="SUBMIT" >
            </div>
        </form>
        </div>
    </div>
</div>
</div>
