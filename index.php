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
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <title>Water-Link</title>
</head>

<body>

<h1>Water-Link</h1>

<form novalidate method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div>
        <label for="vraag_een">Indien je alle dagen van het jaar 1,5 liter kraantjeswater zou drinken, wat zou de kostprijs zijn?</label>
        <select name="vraag_een" id="vraag_een">
            <option value="" disabled selected>Weet je het? (*)</option>
            <option <?php if ($_POST['vraag_een'] == '1,92') { ?>selected="true" <?php }; ?> value="1,92">€1,92</option>
            <option <?php if ($_POST['vraag_een'] == '59,00') { ?>selected="true" <?php }; ?> value="59,00">€59,00</option>
            <option <?php if ($_POST['vraag_een'] == '89,45') { ?>selected="true" <?php }; ?> value="89,45">€89,45</option>
            <option <?php if ($_POST['vraag_een'] == '220,96') { ?>selected="true" <?php }; ?> value="220,96">€220,96</option>
            <option <?php if ($_POST['vraag_een'] == '345,00') { ?>selected="true" <?php }; ?> value="345,00">€345,00</option>
        </select>
        <span class="error" id="vraag_een_error"><?= $vraag_een_error ?></span>
    </div>

    <div>
        <label for="vraag_twee">Hoeveel mensen zullen aan deze wedstrijd deelnemen? (*)</label>
        <input type="text" name="vraag_twee" placeholder="Ik weet het hoor! (*)" value="<?php echo $vraag_twee;?>">
        <span class="error" id="vraag_twee_error"><?= $vraag_twee_error ?></span>
    </div>

    <div>
        <input type="email" id="email" name="email" placeholder="E-mailadres (*)" value="<?php echo $email;?>">
        <span class="error" id="email_error"><?= $email_error ?></span>
    </div>

    <div>
        <input type="text" name="naam" placeholder="Naam (*)" value="<?php echo $naam;?>">
        <span class="error" id="naam_error"><?= $naam_error ?></span>
    </div>

    <div>
        <input type="text" name="voornaam" placeholder="Voornaam (*)" value="<?php echo $voornaam;?>">
        <span class="error" id="voornaam_error"><?= $voornaam_error ?></span>
    </div>

    <div>
        <input type="text" name="straat" placeholder="Straat" value="<?php echo $straat;?>">
        <span class="error" id="straat_error"><?= $straat_error ?></span>
    </div>

    <div>
        <input type="text" name="huisnummer" placeholder="Huisnummer" value="<?php echo $huisnummer;?>">
        <span class="error" id="huisnummer_error"><?= $huisnummer_error ?></span>
    </div>

    <div>
        <input type="text" name="postcode" placeholder="Postcode (*)" value="<?php echo $postcode;?>">
        <span class="error" id="postcode_error"><?= $postcode_error ?></span>
    </div>

    <div>
        <input type="text" name="stad" placeholder="Stad" value="<?php echo $stad;?>">
        <span class="error" id="stad_error"><?= $stad_error ?></span>
    </div>

    <div>
        <input type="text" name="telefoonnummer" placeholder="Telefoonnummer" value="<?php echo $telefoonnummer;?>">
        <span class="error" id="telefoonnummer_error"><?= $telefoonnummer_error ?></span>
    </div>

    <div>
        <input type="date" naam="verjaardag" value="<?php echo $verjaardag;?>">
        <span class="error" id="verjaardag_error"><?= $verjaardag_error ?></span>
    </div>

    <div>
        <input type="submit" name="submit" value="Ja, ik wil een SodaStream ontvangen!" >
        <span class="success" id="feedback_success"><?= $feedback_success ?></span>
        <span class="error" id="feedback_error"><?= $feedback_error ?></span>
    </div>
</form>

<!-- jquery support -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>