<?php 
include_once "user.service.php";
function CheckRegister() {
    $nameErr = $emailErr = $passwordErr = $passwordcheckErr = "";
    $name = TestInput(getPostVar('name'));
    $email = TestInput(getPostVar('email'));
    $password = TestInput(getPostVar('password'));
    $passwordcheck = TestInput(getPostVar('passwordcheck'));
    $registervalid = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($name)) {
            $nameErr = "naam is verplicht";
        } else {
            if (!ctype_alpha($name)) {
                $nameErr = "nummers in je naam zijn niet toegstaan";
            }
        }
        if (empty($email)) {
            $emailErr = "email is verplicht";
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "je moet een echt emailadres invullen";
            }
        }
        if (empty($password)) {
            $passwordErr = "wachtwoord is verplicht";
        } else if (empty($passwordcheck)) {
                $passwordcheckErr = "herhaal wachtwoord is verplicht";
            } else if ($password != $passwordcheck) {
                    $passwordErr = $passwordcheckErr = "wachtwoorden moeten hetzelfde zijn";
                }
        if (empty($nameErr) && empty($emailErr) && empty($passwordErr) && empty($passwordcheckErr)) {
                if(DoesEmailExist($email) == false){
                    $registervalid = true;
                }else {
                    $emailErr = "de email bestaat al";
                }
        }
    }

    return array ("registervalid"=> $registervalid, "name" => $name, "email" => $email, "password" => $password, "passwordcheck" => $passwordcheck, 
    "nameErr" => $nameErr, "emailErr" => $emailErr, "passwordErr" => $passwordErr, "passwordcheckErr" => $passwordcheckErr);
}

function ShowRegisterForm($data) { echo '
    <form action="index.php" method="post" name="register">
        <div>
            <input type="hidden" name="page" value="register">
        </div>
        <div>
            <label class="form" for="name">naam:</label>
            <input class="input" type="text" id="name" name="name" 
                value="'.(!empty($data["name"]) ? $data["name"] : '') .'">';
            echo '<span class="error">' . $data['nameErr'] . '</span>';
            echo '
        </div>
        <div>
            <label class="form" for="email">email:</label>
            <input class="input" type="text" id="email" name="email" 
                value="'.(!empty($data["email"]) ? $data["email"] : '') .'">';
            echo '<span class="error">' . $data['emailErr'] . '</span>';
            echo '
        </div>
        <div>
            <label class="form" for="password">wachtwoord:</label>
            <input class="input" type="text" id="password" name="password" 
                value="'.(!empty($data["password"]) ? $data["password"] : '') .'">';
            echo '<span class="error">' . $data['passwordErr'] . '</span>';
            echo '
        </div>
        <div>
            <label class="form" for="passwordcheck">herhaal wachtwoord:</label>
            <input class="input" type="text" id="passwordcheck" name="passwordcheck" 
                value="'.(!empty($data["passwordcheck"]) ? $data["passwordcheck"] : '') .'">';
            echo '<span class="error">' . $data['passwordcheckErr'] . '</span>';
            echo '
        </div>
        <div>
            <input type="submit" value="verstuur">
        </div>
';}