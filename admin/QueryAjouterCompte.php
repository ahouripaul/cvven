<?php
	if(ISSET($_POST['AjouterCompte'])){
		$name = $_POST['name'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$query = $conn->query("SELECT * FROM `admin` WHERE `username` = '$username'") or die(mysqli_error());
		$valid = $conn->num_rows;
		if($valid > 0){
			echo "<center><label style = 'color:red;'>Nom d'utilisateur déja utilisé</center></label>";
		}else{
			$conn->query("INSERT INTO `admin` (name, username, password) VALUES('$name', '$username', '$password')") or die(mysqli_error());
			header("location:Comptes.php");
		}
	}
?>