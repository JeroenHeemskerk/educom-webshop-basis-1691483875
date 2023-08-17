<?php 
function CheckRegister() {
    $nameErr = $emailErr = $passwordErr = $passwordcheckErr = "";
    $name = $email = $password = $passwordcheck = "";
    $valid = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "naam is verplicht";
        } else {
            if (ctype_alpha($_POST["name"])) {
                $name = test_input($_POST["name"]);
            } else {
                $nameErr = "nummers in je naam zijn niet toegstaan";
            }
        }
        if (empty($_POST["email"])) {
            $emailErr = "email is verplicht";
        } else {
            if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $email = test_input($_POST["email"]);
            } else {
                $emailErr = "je moet een echt emailadres invullen";
            }
        }
        if (empty($_POST["password"])) {
            $passwordErr = "wachtwoord is verplicht";
        } else if (empty($_POST["passwordcheck"])) {
                $passwordcheckErr = "herhaal wachtwoord is verplicht";
            } else if ($_POST["password"] != $_POST["passwordcheck"]) {
                    $passwordErr = "wachtwoorden moeten hetzelfde zijn";
                    $passwordcheckErr = "wachtwoorden moeten hetzelfde zijn";
                } else {
                    $password = test_input($_POST["password"]);
                    $passwordcheck = test_input($_POST["password"]);
                }
        if (!empty($name) && !empty($email) && !empty($password) && !empty($passwordcheck)) {
            $myfile = fopen("users/users.txt", "a");
                $filecontent = file_get_contents("users/users.txt");
                if(strpos($filecontent, $email) == false){
                    $valid = true;
                    $txt = "\n$email|$name|$password";
                    fwrite($myfile, $txt);
                }else {
                    $emailErr = "de email bestaat al";
                }
            fclose($myfile);
        }
    }

    return array ("valid"=> $valid, "name" => $name, "email" => $email, "password" => $password, "passwordcheck" => $passwordcheck, 
    "nameErr" => $nameErr, "emailErr" => $emailErr, "passwordErr" => $passwordErr, "passwordcheckErr" => $passwordcheckErr);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function ShowRegisterForm($data) { echo '
    <form action="index.php" method="post" name="register">
        <div>
            <input type="hidden" name="page" value="register">
        </div>
        <div>
            <label class="form" for="name">naam:</label>
            <input class="input" type="text" id="name" name="name" 
                value="'.(!empty($_POST["name"]) ? $_POST["name"] : '') .'">';
            echo '<span class="error">' . $data['nameErr'] . '</span>';
            echo '
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
            <label class="form" for="passwordcheck">herhaal wachtwoord:</label>
            <input class="input" type="text" id="passwordcheck" name="passwordcheck" 
                value="'.(!empty($_POST["passwordcheck"]) ? $_POST["passwordcheck"] : '') .'">';
            echo '<span class="error">' . $data['passwordcheckErr'] . '</span>';
            echo '
        </div>
        <div>
            <input type="submit" value="verstuur">
        </div>
';}