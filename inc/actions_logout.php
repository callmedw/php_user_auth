<?php
require_once "bootstrap.php";

if (isAuthenticated()) {
  $session->remove('auth_logged_in');
  $session->remove('auth_user_id');
  $session->remove('auth_roles');
  $session->getFlashBag()->add('success', 'You are logged out.');
  redirect('/');
} else {
  $session->getFlashBag()->add('error', 'Something went wrong. Try logging out again or contact site admin for help.');
  redirect('/');
}
