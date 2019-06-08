<?php
require_once "bootstrap.php";

$action = request()->get('action');
$userId = request()->get('user_id');
$username = request()->get('username');
$password = request()->get('password');
$confirmPassword = request()->get('confirm_password');
$currentPassword = request()->get('current_password');
$user = findUserById($userId);
$hashed = password_hash($password, PASSWORD_DEFAULT);

if ($password != $confirmPassword) {
	$session->getFlashBag()->add('error', 'Passwords do NOT match');
	redirect('/user.php');
}

switch ($action) {
	case "add":
	if (empty($username)) {
		$session->getFlashBag()->add('error', 'Please enter a user');
		redirect('/user.php');
	} elseif (!empty(findUserByUsername($username))) {
		$session->getFlashBag()->add('error', 'User already exists');
		redirect('/user.php');
	} elseif (createUser($username, $hashed)) {
		$session->getFlashBag()->add('success', 'New User Added');
		redirect('/');
	}
	break;
	case "update":
		if (password_verify($currentPassword, $user['password'])) {
			if (updateUser($userId, $hashed)) {
				$session->getFlashBag()->add('success', 'User Updated');
				redirect('/');
			} else {
				$session->getFlashBag()->add('error', 'Could NOT update user');
				redirect('/account.php');
			}
		} else {
			$session->getFlashBag()->add('error', 'Please enter your current password first.');
			redirect('/account.php');
		}
	break;
}
