<?php
require_once 'inc/bootstrap.php';
isAuthorized();
$user = findUserById($session->get('auth_user_id'));
$pageTitle = $user['username'] ."'s Account | Time Tracker";
$page = 'account';
include 'inc/header.php';
?>
<div class="col-container page-container">
  <div class="col col-70-md col-60-lg col-center">
    <h2 class="form-signin-heading"><?php echo $user['username'] ."'s Account"; ?></h2>
    <h4>Change Password</h4>

    <form class="form-container" method="post" action="/inc/actions_users.php">
      <table class="items">
        <tr>
          <th><label for="inputCurrentPassword" class="sr-only">Current Password<span class="required">*</span></label></th>
          <td><input type="password" id="inputCurrentPassword" name="current_password" class="form-control" placeholder="Current Password" required autofocus></td>
        </tr>
        <tr>
          <th><label for="inputPassword" class="sr-only">New Password<span class="required">*</span></label></th>
          <td><input type="password" id="inputPassword" name="password" class="form-control" placeholder="New Password" required></td>
        </tr>
        <tr>
          <th><label for="inputPassword" class="sr-only">Confirm New Password<span class="required">*</span></label></th>
          <td><input type="password" id="inputPassword" name="confirm_password" class="form-control" placeholder="Confirm New Password" required></td>
        </tr>
      </table>
      <?php
        echo "<input type='hidden' name='action' value='update' />";
        echo "<input type='hidden'name='user_id' value=". $user['id'] .">";
      ?>
      <input class="button button--primary button--topic-php" type="submit" value="Change Password" />
    </form>
  </div>
</div>

<?php include("inc/footer.php"); ?>
