<?php 
include_once "user.service.php";
function CheckLogin() {
    $emailErr = $passwordErr  = "";
    $email = $password = $name = "";
    $loginvalid = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = AuthorizeUser($_POST['email'], $_POST['password']);
            if($user == null){
                $emailErr = "email bestaat niet in het database";
            }elseif($user == "error"){
                $passwordErr = "wachtwoord hoort niet bij deze email";
            }else{
                $name = $user["name"];
                $loginvalid = true;
                #$test = $_SESSION["name"];
            }
        }
    return array ("loginvalid"=> $loginvalid, "email" => $email, "password" => $password, 
    "emailErr" => $emailErr, "passwordErr" => $passwordErr, "name" => $name);
}

function ShowLoginForm($data) { echo '
    <form action="index.php" method="post" name="login">
        <div>
            <input type="hidden" name="page" value="login">
        </div>
        <div>
            <label class="form" for="email">email:</label>
            <input class="input" type="text" id="email" name="email" 
                value="'.(!empty($_POST["email"]) ? $_POST["email"] : '') .'">';
            echo '<span class="error">' . $data['emailErr'] . '</span>';
            echo '
        </div>
        <div>
            <label class="form" for="password">wachtwoord:</label>
            <input class="input" type="text" id="password" name="password" 
                value="'.(!empty($_POST["password"]) ? $_POST["password"] : '') .'">';
            echo '<span class="error">' . $data['passwordErr'] . '</span>';
            echo '
        </div>
        <div>
            <input type="submit" value="verstuur">
        </div>
';}