<style>
<?php
include 'navbar.css';
$authemail = $_SESSION['authemailStd'];
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
			<li><a href="../stdForms/stdForm.php">Exam Form</a></li>
			<li><a href="../previousforms/preforms.php">Previous Exam Form</a></li>
			<li><a href="../profile/profile.php">Profile</a></li>
			<li><a href="../../logout.php">Logout</a></li>
		</ul>
	</header>
</div>



