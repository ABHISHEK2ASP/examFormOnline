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
    include 'payment.css';
    ?>
</style>
<div class="table">
        <div class="table_header">
            <p>Cash Details</p>
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
                        <th>Semister</th>     
                        <th>USN Number</th>     
                        <th>Name</th>     
                        <th>Payment Mode</th>     
                        <th>Payment Status</th>     
                        <th>Reference Number</th>     
                        <th>Action</th>              
                    </tr>
                </thead>
                <tbody>
                <?php
                if(isset($_POST["submit"])){
                $str = $_POST["search"];}
                  if($str == null){
                    $query = "SELECT * FROM `payment_details` where payment_mode='Cash' and payment_status='Pending' order by id desc;";
                    $result = $con->query($query);
                            if ($result->num_rows > 0) 
                            {
                                $cnt=1;
                                while($row=$result->fetch_object()) {
                                        ?>
                                <?php
                                    $sql = " SELECT * from stdforms where usn_number='$row->usn_number' and sem = '$row->sem';";
                                    $result1 = $con->query($sql);
                                    $row1 = $result1->fetch_object();
                                    echo  "       
                                        <tr>
                                            <td>$cnt</td>
                                            <td>$row1->name_of_exam</td>
                                            <td>$row1->sem</td>
                                            <td>$row1->usn_number</td>
                                            <td>$row1->name</td>
                                            <td>$row->payment_mode</td>
                                            <td>$row->payment_status</td>
                                            <td>$row->reference_no</td>
                                            <td><button><a href='../approveCash/forms.php?id=$row1->id'><img class='btnimg' src='../../../assets/icons8-eye-50.png' alt='viewlogo'></a></button></td>
                                        </tr>";    
                                    ?>
                                <?php
                                $cnt=$cnt+1;
                                } 
                            }
                        }
                        else{
                            $query = "SELECT * FROM `payment_details` where payment_mode='Cash' and payment_status='Pending' and  usn_number like'%$str%' or reference_no like '%$str%';";
                            $result = $con->query($query);
                            if ($result->num_rows > 0) 
                            {
                                $cnt=1;
                                while($row=$result->fetch_object()) {
                                        ?>
                                <?php
                                    $sql = " SELECT * from stdforms where usn_number='$row->usn_number' and sem = '$row->sem';";
                                    $result1 = $con->query($sql);
                                    $row1 = $result1->fetch_object();
                                    echo  "       
                                        <tr>
                                            <td>$cnt</td>
                                            <td>$row1->name_of_exam</td>
                                            <td>$row1->sem</td>
                                            <td>$row1->usn_number</td>
                                            <td>$row1->name</td>
                                            <td>$row->payment_mode</td>
                                            <td>$row->payment_status</td>
                                            <td>$row->reference_no</td>
                                            <td><button><a href='../approveCash/forms.php?id=$row1->id'><img class='btnimg' src='../../../assets/icons8-eye-50.png' alt='viewlogo'></a></button></td>
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
