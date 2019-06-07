<?php

function isAuthenticated() {
  global $session;
  return $session->get('auth_logged_in', false);
}

function isAuthorized() {
  if(!isAuthenticated()) {
    global $session;
    $session->getFlashBag()->add('error', 'You must be logged in to visit this page.');
    redirect('/login.php');
  }
}
