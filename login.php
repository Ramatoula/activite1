<?php
//recuperation des variables
$email=$_POST['email'];
$password=$_POST['password'];
try
  {
    //on se connecte a mysql
  $bdd = new PDO('mysql:host=localhost;dbname=institut_de_beaute;charset=utf8', 'root', '');
  }
  catch (\Exception $e)
  {
    die('Erreur:'.$e->getMessage ());
  }
 ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login </title>
		<link rel="stylesheet" href="accueil.css">
		<link href="" rel="stylesheet">

	</head>

	<body>

		<div class="header">
			<a href="index.php"></a>
		</div>

		<?php if(!empty($message)):?>
			<p> <?= $message; ?></p>
		<?php endif; ?>

		<h1>Login</h1>
		<span>or <a href="register.php">Register here</a></span>

		<form action="login.php" method="POST">
			<input type="text" placeholder="entrer votre email" name="email"><br/>
			<input type="password" placeholder="votre mot de passe" name="password"><br/>
			<input type="submit" value="se connecter">
		</form>

	</body>

</html>
