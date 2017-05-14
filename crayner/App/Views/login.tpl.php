<?php 
if (isset($_COOKIE['alert'])) {
    $al = teadecrypt($_COOKIE['alert'], 'Nocturnal');
    rmck(array('alert'));
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Nocturnal Login</title>
	<meta charset="UTF-8">
	<meta property="og:title" content="Login">
	<meta property="og:image" content="<?php print base_url().'/assets/img/bgm/1.jpg'; ?>">
	<meta property="og:description" content="Nocturnal Login">
  	<meta name="description" content="Login">
  	<meta name="keywords" content="Nocturnal">
  	<meta name="author" content="Ammar Faizi">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<?php css('login'); ?>
	<?php js('login'); ?>
  	<?php if (isset($al)) {
    ?>
	<script type="text/javascript">
	alert('<?php print $al; ?>');
	</script>
	<?php 
} ?>
	<style type="text/css">
		body{
			background-image: <?php print 'url('.base_url().'/assets/img/bgm/1.jpg);';?>
			background-color: #cccccc;
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-position: top; 
		}
	</style>
</head>
<body>
<center>
<div class="cgu" onmouseenter="ticker();" id="dg">
<form action="<?php print base_url().'/login'; ?>" method="post">
	<div class="cg2">
		<div class="htr"><h3>Login</h3></div>
		<div class="lin">
			<label>Username :</label>
		</div>
		<div class="in">
			<input type="text" required name="username"<?php print $c_user;# ? $c_user : ''; ?> size="28">
		</div>
		<div class="lin">
			<label>Password :</label>
		</div>
		<div class="in">
			<input type="password" required name="password" size="28">
		</div>
		<div class="insb">
			<input type="hidden" name="lgtoken" value="<?php print $token; ?>">
			<input type="submit" name="login" value="Login" id="sbbt">
		</div>
	</div>
</form>
</div>
</center>
</body>
</html>