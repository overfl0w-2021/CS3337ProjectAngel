<?php
if (!isset($_SESSION))
{
  session_start();
}
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
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
	<h2>Home Page</h2>
</div>
<div class="content">
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php
          	echo $_SESSION['success'];
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>
    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
      <?php var_dump($_SESSION); ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
      <p> <a href="/upload" style="color: red;">Upload</a> </p>
    	<p> <a href="/logout?logout=1" style="color: red;">logout</a> </p>
    <?php endif ?>
    <?php if (!isset($_SESSION['username'])) : ?>
      	<p> <a href="/login" style="color: red;">Login</a> </p>
        <p> <a href="/register" style="color: red;">Register</a> </p>
    <?php endif ?>
</div>
</body>
</html>
