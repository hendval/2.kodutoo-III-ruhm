<?php

	// LOGIN.PHP
	$email_error = "";
	$password_repeat_error = "";
	$password_error = "";
	
	// muutujad andmebaasi väärtuste jaoks
	$email = "";
	$password = "";
	$password_repeat = "";
	
	
	// kontrollime, et keegi vajutas input nuppu
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		//echo "keegi vajutas nuppu";
		
		//vajutas register nuppu
		
		if(isset($_POST["register"])) {
			echo "vajutas register nuppu";
			
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
					$password_error = "VEATEADE: Parool peab olema vähemalt 8 tähemärki pikk!";
				}
				if($_POST["password"] != $_POST["password_repeat"]) {
					$password_repeat_error = "VEATEADE: Paroolid peavad kattuma!";
				}
			}
			
			if($email_error == "" && $password_error == "" && $password_repeat_error == ""){
				echo " salvestan ab'i ". $email;
				
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
	$page_title = "Registreerimine";
	$page_file_name = "register.php";
?>
<?php require_once("../header.php"); ?>
<html>
<head>
	<title>HV Register page</title>
	<meta charset="UTF-8">
</head>
<body>
		<h1>Registreeri</h1>
			<form action="register.php" method="post">
				Kasutajanimi:<br>
				<input name="email" type="email" placeholder="E-post" value="<?php echo $email; ?>"> <?php echo $email_error; ?><br>
				Parool:<br>
				<input name="password" type="password" placeholder="Parool"> <?php echo $password_error; ?><br>
				Parool uuesti:<br>
				<input name="password_repeat" type="password" placeholder="Parool uuesti"> <?php echo $password_error; ?><br><br>
				<input name="register" type="submit" value="Registreeri"><br><br>
				<?php echo $password_repeat_error; ?>
			</form>
<a href="login.php">Kasutaja olemas? Logi sisse siin!</a>
</body>
</html>
<?php require_once("../footer.php"); ?>