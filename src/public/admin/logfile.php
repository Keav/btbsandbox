<?php
  require_once("../../includes/initialise.php");

  if (!$session->is_logged_in()) {
    redirect_to("login.php");
  }

  $logfile = DOCUMENT_ROOT.DS.'logs'.DS.'log.txt';

  if(isset($_GET['clear'])) {
    if($_GET['clear'] == 'true') {
      file_put_contents($logfile, '');

      $user = User::find_by_id($session->user_id);

      // Add the first log entry
      // log_action('Logs cleared', "by USER {$session->username}");
      log_action('Logs cleared', "by USER {$user->full_name()}");

      // redirect to this same page so that the URL won't
      // have "clear=true" anymore
      redirect_to("logfile.php");
    }
  }

  include_layout_template('admin_header.php');
?>

<a href="index.php">&laquo; Back</a><br>
<br>

<h2>Log File</h2>

<p><a href="logfile.php?clear=true">Clear log File</a></p>

<?php
  if (file_exists($logfile) && is_readable($logfile) && $handle = fopen($logfile, 'r')) {
    echo "<ul class=\"log-entries\">";
    while(!feof($handle)) {
      $entry = fgets($handle);
      if(trim($entry) != "") {
        echo "<li>{$entry}</li>";
      }
    }
    echo "</ul>";
    fclose($handle);
  } else {
    echo "Could not read from {$logfile}";
  }
?>

<?php include_layout_template('footer.php'); ?>
