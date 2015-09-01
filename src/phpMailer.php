<?php
  // Get our SMTP configs
  require_once(LIB_PATH.'smtp_config.php');

  class Mailer {

    public function comment_mail_notification() {
      // This method uses PHPMailer
      // See sendmail.php for using PHP's standard built in mail() function

      $mail = new PHPMailer;

      // phpMailer reporting
      $mail->SMTPDebug = 3;

      // You can leave out the following section and PHPMailer will still function as a
      // class and mehtod, as detailed below, but will use the standard PHP Sendmail function.
      // In order to utilise the SMTP features of PHPMailer, set isSMTP() and your server details.

      // SMTP sending server configs
      $mail->isSMTP(); // Set mailer to use SMTP
      $mail->Host = SMTP_HOST; // Specify main and backup SMTP servers
      $mail->SMTPAuth = SMTP_AUTH; // Enable SMTP authentication
      $mail->Username = SMTP_USER; // SMTP username
      $mail->Password = SMTP_PASS; // SMTP password
      $mail->SMTPSecure = SMTP_SECURE; // Enable TLS encryption, `ssl` also accepted
      $mail->Port = SMTP_PORT; // TCP port to connect to
      // End of SMTP Configs

      // FROM: details
      $mail->From = SMTP_FROM;
      $mail->FromName = SMTP_FROMNAME;

      // Reply-To (if different)
      $mail->addReplyTo('user@domain.com', 'User Name');

      // $to_name = "User Name";
      // $to = "user@domain.com";

      // TO: details
      // $mail->addAddress($to, $to_name)
      $mail->addAddress('user@domain.com', 'User Name'); // Add a recipient
      // $mail->addAddress('ellen@example.com'); // Name is optional

      // $mail->addCC('cc@example.com');
      // $mail->addBCC('bcc@example.com');

      // Attachments
      // $mail->addAttachment('/var/tmp/file.tar.gz'); // Add attachments
      // $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // Optional name

      // Mail format
      $mail->isHTML(SMTP_ISHTML); // Set email format to HTML

      // Mail Subject
      $mail->Subject = SMTP_SUBJECT . strftime("%T", time());

      // Mail Body
      // $mail->Body    = 'A new comment has been received.';
      // $mail->AltBody = 'A new comment has been received.';

      // Format the created time more nicely.
      $created = datetime_to_text($this->created);
      // Ensure line endings are preserved even in HEREDOC HTML email output.
      $mail_body = nl2br($this->body);

      // Get all the photo attributes so we can use them in the email
      $photo = Photograph::find_by_id($_GET['id']);

      // Generate the email body with HEREDOC
      $mail->Body =<<<EMAILBODY

A new comment has been received in the Photo Gallery.<br>
<br>
Photograph: {$photo->filename}<br>
<br>
On {$created}, {$this->author} wrote:<br>
<br>
{$mail_body}<br>

EMAILBODY;

      // Process mail and Status feedback
      // if(!$mail->send()) {
      //     echo 'Message could not be sent.';
      //     echo 'Mailer Error: ' . $mail->ErrorInfo;
      // } else {
      //     echo '<br><br><hr>';
      //     echo 'Message has been sent';
      // }

      // Alternate process with no feedback
      $result = $mail->send();
      return $result;
    } // End Method comment_notification

  } // End Class Mailer

?>
