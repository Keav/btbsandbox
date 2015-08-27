<?php

  // like fopen/fread/fclose:
  // opendir()
  // readdir()
  // closedir()

  $dir = ".";
  if(is_dir($dir)) {
    if($dir_handle = opendir($dir)) {
      while($filename = readdir($dir_handle)) {
        echo "Filename: {$filename}<br>";
      }
      // use rewinddir($dir_handle) to start over
      closedir($dir_handle);
    }
  }

  echo "<hr>";

  // scandir(): reads all filenames into an array
  if(is_dir($dir)) {
    $dir_array = scandir($dir);
    foreach($dir_array as $file) {
      if(stripos($file, '.') > 0) {
        echo "Filename: {$file}<br>";
      }
    }
  }

  // not much shorter, but maybe less comlicated
  // makes things like reverse order much easier

?>