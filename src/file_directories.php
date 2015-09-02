<?php

  // we already used:
  // dirname()
  // is_dir()

  // getcwd(): Current Working Directory
  echo getcwd() . "<br>";


  // mkdir()
  if(!file_exists('new')) {
    mkdir('new', 0777); // 0777 is the PHP default
  } else {
    echo "Directory already exists.";
  }

  // you can use unmask() to change the default permission settings
  // default may be 0022

  // recursive dir creation
  mkdir('new/test/test2', 0777, true);

  // changing dirs
  chdir('new');

  echo getcwd() . "<br>";

  // removing a directory
  rmdir('test/test2');

  // must be closed and EMPTY before removal (and be CAREFUL)
  // scripts to help you wipe out directories with file:
  // http://www.php.net/manual/en/function.rmdir.php
?>