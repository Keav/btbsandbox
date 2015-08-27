<?php
  require_once("../includes/initialise.php");
?>

<?php include_layout_template('header.php'); ?>

    <h2>Menu</h2>

    <hr>

    <?php
      $user = User::find_by_id(1);

      echo "UserID: " . $user->id . "<br>";
      echo "Full Name: " . $user->full_name() . "<br>";
      echo "Password: " . $user->password . "<br>";
    ?>

    <hr>

    <?php
      $users = User::find_all();

      foreach($users as $user) {
        echo "User: " . $user->username . "<br>";
        echo "Full Name: " . $user->full_name() . "<br>";
      }
    ?>

  </div>

<?php include_layout_template('footer.php'); ?>
