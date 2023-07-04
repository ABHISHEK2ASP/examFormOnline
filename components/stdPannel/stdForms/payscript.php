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
 $acedemic = $_SESSION['acedemic'];
 $payment_mode = $_POST['mode'];
 $amount = $_POST['amount'];
 $_SESSION['amount'] = $amount;
 if($payment_mode == 'Online'){
    $apikey = "rzp_test_FUh0auo8F1OwQv";
    $paymentid = "ORD"."$usn_number".rand(10,1000)."END";
    ?>
    <div class="container">
            <div class="formbox">
                <h2>Payment Details</h2>
                <form action="success.php" method="POST">
                    <div class="form-group">
                        <span class="details">Name</span>
                        <input class = "inputtxt"type="text" name ="name" value=<?php echo $name?> readonly="readonly" required>
                    </div>
                    <div class="form-group">
                        <span class="details">Email</span>
                        <input class = "inputtxt"type="text" name ="email" value=<?php echo $email?> readonly="readonly" required>
                    </div>
                    <div class="form-group">
                        <span class="details">USN Number</span>
                        <input class = "inputtxt"type="text" name ="usn_number" value=<?php echo $usn_number?> readonly="readonly" required>
                    </div>
                    <div class="form-group">
                        <span class="details">Acedemic Session</span>
                        <input class = "inputtxt"type="text" name ="acedemic_year" value=<?php echo $acedemic?> readonly="readonly" required>
                    </div>
                    <div class="form-group">
                        <span class="details">Payment Mode</span>
                        <input class = "inputtxt"type="text" name ="mode" value=<?php echo $payment_mode?> readonly="readonly" required>
                    </div>
                    <script
                        src="https://checkout.razorpay.com/v1/checkout.js"
                        data-key="<?php echo $apikey ?>" 
                        data-amount="330000" 
                        data-currency="INR"
                        data-id="<?php echo $paymentid ?>"
                        data-buttontext="Pay <?php echo $amount?>"
                        data-name="S. B. Jain Institute of Technology, Management and Research"
                        data-description="Exam Fee"
                        data-image="../../../assets/sbjitpaymentlogo.png"
                        data-prefill.name="<?php echo $name?>"
                        data-prefill.email="<?php echo $email?>"
                        data-theme.color="#00B9F1"
                    >
                    </script>
                    <input type="hidden" custom="Hidden Element" name="hidden"/>
                    </form>
            </div>
    </div>
<?php
 }
 else{ ?>
 <div class="container">
            <div class="formbox">
                <h2>Payment Details</h2>
                <form action="cashsuccess.php" method="POST">
                    <div class="form-group">
                        <span class="details">Name</span>
                        <input class = "inputtxt"type="text" name ="name" value=<?php echo $name?> readonly="readonly" required>
                    </div>
                    <div class="form-group">
                        <span class="details">Email</span>
                        <input class = "inputtxt"type="text" name ="email" value=<?php echo $email?> readonly="readonly" required>
                    </div>
                    <div class="form-group">
                        <span class="details">USN Number</span>
                        <input class = "inputtxt"type="text" name ="usn_number" value=<?php echo $usn_number?> readonly="readonly" required>
                    </div>
                    <div class="form-group">
                        <span class="details">Acedemic Session</span>
                        <input class = "inputtxt"type="text" name ="acedemic_year" value=<?php echo $acedemic?> readonly="readonly" required>
                    </div>
                    <div class="form-group">
                        <span class="details">Payment Mode</span>
                        <input class = "inputtxt"type="text" name ="mode" value=<?php echo $payment_mode?> readonly="readonly" required>
                    </div>
                    <div class="form-group">
                        <span class="details">Referance Number</span>
                        <?php $_SESSION['reference_no'] =  "REF"."$usn_number".rand(10,1000)."SBJAIN"?>
                        <input class = "inputtxt"type="text" name ="reference_no" value=<?php echo $_SESSION['reference_no']?> readonly="readonly" required>
                    </div>
                    <div class="button1">
                        <input class="button" type="submit" value="SUBMIT">
                    </div>
                    </form>
            </div>
    </div>
<?php }
?>
