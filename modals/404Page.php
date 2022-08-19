<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>404 Page Not Found</title>
		<link rel="shortcut icon" href="../img/favIcon.png" type="image/x-icon">
		<link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Passion+One:900" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="../assets/css/style.css" />
	</head>
	<body>
	<div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<h1>:'(</h1>
			</div>
	<?php	
		if(isset($_GET['notLogedIn'])):
	?>
		<h2>You have to log in first.</h2>
		<p>Sorry.</p>
		<a href="../index.php?page=login">log in</a>
		<a href="../index.php?page=register">register</a>
	<?php
		endif;
	?>
	
	<?php	
		if(isset($_GET['notFound'])):
	?>
		<h2>404 - Page not found</h2>
		<p>You can't approache this page.</p>
		<a href="../index.php?page=mainPage">go back</a>
	<?php
		endif;
	?>
	</div>
  </div>
</body>
</html>
