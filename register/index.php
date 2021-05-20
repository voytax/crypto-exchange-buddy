<html>
	<head>
		<title>APP_NAME_PLACEHOLDER</title>
		<link rel="icon" href="../graphics/icon/favicon.ico">
		<link rel="stylesheet" href="../styles/register.css">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet">
		<script>
		function checkPasswords() {
			password1 = document.getElementById('signup').pwd.value;
			password2 = document.getElementById('signup').repeat_pwd.value;
			errorDiv = document.getElementById('error_report');

			//Chceck if passwords are entered correctly
			if (password1 == '') {
				errorDiv.innerHTML = "Please enter password";
				return false;
			} else if (password2 == '') {
				errorDiv.innerHTML = "Please confirm password";
				return false;
			} else if (password1 != password2) {
				errorDiv.innerHTML = "Passwords doesn't match";
				return false;

			//Check if password is long enough
			} else if (password1 != '' && password1 == password2) {
				let regex = /[A-Z]/g;
			if (password1.length < 8) {
				errorDiv.innerHTML = "Password need to be at least 8 characters long";
				return false;
			} else if (password1.length > 64) {
				errorDiv.innerHTML = "Password can't be longer than 64 characters";
				return false;

			//Check if password is complex enough
			} else if (password1.match(regex)) {
				regex = /[a-z]/;
				if (password1.match(regex)) {
					regex = /[0-9]/;
					if (password1.match(regex)) {
						regex = /[!@#$%^&*]/;
						if (password1.match(regex)) {
							return true;
						}
					}
				}
			} else {
				errorDiv.innerHTML = "Password has to contain at least one small and capital character, digit and special character";
				return false;
			}
		}
}
		</script>
	</head>
	<body>
		<main>
			<h1>Sign up</h1>
				<p><b>Let's start!</b></p>
				<div class="form">
					<form id="signup" method="post" name="register" onsubmit="return checkPasswords()">
						<label for="name">Name: <input name="name" type="text"></label><br>
						<label for="surname">Surname: <input name="surname" type="text"></label><br>
						<label for="email">Email address: <input name='email' type="text"></label><br>
						<label for="pwd">Password: <input name='pwd' type="password"></label><br>
						<label for="repeat_pwd">Repeat password: <input name='repeat_pwd' type="password"></label><br>
						<label for="birthday">Date of birth: <input name="birthday" type="date"></label><br>
						<label for="sex">Gender:
							<select name="sex">
								<option value="Prefer not to say">Prefer not to say</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
								<option value="Other">Other</option>
							</select>
						</label>
						<p>
							<div class="submit">
								<label for="goback"><input type="button" value="Go back" onclick="window.location='../'"></label>
								<label for="submit"><input type="submit" name="register" value="Register"></label>
							</div>
						</p>
						<div id="error_report"></div>
						<?php
							if (isset($_POST['register'])) {
								$email = escapeSQL($_POST["email"]);
								$name = escapeSQL($_POST["name"]);
								$surname = escapeSQL($_POST["surname"]);
								$password = escapeSQL(password_hash($_POST["pwd"], PASSWORD_DEFAULT));
								$birthday = escapeSQL($_POST["birthday"]);
								$sex = escapeSQL($_POST["sex"]);
								$query = "SELECT `email` FROM `users` WHERE `email`='$email'";
								$result = mysqli_query(getDbConnection(), $query);
								$row = mysqli_fetch_assoc($result);
								if (!isset($row["email"])) {
									$query = "INSERT INTO `users`(`email`, `name`, `surname`, `password`, `date_of_birth`, `sex`, `verified`, `blocked`)
									VALUES ('$email','$name','$surname','$password','$birthday','$sex', '0', '0');";
									if (!mysqli_query(getDbConnection(), $query)) {
										echo("Sorry! Something went wrong :/<br>");
									} else {
										echo("Registered correctly!");
									}
								} else {
									echo("User with that email address already exist!");
								}
							}
						?>
				<div>
		</main>
	</body>
</html>
<?php
	function escapeSQL ($arg) {
		return mysqli_real_escape_string(getDbConnection(), $arg);
	}
	function getDbConnection() {
		if (!isset($con)){
			global $con;
			$con = mysqli_connect("localhost", "usercreator", "oTMAjk&-21|Y69n4", "webapp");
			return $con;
		} else {
			return $con;
		}
	}
?>
