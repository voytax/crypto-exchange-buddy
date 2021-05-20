<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link rel="icon" href="../graphics/icon/favicon.ico">
    <link rel="stylesheet" href="../styles/dashboard.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet">
  </head>
  <body>
    <main>
    <?php
      session_start();
      $email = $_SESSION["login"];
      $query = "SELECT `name` FROM `users` WHERE `email`='$email'";
      $result = mysqli_query(getDbConnection(), $query);
      $row = mysqli_fetch_assoc($result);
      $name = $row["name"];
      echo("<h1>Welcome, <i>$name</i></h1>");
     ?>
   </main>
  </body>
</html>
<?php
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
