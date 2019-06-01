<?php
require_once __DIR__ . '/../inc/bootstrap.php';

$username = request()->get('username');
$password = request()->get('password');
$confirmPassword = request()->get('confirm_password');

if ($password != $confirmPassword) {
    $session->getFlashBag()->add('error', 'Passwords do NOT match');
    redirect('/register.php');
}

$user = findUserByUsername($username);
if (!empty($user)) {
    $session->getFlashBag()->add('error', 'User already exists');
    redirect('/register.php');
}