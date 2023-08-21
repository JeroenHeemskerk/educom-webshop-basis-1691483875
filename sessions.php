<?php
function LoginUser($data) {
    session_start();
    $_SESSION['name'] = $data["name"];
}
function LogoutUser() {
    session_destroy(); 
}
function IsUserLogIn() {
    if(session_status() == 2){
        return true;
    }else{
        return false;
    }
}
function getLogInUsername() {
    return $_SESSION['name'];
}
