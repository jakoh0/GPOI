<?php
	if(!isset($_POST["invio"])){
?>
<!DOCTYPE html>
<html>
	<body>
	<form method="post">
		<input type="text" name="nome"><br>
		<input type="password" name="pwd"><br>
		<input type="submit" name="invio">
	</form>
	<?php
	}else{
		if(!isset($_POST["nome"]) || trim($_POST["nome"])==""){
			die("Inserisci corretamente il nome");
		}
		if(!isset($_POST["pwd"]) || trim($_POST["pwd"])==""){
			die("Inserisci corretamente la passwrod");
		}
		$conn = mysqli_connect("localhost","root","","5AIT_Super");
		$user = $_POST["nome"];
		$pwd = $_POST["pwd"];
		$password = md5($pwd);
		$sql = "SELECT * FROM utenti WHERE nome = '$user' AND password = '$password'";
		$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
		if(mysqli_num_rows($result) >0){
			echo "Account già esistente";
		}
		else{
			$sql = "INSERT INTO utenti(nome,password) VALUES ( '$user','$password')";
			$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
			echo "registrato correttamente";
			mysqli_close($conn);
		}
	}
	
	?>
	</body>
</html>