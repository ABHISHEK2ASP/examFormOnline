<style>
<?php
include 'navbar.css';
$authemail = $_SESSION['authemailexam'];
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
			<li><a href="../uploadExamDetails/uplaodExamDetails.php">Exam Details</a></li>
			<li><a href="../profile/profile.php">Profile</a></li>
			<li><a href="../../logout.php">Logout</a></li>
		</ul>
	</header>
</div>



