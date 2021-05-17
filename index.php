<!DOCTYPE html>
<html>
<meta charset="utf-8">
<title>Connexion</title>
<link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
require_once 'admin/connect.php';
$con = mysqli_connect("localhost","root","","cvv");
session_start();
// If form submitted, insert values into the database.
if (isset($_POST['nom_util'])){
        // removes backslashes
	$nom_util = stripslashes($_REQUEST['nom_util']);
        //escapes special characters in a string
	$nom_util = mysqli_real_escape_string($con,$nom_util);
	$mdp_util = stripslashes($_REQUEST['mdp_util']);
	$mdp_util = mysqli_real_escape_string($con,$mdp_util);
	//Checking is user existing in the database or not
        $query = "SELECT * FROM `util` WHERE nom_util='$nom_util'
and mdp_util='".md5($mdp_util)."'";
	$result = mysqli_query($con,$query) or die(mysql_error());
	$rows = mysqli_num_rows($result);
        if($rows==1){
	    $_SESSION['nom_util'] = $nom_util;
            // Redirect user to index.php
	    header("Location: accueil.php");
         }else{
	echo "<div class='form'>
<h3>nom_util/mdp_util est incorrect.</h3>
<br/>Clickez ici <a href='index.php'>Connexion</a></div>";
	}
    }else{
?>
<div class="form">
<h1>connexion</h1>
<form action="" method="post" name="index">
<input type="text" name="nom_util" placeholder="nom_util" required />
<input type="mdp_util" name="mdp_util" placeholder="mdp_util" required />
<br>
<input name="submit" type="submit" value="Se connecter" />
</form>
<p>Pas encore inscrit ? <a href='registration.php'>S'inscrire ici</a></p>
</div>
<?php } ?>
</body>
</html>
