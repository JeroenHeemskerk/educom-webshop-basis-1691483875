<?php
$firstnameErr = $lastnameErr = $emailErr = $phoneErr = $comprefErr = $feedbackErr = "";
$firstname = $lastname = $email = $phone = $compref = $feedback = "";
$valid = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["Firstname"])) {
      $firstnameErr = "voornaam is verplicht";
      } else {
        $firstname = test_input($_POST["Firstname"]);
    }
    if (empty($_POST["Lastname"])) {
        $lastnameErr = "achternaam is verplicht";
      } else {
        $lastname = test_input($_POST["Lastname"]);
    }
    if (empty($_POST["Email"])) {
        $emailErr = "email is verplicht";
      } else {
        $email = test_input($_POST["Email"]);
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
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="CSS/stylesheet.css">
        <h1>Contact</h1>
    </head>
    <body>
            <ul class="menu">
                <li class="menuitem"><a href="index.html">Home</a></li>
                <li class="menuitem"><a href="about.html">About</a></li>
                <li class="menuitem"><a href="contact.php">Contact</a></li>
            </ul>
         <?php if (!$valid) {?>   
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div>
                <label for="Pref">aanhef:</label>
                <select name="Pref" id="Pref">
                    <option name="Sir" value="Meneer">Meneer</option>
                    <option name="Madam" value="Mevrouw">Mevrouw</option>
                    <option name="Nothing" value="niet">Niet</option>
                </select>
            </div>
            <div>
                <label for="Firstname">Voornaam:</label>
                <input class="input" type="text" id="Firstname" name="Firstname" 
                    value="<?php if (!empty($_POST["Firstname"])) 
                    {
                        echo $_POST["Firstname"]; 
                    }?>">
                <?php echo '<span style="color:#f00;">', $firstnameErr;?>
            </div>
            <div>
                <label for="Lastname">Achternaam:</label>
                <input class="input" type="text" id="Lastname" name="Lastname" 
                value="<?php if (!empty($_POST["Lastname"])) 
                    {
                        echo $_POST["Lastname"]; 
                    }?>">
                <?php echo '<span style="color:#f00;">', $lastnameErr;?>
            </div>
            <div>
                <label for="Email">Email:</label>
                <input class="input" type="email" id="Email" name="Email" 
                value="<?php if (!empty($_POST["Email"])) 
                    {
                        echo $_POST["Email"]; 
                    }?>">
                <?php echo '<span style="color:#f00;">', $emailErr;?>
            </div>
            <div>
                <label for="PhoneNum">Telefoonnummer:</label>
                <input class="input" type="tel" id="PhoneNum" name="PhoneNum"
                value="<?php if (!empty($_POST["PhoneNum"])) 
                    {
                        echo $_POST["PhoneNum"]; 
                    }?>">
                <?php echo '<span style="color:#f00;">', $phoneErr;?>
            </div>
            <div>
                <label for="ComPref">Op welke manier wilt u bereikt worden?</label>
                <input type="radio" id="mail" name="ComPref" value="Email" 
                    <?php if (!empty($_POST["ComPref"])) 
                        { 
                            echo ($_POST["ComPref"] =="Email")?"checked":'' ;
                        }?>>
                <label for="mail">Email</label>
                <input type="radio" id="phone" name="ComPref" value="Phone" 
                     <?php if (!empty($_POST["ComPref"])) 
                        {  
                            echo ($_POST["ComPref"] =="Phone")?"checked":'' ;
                        }?>>
                <label for="phone">Telefoon</label>
                <?php echo '<span style="color:#f00;">', $comprefErr;?>
            </div>
            <div>
                <label for="Feedback">Waarover wilt u contact opnemen?</label>
                <textarea id="Feedback" name="Feedback" rows="4" cols="50">
                    <?php if (!empty($_POST["Feedback"])) {
                        echo $_POST["Feedback"]; 
                    }?></textarea>
                <?php echo '<span style="color:#f00;">', $feedbackErr;?>
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
        <label>wij zullen onze reactie sturen naar uw </label>
        <?php if (!empty($_POST["ComPref"])) {
            echo $_POST["ComPref"];
        }?><br>
        <label>de informatie die u heeft ingevult: </label><br>
        <label>email: </label>
        <?php echo $_POST["Email"] ?><br>
        <label>telefoonnummer: </label>
        <?php echo $_POST["PhoneNum"] ?><br>
        <label>uw feedback: </label>
        <?php echo $_POST["Feedback"] ?><br>
        <?php } ?>
        <footer>
            <p>Copyright &copy; 2023 Stijn Engelmoer</p>
        </footer> 
    </body>
</html> 