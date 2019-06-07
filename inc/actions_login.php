<?php
require_once "bootstrap.php";

$user = findUserByUsername(request()->get('username'));

if (empty($user)) {
  $session->getFlashBag()->add('error', 'Either the username or password does not match our records.');
  redirect('/login.php');
}

if (password_verify(request()->get('password'), $user['password'])) {
  $session->set('auth_logged_in', true);
  $session->set('auth_user_id', (int) $user['id']);
  $session->set('auth_roles', (int) $user['role_id']);
  $session->getFlashBag()->add('success', 'You are logged in.');
  redirect('/');
} else {
  $session->getFlashBag()->add('error', 'Either the username or password does not match our records.');
  redirect('/login.php');
}
