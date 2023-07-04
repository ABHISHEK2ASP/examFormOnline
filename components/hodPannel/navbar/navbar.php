<style>
<?php
include 'navbar.css';
$authemail = $_SESSION['authemailHod'];
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
			<li><a href="../hodDashboard/hodDashboard.php">Forms To Be Approved</a></li>
			<li><a href="../forms/forms.php">View Forms</a></li>
			<li><a href="../Profile/profile.php">Profile</a></li>
			<li><a href="../../logout.php">Logout</a></li>
		</ul>
	</header>
</div>



