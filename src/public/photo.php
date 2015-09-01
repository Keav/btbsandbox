<?php
  require_once("../includes/initialise.php");

  if(empty($_GET['id'])) {
    $session->message("No photograph ID was provided.");
    // redirect_to("index.php");
  }

  $photo = Photograph::find_by_id($_GET['id']);

  if(!$photo) {
    $session->message("The photo could not be located.");
    redirect_to("index.php");
  }

  // Form processing
  if(isset($_POST['submit'])) {
    $author = trim($_POST['author']);
    $body = trim($_POST['body']);

    $new_comment = Comment::make($photo->id, $author, $body);

    if($new_comment && $new_comment->save()) {
      // comment saved
      // No message needed; seeing the comment is proof enough.

      // Send email
      $new_comment->comment_mail_notification();

      // Important! You could just let the page render from here.
      // But then if the page is reloaded, the form will try
      // to resubmit the comment. So redirect instead:
      redirect_to("photo.php?id={$photo->id}");
    } else {
      // Failed
      $message = "There was an error that prevented the comment from being saved.";
    }

  } else {
    $author = "";
    $body = "";
  }

  // Database calls are 'expensive'.
  // The form processing above contains a redirect_to and does not always result in content being displayed
  // so putting this database call AFTER the form processing saves us an unecessary database call
  // further up the page, above the form processing.
  // $comments = Comment::find_comments_on($photo->id);
  $comments = $photo->comments();

?>

<?php include_layout_template('header.php'); ?>

<a href="index.php">&laquo; Back</a><br>

<br>

<div style="margin-left: 20px;">
  <img src="<?php echo $photo->image_path(); ?>">
  <p><?php echo $photo->caption; ?></p>
</div>

<!-- list comments -->
<div id="comments">
  <?php foreach($comments as $comment): ?>
    <div class="comment" style="margin-bottom: 2em;">
      <div class="author">
        <?php echo htmlentities($comment->author); ?> wrote:
      </div>
      <div class="body">
        <?php echo nl2br(strip_tags($comment->body, '<strong<em><p>')); ?>
      </div>
      <div class="meta-info" style="font-size: 0.8em;">
        <?php echo datetime_to_text($comment->created); ?>
      </div>
    </div>
    <?php endforeach; ?>
    <?php if(empty($comments)) { echo "No Comments."; } ?>
</div>

<!-- Submit a comment -->
<div id="comment-form">
  <h3>New Comment</h3>
  <?php echo output_message($message); ?>
  <form action="photo.php?id=<?php echo $photo->id; ?>" method="POST">
    <table>
      <tr>
        <td>Your name:</td>
        <td><input type="text" name="author" value="<?php echo $author; ?>"></td>
      </tr>
      <tr>
        <td>Your comment:</td>
        <td><textarea name="body" cols="40" rows="8"><?php echo $body; ?></textarea></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="submit" value="Submit Comment"></td>
      </tr>
    </table>
  </form>
</div>

<?php include_layout_template("footer.php"); ?>
