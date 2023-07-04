<style>
<?php
 session_start();
include 'login.css';
?>
</style>
<div class="login-box">
  <h2>Login</h2>
  <form action="adminLogincon.php" method="POST">
    <div class="user-box">
      <input type="text" name="email" pattern=".+@sbjit.edu.in" required="">
      <label>Email</label>
    </div>
    <div class="user-box">
      <input type="password" name="password" required="">
      <label>Password</label>
    </div>
    <button class="a" type="submit">
      SUBMIT
    </button>
  </form>
</div>
