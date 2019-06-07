<?php

function getAllUsers() {
  global $db;

  try {
    $query = "SELECT * FROM users";
    $stmt = $db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
  } catch (\Exception $e) {
    throw $e;
  }
}

function findUserByUsername($username) {
  global $db;

  try {
    $query = "SELECT * FROM users WHERE username = :username";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    return $stmt->fetch();
  } catch (\Exception $e) {
    throw $e;
  }
}

function findUserById($userId) {
  global $db;

  try {
    $query = "SELECT * FROM users WHERE id = :userId";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
    return $stmt->fetch();
  } catch (\Exception $e) {
    throw $e;
  }
}

function createUser($username, $password) {
  global $db;

  try {
    $query = "INSERT INTO users (username, password, role_id) VALUES (:username, :password, 2)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    return findUserByUsername($username);
  } catch (\Exception $e) {
    throw $e;
  }
}

function updateUser($userId, $password, $username) {
  global $db;

  try {
    findUserById($userId);
    $statement = $db->prepare('UPDATE users SET username=:username, password=:password WHERE id=:id');
    $statement->bindParam('username', $username);
    $statement->bindParam('password', $password);
    $statement->bindParam('id', $userId);
    $statement->execute();
  } catch (Exception $e) {
    echo "Error!: " . $e->getMessage() . "<br />";
    return false;
  }
  return findUserById($userId);
}

function deleteUser($userId) {
  global $db;

  try {
    $query = "DELETE FROM users WHERE (id) VALUES (:userid)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':userid', $userId);
    $stmt->execute();
  } catch (\Exception $e) {
    throw $e;
  }
}

function changeRole($userId, $roleId) {
  global $db;

  try {
    $query = "UPDATE users SET role_id = :roleId WHERE id = :userId";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':roleId', $roleId);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
    return findUserById($userId);
  } catch (\Exception $e) {
    throw $e;
  }
}
