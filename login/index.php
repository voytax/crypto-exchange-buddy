<html>
	<head>
		<title>APP_NAME_PLACEHOLDER</title>
		<link rel="icon" href="graphics/icon/favicon.ico">
		<link rel="stylesheet" href="../styles/login.css">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet">
	</head>
	<body>
		<main>
			<h1>Log in</h1><br>
			<div class="form">
        <form name="login" method="post">
          <label for="email">Email: <input type="text" name="email"></label><br>
          <label for="password">Password: <input type="password" name="pwd"></label><br>
          <p>
            <div class="submit">
              <label for="goback"><input type="button" value="Go back" onclick="window.location='../'"></label>
              <label for="submit"><input type="submit" name="login" value="Log in"></label>
            </div>
          </p>
          <?php
            if (isset($_POST["login"])) {
              $email = escapeSQL($_POST["email"]);
              $password = escapeSQL($_POST["pwd"]);
              $query = "SELECT `email` FROM `users` WHERE `email`='$email'";
              $result = mysqli_query(getDbConnection(), $query);
              $row = mysqli_fetch_assoc($result);
              if (isset($row["email"])) {
                $query = "SELECT `password` FROM `users` WHERE `email`='$email'";
                $result = mysqli_query(getDbConnection(), $query);
                $row = mysqli_fetch_assoc($result);
                $hashedPwd = $row["password"];
                if (password_verify($password, $hashedPwd)) {
                  header("localhost/profile/");
                  exit;
                } else {
                  echo("Password doesn't match");
                }
              } else {
                echo("There is no user with that email");
              }
            }
          ?>
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
