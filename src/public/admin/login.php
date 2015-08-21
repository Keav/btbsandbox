<?php
  require_once("../../includes/functions.php");
  require_once("../../includes/session.php");
  require_once("../../includes/database.php");
  require_once("../../includes/user.php");

  if($session->is_logged_in()) {
    redirect_to("index.php");
  }

  // Remeber to give you form's submit tag a name="submit" attribute!
  if (isset($_POST['submit'])) { // Form has been submitted

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Check database to see if username/password exist.

    if ($found_user) {
      $session->login($found_user);
      redirect_to("index.php");
    } else {
      // username/password combo was not found in the database
      $message = "Username/Password combination incorrect.";
    }
  } else { // Form has not been submitted.
    $username = "";
    $password = "";
  }
?>
