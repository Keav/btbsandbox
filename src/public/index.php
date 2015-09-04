<?php
  require_once("../includes/initialise.php");

  // 1. the current page number ($current_page)
  $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

  // 2. records per page ($per_page)
  $per_page = 2;

  // 3. toatl record count ($total_count)
  $total_count = Photograph::count_all();

  // Find all photos
  // use pagination instead
  // $photos = Photograph::find_all();

  $pagination = new Pagination($page, $per_page, $total_count);

  // Instead of finding all records, just fine the records
  // for this page.
  $sql = "SELECT * FROM photographs ";
  $sql .= "LIMIT {$per_page} ";
  $sql .= "OFFSET {$pagination->offset()}";
  $photos = Photograph::find_by_sql($sql);

  // Need to add ?page=$page to all links we want to
  // maintain the current page (or store $page in $session)

?>

<?php include_layout_template('header.php'); ?>

    <a href="admin/">Admin Page</a><br>

    <h2>Home Page</h2>

    <?php echo output_message($message); ?>

    <?php foreach($photos as $photo): ?>
      <div style="float: left; overflow:auto; margin-left: 20px">
        <a href="photo.php?id=<?php echo $photo->id; ?>">
          <img src="<?php echo $photo->image_path(); ?>" width="200">
        </a>
        <p><?php echo $photo->caption; ?></p>
      </div>
    <?php endforeach; ?>

    <br style="clear: both;">

    <div id="pagination">
      <?php
        if($pagination->total_pages() > 1) {

          if($pagination->has_previous_page()) {
            echo " <a href=\"index.php?page=";
            echo $pagination->previous_page();
            echo "\">&laquo; Previous</a> ";
          }

          for($i=1; $i <= $pagination->total_pages(); $i++) {
            if($i == $page) {
              echo " <span class=\"selected\">{$i}</span> ";
            } else {
              echo " <a href=\"index.php?page={$i}\">{$i}</a> ";
            }
          }

          if($pagination->has_next_page()) {
            echo " <a href=\"index.php?page=";
            echo $pagination->next_page();
            echo "\">Next &raquo;</a> ";
          }
        }
      ?>
    </div>

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
        echo "<br>";
      }
    ?>

  <hr>

  <?php
    $classes = get_declared_classes();

    foreach($classes as $class) {
      echo $class . "<br>";
    }

    echo "<br>";

    $methods = get_class_methods('Comment');
    echo "<pre>";
    print_r($methods);
    echo "</pre>";

    foreach($methods as $method) {
      echo $method . "<br>";
    }
  ?>

  </div> <!-- End of main page div -->

<?php include_layout_template('footer.php'); ?>
