<?php
  require_once 'inc/bootstrap.php';

  if (request()->get('id')) {
    $user_id = getUser(request()->get('id'));
  }

  if (!empty($user_id)) {
    $pageTitle = "Register | Time Tracker";
    $page = 'register';
  } else {
    $pageTitle = "Update User";
    $page = 'update';
  }

  include 'inc/header.php';
?>

<div class="col-container page-container">
  <div class="col col-70-md col-60-lg col-center">
    <h1 class="actions-header">
      <?php
        if (!empty($user_id)) {
          echo "Update";
        } else {
          echo "Create";
        }
      ?>
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
          <td><input type="username" id="inputUsername" name="username" class="form-control" placeholder="Username" required autofocus></td>
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
      if (!empty($user_id)) {
        echo "<input type='hidden' name='action' value='update' />";
        echo "<input type='hidden' name='user_id' value='$user_id' />";
      } else {
        echo "<input type='hidden' name='action' value='add' />";
      }
      ?>
      <input class="button button--primary button--topic-php" type="submit" value="Create Account" />
    </form>

  </div>
</div>

<?php include("inc/footer.php"); ?>
