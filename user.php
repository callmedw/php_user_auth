<?php
  require_once 'inc/bootstrap.php';

  if (isAuthenticated()) {
    $pageTitle = "Update User";
    $page = 'update';
    $user_id = $session->get('auth_user_id');
    $username = $session->get('auth_username');
  } else {
    $pageTitle = "Register | Time Tracker";
    $page = 'register';
  }

  include 'inc/header.php';
?>

<div class="col-container page-container">
  <div class="col col-70-md col-60-lg col-center">
    <h1 class="actions-header">
      <?php echo (isAuthenticated() ? "Update" : "Create"); ?>
      User
    </h1>
    <?php
      if (isset($error_message)) {
        echo "<p class='message'>$error_message</p>";
      }
    ?>

  <form class="form-container" method="post" action="inc/actions_users.php">
    <table class="items">
      <tr>
        <th><label for="inputUsername" class="sr-only">Username</label></th>
        <td><input required autofocus type="username" id="inputUsername" name="username" class="form-control" placeholder="Username" ?> </td>
      </tr>
      <tr>
        <th><label for="inputPassword" class="sr-only">Password</label></th>
        <td><input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required></td>
      </tr>
      <tr>
        <th><label for="inputPassword" class="sr-only">Confirm Password</label></th>
        <td><input type="password" id="inputPassword" name="confirm_password" class="form-control" placeholder="Confirm Password" required></td>
      </tr>
    </table>
    <?php
      if (isAuthenticated()) {
        echo "<input type='hidden' name='action' value='update' />";
        echo "<input type='hidden' name='user_id' value='$user_id' />";
      } else {
        echo "<input type='hidden' name='action' value='add' />";
      }
    ?>
    <input
      class="button button--primary button--topic-php"
      type="submit"
      value=<?php echo (isAuthenticated() ? "Update" : "Create"); ?>
    />
  </form>

  </div>
</div>

<?php include("inc/footer.php"); ?>
