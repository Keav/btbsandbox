<?php

  echo "Owner ID: " . fileowner('file_permissions.php');

  echo "<br>";

  // If we have posix installed
  $owner_id = fileowner('file_permissions.php');
  $owner_array = posix_getpwuid($owner_id);
  echo "Owner Name (Using POSIX): " . $owner_array['name'];

  echo "<br>";

  echo substr(decoct(fileperms('file_permissions.php')), 2);

  chmod('file_permissions.php', 0777);

  echo "<br>";

  echo substr(decoct(fileperms('file_permissions.php')), 2) . "<br>";

  echo "<br>";

  echo "Is the file readable? " . (is_readable('file_permissions.php') ? 'yes' : 'no') . "<br>";
  echo "Is the file writable? " . (is_writable('file_permissions.php') ? 'yes' : 'no') . "<br>";

?>