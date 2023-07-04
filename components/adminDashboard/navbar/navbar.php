<style>
<?php
include 'navbar.css';
$authemail = $_SESSION['authemailadmin'];
if(empty($authemail)){
	header("Location: ../../userLogin/stdLogin.php");
	die();
}

?>
</style>
<div>
    <header>
		<a href="#" class="logo"><img class=img1 src="../../../assets/sbjitlogof4.png" alt="s. b. jain"></a>

		<ul class="navbar">
			<li><a href="../dashboardPannel/dashboardPannel.php">Dashboard</a></li>
			<li><a href="../approvedForms/forms.php" >Approved Forms</a></li>
			<li><a href="../paymentDetails/paymentDetails.php">Payment Details</a></li>
			<li><a href="../cashPayment/cashPayment.php">Cash Payment</a></li>
			<li><a href="../regAdmin/registerAdmin.php">Admin</a></li>
			<li><a href="../addStddetails/addStddetails.php">Add Student Details</a></li>
			<li><a href="../../logout.php">Logout</a></li>
		</ul>
	</header>
</div>



