<?php
include_once "user.service.php";
function ValidateContact() {
    $firstnameErr = $lastnameErr = $emailErr = $phoneErr = $comprefErr = $feedbackErr = $prefErr = "";
    $pref = TestInput(getPostVar('Pref'));
    $firstname = TestInput(getPostVar('Firstname'));
    $lastname = TestInput(getPostVar('Lastname'));
    $email = TestInput(getPostVar('Email'));
    $phone = TestInput(getPostVar('PhoneNum'));
    $compref = TestInput(getPostVar('ComPref'));
    $feedback = TestInput(getPostVar('Feedback'));
    $valid = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($pref)) {
            $prefErr = "aanhef is verplicht";
        } else {
            $pref = TestInput($pref);
        }
        if (empty($firstname)) {
            $firstnameErr = "voornaam is verplicht";
        } else {
            if (!ctype_alpha($firstname)) {
                $firstnameErr = "nummers in je naam zijn niet toegstaan";
            }
        }
        if (empty($lastname)) {
            $lastnameErr = "achternaam is verplicht";
        } else {
            if (!ctype_alpha($lastname)) {
                $lastnameErr = "nummers in je naam zijn niet toegstaan";
            } 
        }
        if (empty($email)) {
            $emailErr = "email is verplicht";
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "je moet een echt emailadres invullen";
            }
        }
        if (empty($phone)) {
            $phoneErr = "telefoonnummer is verplicht";
        }
        if (empty($compref)) {
            $comprefErr = "keuze is verplicht";
        }
        if (empty($feedback)) {
            $feedbackErr = "feedback is verplicht";
        }
        if (!empty($firstname) && !empty($lastname) && !empty($email) && !empty($phone) && !empty($compref) && !empty($feedback)) {
            $valid = true;
        }
    }
    return array ("valid"=> $valid, "firstname" => $firstname, "lastname" => $lastname, "email" => $email, "phone" => $phone,
     "compref" => $compref, "feedback" => $feedback, "pref" => $pref, "firstnameErr" => $firstnameErr, "lastnameErr" => $lastnameErr, 
     "emailErr" => $emailErr, "phoneErr" => $phoneErr, "comprefErr" => $comprefErr, "feedbackErr" => $feedbackErr, "prefErr" => $prefErr,);
}
    function ShowFormContent($data) {echo '   
        <form action="index.php" method="post">
            <div>
                <input type="hidden" name="page" value="contact">
            </div>
            <div>
                <label class="form" for="Pref">aanhef:</label>
                <select name="Pref" id="Pref">
                    <option name="choice" value="">maak uw keuze</option>
                    <option name="Sir" value="Meneer" '; 
                    if ($data['pref'] == "Meneer") echo 'selected="selected" '; 
                    echo '>Meneer</option>
                    <option name="Madam" value="Mevrouw" ' . ($data["pref"] == "Mevrouw" ? 'selected="selected"' : '') .'>Mevrouw</option>
                    <option name="Nothing" value="Niet" ' . ($data["pref"] == "Niet" ? 'selected="selected"' : '') .'>Niet</option>
                </select>';
                echo '<span class="error">' . $data['prefErr'] . '</span>';
                echo '
            </div>
            <div>
                <label class="form" for="Firstname">Voornaam:</label>
                <input class="input" type="text" id="Firstname" name="Firstname" 
                    value="'.($data["firstname"]) .'">';
                echo '<span class="error">' . $data['firstnameErr'] . '</span>';
                echo '
            </div>
            <div>
                <label class="form" for="Lastname">Achternaam:</label>
                <input class="input" type="text" id="Lastname" name="Lastname" 
                    value="'.($data["lastname"]) .'">';
                echo '<span class="error">' . $data['lastnameErr'] . '</span>';
                echo '
            </div>
            <div>
                <label class="form" for="Email">Email:</label>
                <input class="input" type="email" id="Email" name="Email" 
                    value="' .($data["email"]) .' ">';
                echo '<span class="error">' . $data['emailErr'] . '</span>';
                echo '
            </div>
            <div>
                <label class="form" for="PhoneNum">Telefoonnummer:</label>
                <input class="input" type="tel" id="PhoneNum" name="PhoneNum"
                    value="'.($data["phone"]) .'">';
                echo '<span class="error">' . $data['phoneErr'] . '</span>';
                echo '
            </div>
            <div>
                <label class="form" for="ComPref">Op welke manier wilt u bereikt worden?</label>
                <input type="radio" id="mail" name="ComPref" value="Email"';
                    if ($data["compref"]) echo ($data["compref"] =="Email")?"checked":'' ;
                echo '>
                <label  for="mail">Email</label>
                <input type="radio" id="phone" name="ComPref" value="Telefoon" ';
                    if ($data["compref"]) echo ($data["compref"] =="Telefoon")?"checked":'' ;
                echo '>
                <label  for="phone">Telefoon</label>';
                echo '<span class="error">' . $data['comprefErr'] . '</span>';
                echo '
            </div>
            <div>
                <label class="form" for="Feedback">Waarover wilt u contact opnemen?</label>
                <textarea id="Feedback" name="Feedback" rows="4" cols="50">'.
                ($data["feedback"]) . '</textarea>';
                echo '<span class="error">' . $data['feedbackErr'] . '</span>';
                echo '
            </div>
            <div>
                <input type="submit" value="verstuur">
            </div>
        </form>
    ';}
    function ShowThanksContent($data) { echo '
        <a>Beste </a>';
        echo $data["pref"];
        echo $data["firstname"];
        echo $data["lastname"]; 
        echo '<br>
        <a>Bedankt voor het invullen van onze contact formulier.</a><br>
        <a>Wij zullen onze reactie sturen naar uw </a>'
        .(!empty($data["ComPref"]) ? $data["ComPref"] : '');
        echo '<br>
        <a>De informatie die u heeft ingevult: </a><br>
        <a>Email: </a>';
        echo $data["email"];
        echo '<br>
        <a>Telefoonnummer: </a>';
        echo $data["phone"]; 
        echo '<br>
        <a>Uw feedback: </a>';
        echo $data["feedback"]; echo '<br>
    ';}