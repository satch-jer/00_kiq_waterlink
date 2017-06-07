<?php

include('php/process.php');

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- bootstrap support-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link rel="stylesheet" href="css/styling.css">
    <title>Neem nu deel | Water-Link</title>
</head>

<body>

<div class="container">

    <div class="page-header">
        <img id="logo" src="assets/logo.png" alt="Water-Link">
        <h1>Win een Sodastream dankzij Water-Link</h1>
        <img id="banner" src="assets/picture.png" alt="Win een Sodastream dankzij Water-Link">
        <p>Leuk dat we jouw hebben gezien op één van onze festivals en bedankt voor jouw inschrijving.</p>
        <p>Neem nu deel aan onze wedstrijd en win dankzij Water-Link een gratis SodaStream om zelf, thuis bruisend kraantjeswater te maken in no time! Veel succes! </p>

    </div>

    </header>


    <form novalidate method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

        <div class="well well-sm">
            <h2>Wedstrijdvraag:</h2>
        </div>

        <div class="form-group">
            <label for="vraag_een">Indien je alle dagen van het jaar 1,5 liter kraantjeswater zou drinken, wat zou de kostprijs zijn?</label>
            <select class="form-control" name="vraag_een" id="vraag_een">
                <option value="" disabled selected>Weet je het? (*)</option>
                <option <?php if (test_input($_POST['vraag_een']) == '1,92') { ?>selected="true" <?php }; ?> value="1,92">€1,92</option>
                <option <?php if (test_input($_POST['vraag_een']) == '59,00') { ?>selected="true" <?php }; ?> value="59,00">€59,00</option>
                <option <?php if (test_input($_POST['vraag_een']) == '89,45') { ?>selected="true" <?php }; ?> value="89,45">€89,45</option>
                <option <?php if (test_input($_POST['vraag_een']) == '220,96') { ?>selected="true" <?php }; ?> value="220,96">€220,96</option>
                <option <?php if (test_input($_POST['vraag_een']) == '345,00') { ?>selected="true" <?php }; ?> value="345,00">€345,00</option>
            </select>
            <span class="error" id="vraag_een_error"><?= $vraag_een_error ?></span>
        </div>

        <div class="form-group">
            <label for="vraag_twee">Hoeveel mensen zullen aan deze wedstrijd deelnemen? (*)</label>
            <input class="form-control" type="text" id="vraag_twee" name="vraag_twee" placeholder="Ik weet het hoor! (*)" value="<?php echo $vraag_twee;?>">
            <span class="error" id="vraag_twee_error"><?= $vraag_twee_error ?></span>
        </div>

        <div class="well well-sm">
            <h2>Jouw gegevens:</h2>
        </div>

        <div class="form-group">
            <label for="email">E-mailadres (*)</label>
            <input class="form-control" type="email" id="email" name="email" placeholder="E-mailadres (*)" value="<?php echo $email;?>">
            <span class="error" id="email_error"><?= $email_error ?></span>
        </div>

        <div class="form-group">
            <label for="naam">Naam (*)</label>
            <input class="form-control" type="text" id="naam" name="naam" placeholder="Naam (*)" value="<?php echo $naam;?>">
            <span class="error" id="naam_error"><?= $naam_error ?></span>
        </div>

        <div class="form-group">
            <label for="voornaam">Voornaam (*)</label>
            <input class="form-control" type="text" id="voornaam" name="voornaam" placeholder="Voornaam (*)" value="<?php echo $voornaam;?>">
            <span class="error" id="voornaam_error"><?= $voornaam_error ?></span>
        </div>

        <div class="form-group">
            <label for="straat">Straat</label>
            <input class="form-control" type="text" id="straat" name="straat" placeholder="Straat" value="<?php echo $straat;?>">
            <span class="error" id="straat_error"><?= $straat_error ?></span>
        </div>
        <div class="form-group">
            <label for="huisnummer">Huisnummer</label>
            <input class="form-control" type="text" id="huisnummer" name="huisnummer" placeholder="Huisnummer" value="<?php echo $huisnummer;?>">
            <span class="error" id="huisnummer_error"><?= $huisnummer_error ?></span>
        </div>


        <div class="form-group">
            <label for="postcode">Postcode (*)</label>
            <input class="form-control" type="text" id="postcode" name="postcode" placeholder="Postcode (*)" value="<?php echo $postcode;?>">
            <span class="error" id="postcode_error"><?= $postcode_error ?></span>
        </div>

        <div class="form-group">
            <label for="stad">Stad</label>
            <input class="form-control" type="text" id="stad" name="stad" placeholder="Stad" value="<?php echo $stad;?>">
            <span class="error" id="stad_error"><?= $stad_error ?></span>
        </div>

        <div class="form-group">
            <label for="telefoonnummer">Telefoonnummer</label>
            <input class="form-control" type="text" id="telefoonnummer" name="telefoonnummer" placeholder="Telefoonnummer" value="<?php echo $telefoonnummer;?>">
            <span class="error" id="telefoonnummer_error"><?= $telefoonnummer_error ?></span>
        </div>

        <div class="form-group">
            <label for="verjaardag">Geboortedatum</label>
            <input class="form-control" type="date" id="verjaardag" name="verjaardag" value="<?php echo $verjaardag;?>">
            <span class="error" id="verjaardag_error"><?= $verjaardag_error ?></span>
        </div>

        <div id="checkboxes">
            <div class="checkbox">
                <label><input type="checkbox" name="conditions" id="conditions" value="yes">Ik aanvaard <a href="public/conditions.html">de algemene actievoorwaarden en privacy bepalingen</a> (*)</label>
                <span class="error" id="conditions_error"><?php echo $conditions_error ?></span>
            </div>

            <div class="checkbox">
                <input type="hidden" name="marketing" value="no">
                <label><input type="checkbox" name="marketing" id="marketing" value="yes">Mijn e-mailadres mag voor andere doeleinden gebruikt worden</label>
            </div>
        </div>

        <div class="form-group">
            <input id="submit" class="btn btn-default" type="submit" name="submit" value="Ja, ik doe mee!" >
            <span class="success" id="feedback_success"><?= $feedback_success ?></span>
            <span class="error" id="feedback_error"><?= $feedback_error ?></span>
        </div>
    </form>

</div>

<!-- jquery support -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>