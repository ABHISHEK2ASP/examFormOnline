<?php
    session_start();
    include('../../../databaseconnection.php');
    $authemail = $_SESSION['authemailadmin'];
    if(empty($authemail)){
        header("Location: ../../userLogin/stdLogin.php");
        die();
    }
    $str="";
    $payment_mode="";
    $payment_status="";
?>
<?php
include '../navbar/navbar.php';
?>
<style>
    <?php
    include 'forms.css';
    ?>
</style>
<div class="table">
        <div class="table_header">
            <p>Approved Forms</p>
            <div class="search">
                <form method = "post">
                    <input class="input" type="text" name="search" placeholder="Search">
                    <input class="searchbtn" type="submit" name="submit">
                </form>    
            </div>
        </div>
        <div class="table_section">
            <table>
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Name of examination</th>
                        <th>Programme</th>                   
                        <th>Semister</th>     
                        <th>USN Number</th>     
                        <th>Name</th>     
                        <th>Payment Mode</th>     
                        <th>Payment Status</th>     
                        <th>Action</th>              
                    </tr>
                </thead>
                <tbody>
                <?php
                if(isset($_POST["submit"])){
                $str = $_POST["search"];}
                  if($str == null){
                    $query = "SELECT * FROM `stdforms` where formstatus='Approved' order by id desc;";
                    $result = $con->query($query);
                            if ($result->num_rows > 0) 
                            {
                                $cnt=1;
                                while($row=$result->fetch_object()) {
                                        ?>
                                <?php
                                    $sql = " SELECT * from payment_details where usn_number='$row->usn_number' and sem = '$row->sem';";
                                    $result1 = $con->query($sql);
                                    $row1 = $result1->fetch_object();
                                    echo  "       
                                        <tr>
                                            <td>$cnt</td>
                                            <td>$row->name_of_exam</td>
                                            <td>$row->programme</td>
                                            <td>$row->sem</td>
                                            <td>$row->usn_number</td>
                                            <td>$row->name</td>
                                            <td>$row1->payment_mode</td>
                                            <td>$row1->payment_status</td>
                                            <td><button><a href='../viewForms/viewForms.php?id=$row->id'><img class='btnimg' src='../../../assets/icons8-eye-50.png' alt='viewlogo'></a></button></td>
                                        </tr>";    
                                    ?>
                                <?php
                                $cnt=$cnt+1;
                                } 
                            }
                        }
                        else{
                            $query = "SELECT * FROM `stdforms` where formstatus='Approved' and  usn_number like'%$str%' order by id desc;";
                            $result = $con->query($query);
                            if ($result->num_rows > 0) 
                            {
                                $cnt=1;
                                while($row=$result->fetch_object()) {
                                        ?>
                                <?php
                                    $sql = " SELECT * from payment_details where usn_number='$row->usn_number' and sem = '$row->sem';";
                                    $result1 = $con->query($sql);
                                    $row1 = $result1->fetch_object();
                                    echo  "       
                                        <tr>
                                            <td>$cnt</td>
                                            <td>$row->name_of_exam</td>
                                            <td>$row->programme</td>
                                            <td>$row->sem</td>
                                            <td>$row->usn_number</td>
                                            <td>$row->name</td>
                                            <td>$row1->payment_mode</td>
                                            <td>$row1->payment_status</td>
                                            <td><button><a href='../viewForms/viewForms.php?id=$row->id'><img class='btnimg' src='../../../assets/icons8-eye-50.png' alt='viewlogo'></a></button></td>
                                        </tr>";    
                                    ?>
                                <?php
                                $cnt=$cnt+1;
                                } 
                            }
                        }
                ?>
                </tbody>
            </table>
        </div>
    </div>
