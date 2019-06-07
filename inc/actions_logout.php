<?php
require_once "bootstrap.php";

if (isAuthenticated()) {
  $session->set('auth_logged_in', false);
  $session->set('auth_user_id', null);
  $session->set('auth_roles', null);
  $session->getFlashBag()->add('success', 'You are logged out.');
  redirect('/');
} else {
  $session->getFlashBag()->add('error', 'Something went wrong. Try logging out again or contact site admin for help.');
  redirect('/');
}
