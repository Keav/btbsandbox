<?php

  $to = "chris@chriskeavey.com";

  // Windows may not handle this format well
  // $to = "Chris Keavey <chris@keav.net>";

  // multiple recipients
  // $to = "chris@keav.net, chris@chriskeavey.com";
  // $to = "Chris Keavey <chris@keav.net>, chris@chriskeavey.com";

  $subject = "Mail Test at " . strftime("%T", time());

  $message = "This is a test.";

  // Optional: Wrap lines for old email programs
  // wrap at 70/72/75/78
  $message = wordwrap($message, 70);

  $from = "Chris Keavey <chris@keav.net>";

  // Standard headers
  $headers = "From: {$from}\n";
  $headers .= "Reply-To: {$from}\n";
  $headers .= "CC: {$to}\n";
  $headers .= "BCC: {$to}\n";

  // Non-standard headers
  $headers .= "X-Mailer: PHP/" . phpversion() . "\n";
  $headers .= "MIME-Version: 1.0\n";
  $headers .= "Content-Type: text/plain; charset-iso-8859-1"; // Also: text/html

  $result = mail($to, $subject, $message, $headers);

  echo $result ? 'Sent' : 'Error';
?>
