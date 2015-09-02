<?php
  require_once('../../includes/initialise.php');

  if (!$session->is_logged_in()) { redirect_to("login.php"); }
?>

<?php include_layout_template('admin_header.php') ?>

<?php
  // Create new record in the database
  // $user = new User();
  // $user->username = "user2";
  // $user->password = "secret";
  // $user->first_name = "User";
  // $user->last_name = "Number2";
  // $user->create();

  // Update a record in the database
  // $user = User::find_by_id(2);
  // $user->password = "secret";
  // $user->save();

  // Delete a record from the databse
  // $user = User::find_by_id(2);
  // $user->delete();
?>

<?php include_layout_template('admin_footer.php'); ?>
