<?php
  require_once("../../includes/initialise.php");

  // if(isset($session->user_id)) {
  //   log_action('Logout', "by USER ID {$session->user_id}");
  // }

  // if(isset($session->username)) {
  //   log_action('Logout', "by {$session->username}");
  // } else {
  //   echo "not set.";
  // }

  // echo "<br>";

  // echo "\$_SESSION['user_id']: " . $_SESSION['user_id'] . "<br>"; // user_id set by session.php
  // echo "\$_SESSION['first_name']: " . $_SESSION['first_name'] . "<br>"; // first_name not available in $_SESSION
  // echo "\$_SESSION['last_name']: " . $_SESSION['last_name'] . "<br>"; // last_name not available in $_SESSION
  // echo "\$_SESSION['username']: " . $_SESSION['username'] . "<br>"; // username set from the login form typed value, NOT the stored database value (you can check case sensitivity)

  // echo "<br>";

      $user = User::find_by_id($session->user_id);

      // echo "UserID: " . $user->id . "<br>";
      // echo "Username: " . $user->username . "<br>";
      // echo "First name: " . $user->first_name . "<br>";
      // echo "Last name: " . $user->last_name . "<br>";
      // echo "Full Name: " . $user->full_name() . "<br>";
      // echo "Password: " . $user->password . "<br>";

      if(null !== $user->full_name()) { // Use null !== func() if testing against a function - cannot use isset
      // if(isset($session->user_id)) { // Use isset to check if a variable is set
        log_action('Logout', "by {$user->full_name()}");
        // echo "Logout by {$user->full_name()} <br>";
      }

  $session->logout();

  redirect_to("login.php");
?>