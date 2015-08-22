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
  <title>Photo Gallery</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <div id="header">
    <h1>Photo Gallery</h1>
  </div>
  <div id="main">
    <h2>Menu</h2>
  </div>

  <div id="footer">Copyright &copy; <?php echo date("Y", time()); ?>, btbsandbox</div>
</body>
</html>
