<?php
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
            $firstnameErr = "je mag geen nummer hebben in je naam";
        }
    }
    if (empty($_POST["Lastname"])) {
        $lastnameErr = "achternaam is verplicht";
      } else {
        if (ctype_alpha($_POST["Lastname"])) {
            $lastname = test_input($_POST["Lastname"]);
        } else {
            $lastnameErr = "je mag geen nummer hebben in je naam";
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
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
    if (!$valid) {?>   
        <form action="index.php" method="post">
            <div>
                <label class="form" for="Pref">aanhef:</label>
                <select name="Pref" id="Pref">
                    <option name="choice" value="">maak uw keuze</option>
                    <option name="Sir" value="Meneer" <?php if (!empty($_POST["Pref"]) && $_POST['Pref'] == "Meneer") echo 'selected="selected" '; ?>>Meneer</option>
                    <option name="Madam" value="Mevrouw" <?php if (!empty($_POST["Pref"]) && $_POST['Pref'] == "Mevrouw") echo 'selected="selected" '; ?>>Mevrouw</option>
                    <option name="Nothing" value="Niet" <?php if (!empty($_POST["Pref"]) && $_POST['Pref'] == "Niet") echo 'selected="selected" '; ?>>Niet</option>
                </select>
                <?php echo '<span class="error">' . $prefErr . '</span>';?>
            </div>
            <div>
                <label class="form" for="Firstname">Voornaam:</label>
                <input class="input" type="text" id="Firstname" name="Firstname" 
                    value="<?php if (!empty($_POST["Firstname"])){
                        echo $_POST["Firstname"]; 
                    }?>">
                <?php echo '<span class="error">' . $firstnameErr . '</span>';?>
            </div>
            <div>
                <label class="form" for="Lastname">Achternaam:</label>
                <input class="input" type="text" id="Lastname" name="Lastname" 
                    value="<?php if (!empty($_POST["Lastname"])){
                        echo $_POST["Lastname"]; 
                    }?>">
                <?php echo '<span class="error">' . $lastnameErr . '</span>';?>
            </div>
            <div>
                <label class="form" for="Email">Email:</label>
                <input class="input" type="email" id="Email" name="Email" 
                    value="<?php if (!empty($_POST["Email"])){
                        echo $_POST["Email"]; 
                    }?>">
                <?php echo '<span class="error">' . $emailErr . '</span>';?>
            </div>
            <div>
                <label class="form" for="PhoneNum">Telefoonnummer:</label>
                <input class="input" type="tel" id="PhoneNum" name="PhoneNum"
                    value="<?php if (!empty($_POST["PhoneNum"])){
                        echo $_POST["PhoneNum"]; 
                    }?>">
                <?php echo '<span class="error">' . $phoneErr . '</span>';?>
            </div>
            <div>
                <label class="form" for="ComPref">Op welke manier wilt u bereikt worden?</label>
                <input type="radio" id="mail" name="ComPref" value="Email" 
                    <?php if (!empty($_POST["ComPref"])){ 
                            echo ($_POST["ComPref"] =="Email")?"checked":'' ;
                    }?>>
                <label  for="mail">Email</label>
                <input type="radio" id="phone" name="ComPref" value="Telefoon" 
                    <?php if (!empty($_POST["ComPref"])) 
                        {  
                            echo ($_POST["ComPref"] =="Phone")?"checked":'' ;
                    }?>>
                <label  for="phone">Telefoon</label>
                <?php echo '<span class="error">' . $comprefErr . '</span>';?>
            </div>
            <div>
                <label class="form" for="Feedback">Waarover wilt u contact opnemen?</label>
                <textarea id="Feedback" name="Feedback" rows="4" cols="50"><?php 
                if (!empty($_POST["Feedback"])) {
                    echo $_POST["Feedback"];
                    }?></textarea>
                <?php echo '<span class="error">' . $feedbackErr . '</span>';?>
            </div>
            <div>
                <input type="submit" value="verstuur">
            </div>
        </form> 
        <?php } else { ?>
        <label>Beste </label>
        <?php echo $_POST["Pref"] ?>
        <?php echo $_POST["Firstname"] ?>
        <?php echo $_POST["Lastname"] ?><br>
        <label>Bedankt voor het invullen van onze contact formulier.</label><br>
        <label>Wij zullen onze reactie sturen naar uw </label>
        <?php if (!empty($_POST["ComPref"])) {
            echo $_POST["ComPref"];
        }?><br>
        <label>De informatie die u heeft ingevult: </label><br>
        <label>Email: </label>
        <?php echo $_POST["Email"] ?><br>
        <label>Telefoonnummer: </label>
        <?php echo $_POST["PhoneNum"] ?><br>
        <label>Uw feedback: </label>
        <?php echo $_POST["Feedback"] ?><br>
        <?php } ?>