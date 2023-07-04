<?php
    session_start();
    include('../../../databaseconnection.php');
    $authemail = $_SESSION['authemailadmin'];
    if(empty($authemail)){
        header("Location: ../../userLogin/stdLogin.php");
        die();
    }
?>
<?php
include '../navbar/navbar.php';
?>
<style>
    <?php
    include 'dashboard.css';
    ?>
</style>
<div class="container1">
    <div class="cards">
        <div class="head1">
            <h3 class="text">Approved Forms</h3>
            <img class="img" src="../../../assets/sign-up.png" alt="formslogo">
        </div>
        <div class="head2">
            <p class="text">
                <?php
                $sql = "SELECT id FROM stdforms where formstatus='Approved'";           
                if ($result=mysqli_query($con,$sql))
                {
                $rowcount=mysqli_num_rows($result);
                printf($rowcount);
                mysqli_free_result($result);
                }
                ?>
            </p>
        </div>
    </div>
    <div class="cards">
        <div class="head1">
            <h3 class="text">Payment Recived</h3>
            <img class="img"  src="../../../assets/credit-card.png" alt="cardlogo">
        </div>
        <div class="head2">
            <p class="text">
                    <?php
                    $sql = "SELECT id FROM payment_details where payment_status='Paid'";           
                    if ($result=mysqli_query($con,$sql))
                    {
                    $rowcount=mysqli_num_rows($result);
                    printf($rowcount);
                    mysqli_free_result($result);
                    }
                    ?>
            </p>
        </div>
    </div>
    <div class="cards">
        <div class="head1">
            <h3 class="text">Cash Payment</h3>
            <img class="img" src="../../../assets/payment-method.png" alt="cashlogo">
        </div>
        <div class="head2">
            <p class="text">
                <?php
                $sql = "SELECT id FROM payment_details where	payment_mode='cash'";           
                if ($result=mysqli_query($con,$sql))
                {
                $rowcount=mysqli_num_rows($result);
                printf($rowcount);
                mysqli_free_result($result);
                }
                ?>
            </p>
        </div>
    </div>
</div>
<div class="table">
        <div class="table_header">
            <p>Approved Forms [Top 10 Forms]</p>
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
                        <th>Action</th>              
                    </tr>
                </thead>
                <tbody>
                <?php
                $query = "SELECT * FROM `stdforms` where formstatus='Approved' ORDER BY id DESC Limit 10;";
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
                                <td>$row->name_of_exam</td>
                                <td>$row->programme</td>
                                <td>$row->sem</td>
                                <td>$row->usn_number</td>
                                <td>$row->name</td>
                                <td><button><a href='../viewForms/viewForms.php?id=$row->id'><img class='btnimg' src='../../../assets/icons8-eye-50.png' alt='viewlogo'></a></button></td>
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
