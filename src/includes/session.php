<?php
// A class to help work with Sessions
// In our case, primarily to manage loggin users in and out

// Keep in mind when working with session that it is generally
// inadvisable to store DB-related objects in sessions

  class Session {

    private $logged_in=false;
    public $user_id;
    public $message;

    function __construct() {
      $session_lifetime = 1800;
      session_set_cookie_params($session_lifetime);
      session_start();
      // session_regenerate_id(true);

      $this->maintain_session($session_lifetime);
      $this->regenerate_session_id($session_lifetime);

      $this->check_message();
      $this->check_login();

      if($this->logged_in) {
        // actions to take straight away if user logged in
      } else {
        // actions to take straight away if user is not logged in
      }
    }

    private function maintain_session($session_lifetime) {
      // Force server side logout at expiration of session time (from last activity), regardless of client side Cookie
      // In theory, this will never run! - Unless cookie time is longer than session time and a user attempts activity in that window.
      if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $session_lifetime)) {
        // last request was more than 30 minutes ago
        // session_unset();     // unset $_SESSION variable for the run-time
        // session_destroy();   // destroy session data in storage
        $this->logout();
      } else {
        // If activity, reset server side session timer and reset client side Cookie expiration
        $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
        // session_regenerate_id(true);
        if (isset($_COOKIE[session_name()])) {
          setcookie(session_name(), $_COOKIE[session_name()], time()+$session_lifetime, '/', '', 0, true);
        }
      }
    }

    private function regenerate_session_id($session_lifetime) {
      if (!isset($_SESSION['CREATED'])) {
        $_SESSION['CREATED'] = time();
      } else if (time() - $_SESSION['CREATED'] > $session_lifetime) {
        // session started more than 30 minutes ago
        session_regenerate_id(true);    // change session ID for the current session and invalidate old session ID
        $_SESSION['CREATED'] = time();  // update creation time
      }
    }

    public function is_logged_in() {
      return $this->logged_in;
    }

    public function login($user) {
      // database should find user based on username/password
      if($user) {
        $this->user_id = $_SESSION['user_id'] = $user->id;
        $this->logged_in = true;
        session_regenerate_id(true);
      }
    }

    public function logout() {
      if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-42000, '/');
      }
      unset($_SESSION['user_id']);
      unset($this->user_id);
      $this->logged_in = false;

      $_SESSION = array();
      session_destroy();
    }

    public function message($msg="") {
      if(!empty($msg)) {
        // then this is "set message"
        // make sure you understand why $this->message=$msg wouldn't work
        $_SESSION['message'] = $msg;
      } else {
        // then this is "get message"
        return $this->message;
      }
    }

    private function check_login() {
      if(isset($_SESSION['user_id'])) {
        $this->user_id = $_SESSION['user_id'];
        $this->logged_in = true;
      } else {
        unset($this->user_id);
        $this->logged_in = false;
      }
    }

    private function check_message() {
      // Is there a message stored in the session?
      if(isset($_SESSION['message'])) {
        // Add it as an attribute and erase the stored version
        $this->message = $_SESSION['message'];
        unset($_SESSION['message']);
      } else {
        $this->message = "";
      }
    }

  }

  $session = new Session();
  $message = $session->message();

?>