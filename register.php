<?php
//recuperation des variables du formulaire
  $username=$_POST['username'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $confirm_password=$_POST['confirm_password'];
  if($_POST['password']==$_POST['confirm_password']){
     $hash=password_hash($_POST['password'], PASSWORD_BCRYPT);
     try
  {
    //on se connecte a mysql
  $bdd = new PDO('mysql:host=localhost;dbname=institut_de_beaute;charset=utf8', 'root', '');
  }
  catch (\Exception $e)
  {
    die('Erreur:'.$e->getMessage ());
  }
  $utilisateurUnique = $bdd->prepare('SELECT* FROM users WHERE username= :username');
  $utilisateurUnique->execute(array(
      'username' => $username));
      $user = $utilisateurUnique->fetch();
      if ($user)
      {
         echo "cet utilisateur existe déja</br>";
      }
  $emailUnique = $bdd->prepare('SELECT* FROM users WHERE email= :email');
  $emailUnique->execute(array(
    'email'=>$email));
    $user = $emailUnique->fetch();
    if ($user)
    {
      echo "cet email est déjà pris </br>";
    }
    else {
     $saisirInformationUtilisateur=$bdd->prepare('INSERT INTO users (username, email, password, register_date) VALUES(:username,:email, :password, Now())');
     $saisirInformationUtilisateur->execute(array(
        'username'=>$username,
        'email'=>$email,
        'password'=>$hash
      ));
        echo "inscription réussi!";
  }
    }

 else {
 echo "ses deux mots de passes ne sont pas identiques";
 }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
 <head>
   <meta charset="utf-8">
   <link rel="stylesheet" href="accueil.css">
   <link href="" rel="stylesheet">
   <title>s'enregistrer</title>
 </head>
 <body>
<div class="header">
 <a href="index.php"></a>
</div>

<?php if(!empty($message)):?>
   <p> <?= $message; ?></p>
 <?php endif; ?>

 <h1>Enregistrement</h1>
 <span>ou <a href="login.php">connexion</a></span>
 <form  action="register.php" method="post">
     <input type="text" name="username"placeholder="pseudo" ></br>
     <input type="text" name="email"placeholder="entrer votre email" ></br>
     <input type="password" name="password"placeholder="mot de passe" ></br>
     <input type="password" name="confirm_password"placeholder="confirmez votre mot de passe" ></br>
     <input type="submit" value="s'enregistrer" >
 </form>
 </body>
</html>
