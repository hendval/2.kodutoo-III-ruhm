<?php

	require_once("../config.php");
	$database = "if15_hendval";
	$mysqli = new mysqli($servername, $username, $password, $database);

	// LOGIN.PHP
	$email_error = "";
	$password_error = "";

	// muutujad andmebaasi väärtuste jaoks
	$email = "";
	$password = "";
	$password_repeat = "";	

	// kontrollime, et keegi vajutas input nuppu
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		//echo "keegi vajutas nuppu";
		
		//vajutas login nuppu
		if(isset($_POST["login"])){
			echo "vajutas login nuppu!";
			
			
			if(empty($_POST["email"]))  {
				$email_error = "VEATEADE: Email on kohustuslik!";
			} else {
				$email = test_input($_POST["email"]);
				
			}
			
			if(empty($_POST["password"])) {
				$password_error = "VEATEADE: Parool on kohustuslik!";
			} else {
				
				//kui oleme siia jõudnud siis parool ei ole tühi
				//kontrollin et olek vähemalt 8 sümbolit pikk
				if(strlen($_POST["password"]) < 8) {
					
					$password_error = "Parool peab olema vähemalt 8 tähemärki pikk!";
					
				}
			}
			
			if($email_error == "" && $password_error == ""){
				
				$hash = ("sha512", $password);
				$stmt = $mysqli->prepare("SELECT id, email FROM kasutajadb where email=? and password=?");
				$stmt->bind_param("ss", $email, $password);
				$stmt->bind_result($id_from_db, $email_from_db);
				$stmt->execute();
				
				if($stmt->fetch()){
					echo "email ja parool on õiged! Kasutaja id ".$id_from_db."ja email ".$email_from_db;
				}else{
					echo "parool või email on vale!"
				}
				
				$stmt->close();
				
				echo " kontrollin sisselogimist ".$email." ja parool";
				
			}
			
		}
		
		
		
	}
	
	function test_input($data) {
		// võtab ära tühikud, enterid, tabid
		$data = trim($data);
		// tagurpidi kaldkriipsud
		$data = stripslashes($data);
		// teeb htmli tekstiks
		$data = htmlspecialchars($data);
		return $data;
	}
?>
<?php
	$page_title = "Login leht";
	$page_file_name = "login.php";
?>
<?php require_once("../header.php"); ?>
<html>
<head>
	<title>HV Login page</title>
	<meta charset="UTF-8">
</head>
<body>
		<h1>Logi sisse</h1>
			<form action="login.php" method="post">
				Kasutajanimi:<br>
				<input name="email" type="email" placeholder="E-post" value="<?php echo $email; ?>"> <?php echo $email_error; ?><br>
				Parool:<br>
				<input name="password" type="password" placeholder="Parool"> <?php echo $password_error; ?><br><br>
				<input name="login" type="submit" value="Logi sisse"><br>
			</form>
<a href="register.php">Pole kasutajat? Registreeri siin!</a>
</body>
</html>
<?php require_once("../footer.php"); ?>