<?php
  ob_start();

  // Define the core paths
  // Define them as absolute paths to make sure that require_once works as expected

  // DIRECTORY_SEPARATOR is a PHP pre-defined constant
  // (\ for Windows, / for Unix)
  defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

  defined('DOCUMENT_ROOT') ? null : define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);

  defined('LIB_PATH') ? null : define('LIB_PATH', DOCUMENT_ROOT.'/includes/');


  // load config file first
  require_once(LIB_PATH.'config.php');

  // load basic functions next so that everything after can use them
  require_once(LIB_PATH.'functions.php');

  // load core objects
  require_once(LIB_PATH.'session.php');
  require_once(LIB_PATH.'database.php');
  require_once(LIB_PATH.'database_object.php');
  require_once(LIB_PATH.'pagination.php');
  require_once(LIB_PATH.DS."phpMailer".DS."PHPMailerAutoload.php");

  // load databse related classes
  require_once(LIB_PATH.'user.php');
  require_once(LIB_PATH.'photograph.php');
  require_once(LIB_PATH.'comment.php');

?>