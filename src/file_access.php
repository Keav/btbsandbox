<?php

  $file = 'filetest.txt';
  if ($handle = fopen($file, 'w')) {
    echo "File successfully written.";
    fclose($handle);
  } else {
    echo "Could not open file for writing.";
  }

?>