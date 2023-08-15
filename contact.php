<?php
function ShowCheckContent() {
    $firstnameErr = $lastnameErr = $emailErr = $phoneErr = $comprefErr = $feedbackErr = $prefErr = "";
    $firstname = $lastname = $email = $phone = $compref = $feedback = $pref = "";
    $valid = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["Pref"])) {
            $prefErr = "aanhef is verplicht";
        } else {
            $pref = test_input($_POST["Pref"]);
        }
        if (empty($_POST["Firstname"])) {
            $firstnameErr = "voornaam is verplicht";
        } else {
            if (ctype_alpha($_POST["Firstname"])) {
                $firstname = test_input($_POST["Firstname"]);
            } else {
                $firstnameErr = "nummers in je naam zijn niet toegstaan";
            }
        }
        if (empty($_POST["Lastname"])) {
            $lastnameErr = "achternaam is verplicht";
        } else {
            if (ctype_alpha($_POST["Lastname"])) {
                $lastname = test_input($_POST["Lastname"]);
            } else {
                $lastnameErr = "nummers in je naam zijn niet toegstaan";
            } 
        }
        if (empty($_POST["Email"])) {
            $emailErr = "email is verplicht";
        } else {
            if (filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL)) {
                $email = test_input($_POST["Email"]);
            } else {
                $emailErr = "je moet een echt emailadres invullen";
            }
        }
        if (empty($_POST["PhoneNum"])) {
            $phoneErr = "telefoonnummer is verplicht";
        } else {
            $phone = test_input($_POST["PhoneNum"]);
        }
        if (empty($_POST["ComPref"])) {
            $comprefErr = "keuze is verplicht";
        } else {
            $compref = test_input($_POST["ComPref"]);
        }
        if (empty($_POST["Feedback"])) {
            $feedbackErr = "feedback is verplicht";
        } else {
            $feedback = test_input($_POST["Feedback"]);
        }
        if (!empty($firstname) && !empty($lastname) && !empty($email) && !empty($phone) && !empty($compref) && !empty($feedback)) {
            $valid = true;
        }
    }
    return array ("valid"=> $valid, "firstname" => $firstname, "lastname" => $lastname, "email" => $email, "phone" => $phone,
     "compref" => $compref, "feedback" => $feedback, "pref" => $pref, "firstnameErr" => $firstnameErr, "lastnameErr" => $lastnameErr, 
     "emailErr" => $emailErr, "phoneErr" => $phoneErr, "comprefErr" => $comprefErr, "feedbackErr" => $feedbackErr, "prefErr" => $prefErr,);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
    function ShowFormContent($data) {echo '   
        <form action="index.php" method="post">
            <div>
                <label class="form" for="Pref">aanhef:</label>
                <select name="Pref" id="Pref">
                    <option name="choice" value="">maak uw keuze</option>
                    <option name="Sir" value="Meneer" '; 
                    if (!empty($_POST["Pref"]) && $_POST['Pref'] == "Meneer") echo 'selected="selected" '; 
                    echo '>Meneer</option>
                    <option name="Madam" value="Mevrouw" ' . (!empty($_POST["Pref"]) && $_POST['Pref'] == "Mevrouw" ? 'selected="selected"' : '') .'>Mevrouw</option>
                    <option name="Nothing" value="Niet" ' . (!empty($_POST["Pref"]) && $_POST['Pref'] == "Niet" ? 'selected="selected"' : '') .'>Niet</option>
                </select>';
                echo '<span class="error">' . $data['prefErr'] . '</span>';
                echo '
            </div>
            <div>
                <label class="form" for="Firstname">Voornaam:</label>
                <input class="input" type="text" id="Firstname" name="Firstname" 
                    value="'.(!empty($_POST["Firstname"]) ? $_POST["Firstname"] : '') .'">';
                echo '<span class="error">' . $data['firstnameErr'] . '</span>';
                echo '
            </div>
            <div>
                <label class="form" for="Lastname">Achternaam:</label>
                <input class="input" type="text" id="Lastname" name="Lastname" 
                    value="'.(!empty($_POST["Lastname"]) ? $_POST["Lastname"] : '') .'">';
                echo '<span class="error">' . $data['lastnameErr'] . '</span>';
                echo '
            </div>
            <div>
                <label class="form" for="Email">Email:</label>
                <input class="input" type="email" id="Email" name="Email" 
                    value="' .(!empty($_POST["Email"]) ? $_POST["Email"] : '') .' ">';
                echo '<span class="error">' . $data['emailErr'] . '</span>';
                echo '
            </div>
            <div>
                <label class="form" for="PhoneNum">Telefoonnummer:</label>
                <input class="input" type="tel" id="PhoneNum" name="PhoneNum"
                    value="'.(!empty($_POST["PhoneNum"]) ? $_POST["PhoneNum"] : '') .'">';
                echo '<span class="error">' . $data['phoneErr'] . '</span>';
                echo '
            </div>
            <div>
                <label class="form" for="ComPref">Op welke manier wilt u bereikt worden?</label>
                <input type="radio" id="mail" name="ComPref" value="Email"';
                    if (!empty($_POST["ComPref"])) echo ($_POST["ComPref"] =="Email")?"checked":'' ;
                echo '>
                <label  for="mail">Email</label>
                <input type="radio" id="phone" name="ComPref" value="Telefoon" ';
                    if (!empty($_POST["ComPref"])) echo ($_POST["ComPref"] =="Phone")?"checked":'' ;
                echo '>
                <label  for="phone">Telefoon</label>';
                echo '<span class="error">' . $data['comprefErr'] . '</span>';
                echo '
            </div>
            <div>
                <label class="form" for="Feedback">Waarover wilt u contact opnemen?</label>
                <textarea id="Feedback" name="Feedback" rows="4" cols="50">'.
                (!empty($_POST["Feedback"]) ? $_POST["Feedback"] : '') . '</textarea>';
                echo '<span class="error">' . $data['feedbackErr'] . '</span>';
                echo '
            </div>
            <div>
                <input type="submit" value="verstuur">
            </div>
        </form>
    ';}
    function ShowThanksContent($data) { echo '
        <label>Beste </label>';
        echo $data["pref"];
        echo $_POST["Firstname"];
        echo $_POST["Lastname"]; 
        echo '<br>
        <label>Bedankt voor het invullen van onze contact formulier.</label><br>
        <label>Wij zullen onze reactie sturen naar uw </label>'
        .(!empty($_POST["ComPref"]) ? $_POST["ComPref"] : '');
        echo '<br>
        <label>De informatie die u heeft ingevult: </label><br>
        <label>Email: </label>';
        echo $_POST["Email"];
        echo '<br>
        <label>Telefoonnummer: </label>';
        echo $_POST["PhoneNum"]; 
        echo '<br>
        <label>Uw feedback: </label>';
        echo $_POST["Feedback"]; echo '<br>
    ';}