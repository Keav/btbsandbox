<?php
  require_once("../includes/functions.php");
  require_once("../includes/database.php");
  require_once("../includes/user.php");

  $user = User::find_by_id(1);

  echo $user->id . "<br>";
  echo $user->full_name() . "<br>";
  echo $user->password . "<br>";

  echo "<hr>";

  // $user_set = User::find_all();
  // while ($user = $database->fetch_array($user_set)) {
  //   echo "User: " . $user['username'] . "<br>";
  //   echo "Name: " . $user['first_name'] . " " . $user['last_name'] . "<br><hr>";
  // }

  $users = User::find_all();
  foreach($users as $user) {
    echo "User: " . $user->username . "<br>";
    echo "Name: " . $user->full_name() . "<br>";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  <h1>Document</h1>
</body>
</html>
