<?php
    session_start();
    include('../../../databaseconnection.php');
    $authemail = $_SESSION['authemailadmin'];
    if(empty($authemail)){
        header("Location: ../../userLogin/stdLogin.php");
        die();
    }
    $str="";
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
            <p>Payment Details</p>
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
                        <th>Name of Student</th>
                        <th>USN Number</th>                   
                        <th>Payment Mode</th>     
                        <th>Payment Status</th>     
                        <th>Transcation ID</th>
                        <th> Refrence Number</th>     
                        <th>Date of Payment</th>     
                        <th>Amount</th>              
                    </tr>
                </thead>
                <tbody>
                <?php
                if(isset($_POST["submit"])){
                $str = $_POST["search"];}
                  if($str == null){
                    $query = "SELECT * FROM `payment_details` where payment_status='Paid' ORDER BY id DESC;";
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
                                    <td>$row->usn_number</td>
                                    <td>$row->payment_mode</td>
                                    <td>$row->payment_status</td>
                                    <td>$row->transaction_id</td>
                                    <td>$row->reference_no </td>
                                    <td>$row->date_of_payment</td>
                                    <td>$row->amount</td>
                                </tr>";    
                            ?>
                        <?php
                        $cnt=$cnt+1;
                        } 
                    }
                }
                else{
                    $query = "SELECT * FROM `payment_details` where usn_number like'%$str%' or name like '%$str%' and payment_status='Paid';";
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
                                    <td>$row->usn_number</td>
                                    <td>$row->payment_mode</td>
                                    <td>$row->payment_status</td>
                                    <td>$row->transaction_id</td>
                                    <td>$row->reference_no </td>
                                    <td>$row->date_of_payment</td>
                                    <td>$row->amount</td>
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
