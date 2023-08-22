<?php
function FindUserByEmail($email){
    $myfile = fopen("users/users.txt", "r");
        while(!feof($myfile)){
            $line = fgets($myfile);
            $parts = explode('|', $line);
            if($parts[0] == $email){
                return array("email" => $parts[0], "name" => $parts[1], "password" => trim($parts[2]));
            }
        }
    return null;
}
function SaveUser($email, $name, $password){
    $myfile = fopen("users/users.txt", "a");
    $txt = "\n$email|$name|$password";
    fwrite($myfile, $txt);
    fclose($myfile);
}