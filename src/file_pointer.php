<?php

  $file = 'filetest.txt';
  if ($handle = fopen($file, 'w')) { // overwrites anything existing

    fwrite($handle, 'abc   '); // returns number of bytes or false
    $content = "123\n456";
    fwrite($handle, $content);

    $pos = ftell($handle);

    fseek($handle, $pos -6);
    fwrite($handle, "abcdef");

    rewind($handle);
    fwrite($handle, "xyz");

    echo "File successfully written.";
    fclose($handle);
  } else {
    echo "Could not open file for writing.";
  }

  // Beware it will OVERTYPE!!!
  // Note: a and a+ modes will not let you  move the pointer

?>