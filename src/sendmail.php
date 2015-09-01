<?php
  // Uses PHP's standard built-in sendmail function mail()
  //
  // Usage is:
  // mail($to, $subject, $message, $headers);
  //
  // Some examples of $to usage
  // $to = "user@domain.com"
  // $to = "User Name <user@domain.com>";
  // $to = "User Name <user@domain.com>, user@domain.net"
  //
  // $subject = "Subject string";
  //
  // $message = "This is a message string";
  // Optional wordwrap (for old email programs)
  // $message = wordwrap($message, 70);
  //
  // Byd efault there is no from field but we can add one through the headers
  // $from = "user@domain.com";
  // $headers = "From: {$from}";
  //
  // Example real-world usage with a success test:
  // $result = mail($to, $subject, $message, $headers);
  // echo $result ? 'Sent' : 'Error';

  $to = "chris@chriskeavey.com";

  // Windows may not handle this format well
  // $to = "User Name <user@domain.com>";

  // multiple recipients
  // $to = "user@domain.com, user@domain2.com";
  // $to = "User Name <user@domain.com>, user@domain2.com";

  $subject = "Mail Test at " . strftime("%T", time());

  $message = "This is a test.";

  // Optional: Wrap lines for old email programs
  // wrap at 70/72/75/78
  $message = wordwrap($message, 70);

  $from = "PHP Photo Gallery <chris@keav.net>";

  // Standard headers
  $headers = "From: {$from}\n";
  $headers .= "Reply-To: {$from}\n";
  $headers .= "CC: {$to}\n";
  $headers .= "BCC: {$to}\n";

  // Non-standard headers
  // Don't forget the \n line returns! Not needed on the last header.
  $headers .= "X-Mailer: PHP/" . phpversion() . "\n";
  $headers .= "MIME-Version: 1.0\n";
  $headers .= "Content-Type: text/plain; charset-iso-8859-1"; // Also: text/html to set HTML

  $result = mail($to, $subject, $message, $headers);

  echo $result ? 'Sent' : 'Error';
?>
