<?php
require_once "bootstrap.php";

$action = request()->get('action');
$userId = request()->get('user_id');
$username = request()->get('username');
$password = request()->get('password');
$confirmPassword = request()->get('confirm_password');
$hashed = password_hash($password, PASSWORD_DEFAULT);

$url="../user_list.php";
if (request()->get('filter')) {
	$url.="?filter=".request()->get('filter');
}

if (empty($username)) {
	$session->getFlashBag()->add('error', 'Please enter a user');
	redirect('/user.php');
} elseif ($password != $confirmPassword) {
	$session->getFlashBag()->add('error', 'Passwords do NOT match');
	redirect('/user.php');
} elseif (!empty(findUserByUsername($username))) {
	$session->getFlashBag()->add('error', 'User already exists');
	redirect('/user.php');
}

switch ($action) {
	case "add":
		if (createUser($username, $hashed)) {
			$session->getFlashBag()->add('success', 'New User Added');
			redirect('/');
		}
	break;
	case "update":
		if (updateUser($userId, $hashed, $username)) {
			$session->getFlashBag()->add('success', 'User Updated');
			redirect('/inc/actions_logout.php');
		} else {
			$session->getFlashBag()->add('error', 'Could NOT update user');
			redirect('/');
		}
	break;
}
