<style>
<?php
include 'login.css';
?>
</style>
<div class="login-box">
  <h2>Login</h2>
  <form action="stdLogincon.php" method="POST">
    <div class="user-box">
      <input type="text" name="usn_number" required="">
      <label>Username</label>
    </div>
    <div class="user-box">
      <input type="password" name="password" required="">
      <label>Password</label>
    </div>
    <button class="a" type="submit">
      SUBMIT
    </button><br><br><br>
    <a href="../adminLogin/adminLogin.php">Login With Admin</a>
  </form>
</div>

