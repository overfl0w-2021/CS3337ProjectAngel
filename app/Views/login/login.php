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
  	<h2>Login</h2>
  </div>

  <form method="post" action="/login/login">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register">Sign up</a>
  	</p>
  </form>
</body>
</html>
