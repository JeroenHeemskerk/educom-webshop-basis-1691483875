<?php
include "users.repository.php";
function AuthorizeUser($email, $password){
    $user = FindUserByEmail($email);
    if(empty($user)){
        return null;
    }
    if($password != $user['password']){
        return "error";
    }
    return $user;
}
function DoesEmailExist($email){
    $user = FindUserByEmail($email);
    return !empty($user);
}
function StoreUser($email, $name, $password){
    SaveUser($email, $name, $password);
}
function TestInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }