<?php
  // If it's going to need the database, then it's
  // probably smart to require it before we start.
  require_once(LIB_PATH.DS.'database.php');

  // Get our SMTP configs
  require_once(LIB_PATH.'smtp_config.php');

  class Comment extends DatabaseObject {

    protected static $table_name="comments";
    protected static $db_fields=array('id', 'photograph_id', 'created', 'author', 'body');

    public $id;
    public $photograph_id;
    public $created;
    public $author;
    public $body;

    // "new" is a reserved word so we use "make" (or "build")
    public static function make($photo_id, $author="Anonymous", $body="") {
      if(!empty($photo_id) && !empty($author) && !empty($body)) {
        $comment = new Comment();
        $comment->photograph_id = (int)$photo_id;
        $comment->created = strftime("%Y/%m/%d %H:%M:%S", time());
        $comment->author = $author;
        $comment->body = $body;
        return $comment;
      } else {
        return false;
      }
    }

    public static function find_comments_on($photo_id=0) {
      global $database;
      $sql = "SELECT * FROM " . static::$table_name;
      $sql .= " WHERE photograph_id=" . $database->escape_value($photo_id);
      $sql .= " ORDER BY created ASC";
      return static::find_by_sql($sql);
    }

    public function comment_mail_notification() {
      $mail = new PHPMailer;

      $mail->SMTPDebug = 3;

      $mail->isSMTP();
      $mail->Host = SMTP_HOST;
      $mail->SMTPAuth = SMTP_AUTH;
      $mail->Username = SMTP_USER;
      $mail->Password = SMTP_PASS;
      $mail->SMTPSecure = SMTP_SECURE;
      $mail->Port = SMTP_PORT;

      $mail->From = SMTP_FROM;
      $mail->FromName = SMTP_FROM_NAME;

      $mail->addReplyTo(SMTP_REPLY_TO, SMTP_REPLY_TO_NAME);

      $mail->addAddress(SMTP_TO, SMTP_TO_NAME);

      $mail->isHTML(SMTP_ISHTML);

      $mail->Subject = SMTP_SUBJECT . strftime("%T", time());

      $created = datetime_to_text($this->created);

      $mail_body = nl2br($this->body);

      $photo = Photograph::find_by_id($_GET['id']);

      $mail->Body =<<<EMAILBODY

A new comment has been received in the Photo Gallery.<br>
<br>
Photograph: {$photo->filename}<br>
<br>
On {$created}, {$this->author} wrote:<br>
<br>
{$mail_body}<br>

EMAILBODY;

      $result = $mail->send();
      return $result;
    }

  }
?>
