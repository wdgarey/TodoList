<?php
    include('../private/includes/header-include.php');
?>
<?php
    if (isset($message))
    {
        include('../private/includes/message-include.php');
    }
?>

<form class="form-signin" method="POST" action="<?php echo (Utils::GetScript ('ProcessLogin')); ?>">
  <h2 class="form-signin-heading">Please sign in</h2>
  <label >Username</label>
  <input type="text" placeholder="Username" required autofocus name="username" class="form-control" value="<?php echo(Utils::GetHtmlSafe ($username)); ?>" />
  <label >Password</label>
  <input type="password" placeholder="Password" required name="password" class="form-control" value="<?php echo(Utils::GetHtmlSafe ($password)); ?>"/>
  <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>

<?php
    include('../private/includes/footer-include.php');
?>
