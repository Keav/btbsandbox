<?php

  $file = "filetest.txt";
  if($handle = fopen($file, 'r')) { // read
    $content = fread($handle, 9); // each character is 1 byte
    fclose($handle);
  }

  echo nl2br($content);

  echo "<br>";
  echo "<hr>";

  // use filesize() to read the whole file
  $file = 'filetest.txt';
  if($handle = fopen($file, 'r')) { // read
    $content = nl2br(fread($handle, filesize($file)));
    fclose($handle);
  }

  echo $content;

  echo "<br>";
  echo "<hr>";

  // file_get_contents(): shortcut for fopen/fread/fclose
  // companion to shortcut file_put_contents()
  $content = nl2br(file_get_contents($file));
  echo $content;

  echo "<br>";
  echo "<hr>";

  // incremental reading
  $file = 'filetest.txt';
  $content = "";
  if($handle = fopen($file, 'r')) { // read
    while(!feof($handle)) {
      $content .= nl2br(fgets($handle));
    }
    fclose($handle);
  }

  echo $content;
?>