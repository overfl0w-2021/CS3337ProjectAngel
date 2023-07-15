<?php
  if (!isset($_SESSION))
  {
    session_start();
  }
  $errors = array()
 ?>
 <?php if(!empty($_SESSION['errors'])) {
   $errors = $_SESSION['errors'];?>
   <?php  if (!empty($errors)) : ?>
     <div class="error">
     	<?php foreach ($errors as $error) : ?>
     	  <p><?php echo $error ?></p>
     	<?php endforeach ?>
     </div>
   <?php  endif ?>
 <?php } ?>
 <?php unset($_SESSION['errors']); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration System</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>

  <form method="post" action="register/register">
  	<?php include('errors.php'); ?>
    <label>No Special Characters In Username Or Password</label>
    <label></label>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login">Sign in</a>
  	</p>
  </form>
</body>
</html>
