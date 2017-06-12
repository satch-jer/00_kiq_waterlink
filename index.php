<?php

include_once('php/process.php');
include_once('php/helper.php');

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Water-Link">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- bootstrap support-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link rel="stylesheet" href="css/styling.css">
    <title>Neem nu deel | Water-Link</title>
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon" />
</head>

<body>

<!-- wrapper start -->
<div class="wrapper full">
    <header>
        <div class="jumbotron jumbotron-fluid" id="banner">
            <div class="parallax text-center" style="background-image: url(assets/waterlink.png);">
                <div class="container text-center vertical-center">
                    <div class="titles">
                        <img id="logo" src="assets/picture.png" alt="Water-Link, speel mee en win!">
                        <button id="play" class="btn-primary"><a href="#form">Speel nu mee!</a></button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="form" id="form">
        <div class="container">
            <form novalidate method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="questions">
                    <h3>Wedstrijdvraag:</h3>

                    <div class="contentform">
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="vraag_een">Indien je alle dagen van het jaar 1,5 liter kraantjeswater zou drinken, wat zou de kostprijs zijn? <span>*</span></label>
                                <select class="form-control" name="vraag_een" id="vraag_een">
                                    <option value="" disabled selected>Weet je het?</option>
                                    <option <?php if (test_input($_POST['vraag_een']) == '1,92') { ?>selected="true" <?php }; ?> value="1,92">€1,92</option>
                                    <option <?php if (test_input($_POST['vraag_een']) == '59,00') { ?>selected="true" <?php }; ?> value="59,00">€59,00</option>
                                    <option <?php if (test_input($_POST['vraag_een']) == '89,45') { ?>selected="true" <?php }; ?> value="89,45">€89,45</option>
                                    <option <?php if (test_input($_POST['vraag_een']) == '220,96') { ?>selected="true" <?php }; ?> value="220,96">€220,96</option>
                                    <option <?php if (test_input($_POST['vraag_een']) == '345,00') { ?>selected="true" <?php }; ?> value="345,00">€345,00</option>
                                </select>
                                <span class="error" id="vraag_een_error"><?= $vraag_een_error ?></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="vraag_twee">Hoeveel mensen zullen aan deze wedstrijd deelnemen? <span>*</span></label>
                                <input class="form-control" type="text" id="vraag_twee" name="vraag_twee" placeholder="Ik weet het hoor!" value="<?php echo $vraag_twee;?>">
                                <span class="error" id="vraag_twee_error"><?= $vraag_twee_error ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="info">
                    <h3>Jouw gegevens:</h3>

                    <div class="contentform">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="naam">Naam <span>*</span></label>
                                <input class="form-control" type="text" id="naam" name="naam" placeholder="Naam" value="<?php echo $naam;?>">
                                <span class="error" id="naam_error"><?= $naam_error ?></span>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="voornaam">Voornaam <span>*</span></label>
                                <input class="form-control" type="text" id="voornaam" name="voornaam" placeholder="Voornaam" value="<?php echo $voornaam;?>">
                                <span class="error" id="voornaam_error"><?= $voornaam_error ?></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="straat">Straat</label>
                                <input class="form-control" type="text" id="straat" name="straat" placeholder="Straat" value="<?php echo $straat;?>">
                                <span class="error" id="straat_error"><?= $straat_error ?></span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="huisnummer">Huisnummer</label>
                                <input class="form-control" type="text" id="huisnummer" name="huisnummer" placeholder="Huisnummer" value="<?php echo $huisnummer;?>">
                                <span class="error" id="huisnummer_error"><?= $huisnummer_error ?></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="postcode">Postcode <span>*</span></label>
                                <input class="form-control" type="text" id="postcode" name="postcode" placeholder="Postcode" value="<?php echo $postcode;?>">
                                <span class="error" id="postcode_error"><?= $postcode_error ?></span>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="stad">Stad</label>
                                <input class="form-control" type="text" id="stad" name="stad" placeholder="Stad" value="<?php echo $stad;?>">
                                <span class="error" id="stad_error"><?= $stad_error ?></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="email">E-mailadres <span>*</span></label>
                                <input class="form-control" type="email" id="email" name="email" placeholder="E-mailadres" value="<?php echo $email;?>">
                                <span class="error" id="email_error"><?= $email_error ?></span>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="telefoonnummer">Telefoonnummer</label>
                                <input class="form-control" type="text" id="telefoonnummer" name="telefoonnummer" placeholder="Telefoonnummer" value="<?php echo $telefoonnummer;?>">
                                <span class="error" id="telefoonnummer_error"><?= $telefoonnummer_error ?></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="verjaardag">Geboortedatum</label>
                                <input class="form-control" type="date" id="verjaardag" name="verjaardag" value="<?php echo $verjaardag;?>">
                                <span class="error" id="verjaardag_error"><?= $verjaardag_error ?></span>
                            </div>
                        </div>


                        <div id="checkboxes" class="row">
                            <div class="checkbox form-group col-sm-12">
                               <input type="checkbox" name="conditions" id="conditions" value="yes"> <label>Ik aanvaard <a href="public/conditions.html">de algemene actievoorwaarden en privacy bepalingen</a> <span>*</span></label>
                                <span class="error" id="conditions_error"><?php echo $conditions_error ?></span>
                            </div>

                            <div class="checkbox col-sm-12">
                                <input type="hidden" name="marketing" value="no">
                                <input type="checkbox" name="marketing" id="marketing" value="yes"><label>Mijn e-mailadres mag voor andere doeleinden gebruikt worden</label>
                            </div>
                        </div>

                        <div class="form-group" id="buttons">
                            <input id="submit" class="btn btn-default" type="submit" name="submit" value="Ja, ik doe mee!" >
                            <span class="success" id="feedback_success"><?= $feedback_success ?></span>
                            <span class="error" id="feedback_error"><?= $feedback_error ?></span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section class="footer">
        <div class="container">
            <p>© - 2017 - Spread the Water by <a href="http://www.water-link.be">Water-Link</a></p>
        </div>
    </section>
</div>

<!-- jquery support -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>