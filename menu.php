<h2>Menüü</h2>
<ul>
	<?php if($page_file_name == "home.php"){
			echo '<li>Home</li>';
		} else {
			echo '<li><a href="home.php">Home</a></li>';
		} ?>
	<?php if($page_file_name == "login.php"){
			echo '<li>Login</li>';
		} else {
			echo '<li><a href="login.php">Login</a></li>';
		} ?>
	<?php if($page_file_name == "register.php"){
			echo '<li>Register</li>';
		} else {
			echo '<li><a href="register.php">Register</a></li>';
		} ?>
</ul>