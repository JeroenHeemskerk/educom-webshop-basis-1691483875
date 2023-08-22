<?php
session_start();
function LoginUser($data) {
    $_SESSION['name'] = $data["name"];
}
function LogoutUser() {
    session_unset();
    session_destroy();
}
function IsUserLogIn() {
    if(!empty($_SESSION['name'])){
        return true;
    }else{
        return false;
    }
}
function getLogInUsername() {
    return $_SESSION['name'];
}
