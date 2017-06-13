<?php

//includes
include_once 'classes/Mailin.php';
include_once 'classes/Player.php';
include_once 'helper.php';

//vars
$vraag_een = $vraag_twee = $naam = $voornaam = $straat = $huisnummer = $postcode = $stad = $telefoonnummer = $verjaardag = $email = $conditions = $marketing = "";
$feedback_success = $feedback_error = "";

//get mail
$email = test_input($_GET['mail']);

//array with errors
$errors = [];

//form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //=== create player object ===
    $player = new Player();

    //=== required fields ====

    //vraag_een
    if(empty($_POST["vraag_een"])){
        $errors["vraag_een"] = "Je moet wel antwoorden om te kunnen winnen ...";
    }else{
        $vraag_een = test_input($_POST["vraag_een"]);
    }

    //vraag_twee
    if(empty($_POST["vraag_twee"])){
        $errors["vraag_twee"] = "Doe een gokje!";
    }else{
        $vraag_twee = test_input($_POST["vraag_twee"]);
        if (!filter_var($vraag_twee, FILTER_VALIDATE_INT) || strlen($vraag_twee) > 10) {
            $errors["vraag_twee"] = "Het antwoord moet een cijfer van maximaal 10 karakters zijn.";
        }
    }

    //email
    if (empty($_POST["email"])) {
        $errors["email"] = "Hoe kunnen we je anders laten weten dat je gewonnen hebt?";
    } else {
        $email = test_input($_POST["email"]);
        //check if users enters a valid emailaddress
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email > 255)) {
            $errors["email"] = "Dit e-mailadres is niet geldig.";
        } else if(empty($player->exist($email))){
            $errors["email"] = "Dit e-mailadres is ons niet gekend, je kan niet deelnemen.";
        }
        //check if user can still participate
        else if ($player->expirationDate($email) < date("Y-m-d")){
            $errors["email"] = "De wedstrijd is ondertussen afgelopen, je kan niet meer deelnemen.";
        }
        //check if user hasn't participated yet
        else if(!empty($player->participated($email))){
            $errors["email"] = "Je hebt reeds deelgenomen, nog even geduld.";
        }
    }

    //naam
    if (empty($_POST["naam"])) {
        $errors["naam"] = "Wij kennen graag jouw naam.";
    } else {
        $naam = test_input($_POST["naam"]);
        //check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u",$naam) || strlen($naam > 255)) {
            $errors["naam"] = "Een naam kan enkel letters en spaties bevatten.";
        }
    }

    //voornaam
    if (empty($_POST["voornaam"])) {
        $errors["voornaam"] = "Wij kennen graag jouw voornaam.";
    } else {
        $voornaam = test_input($_POST["voornaam"]);
        //check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u",$voornaam) || strlen($voornaam > 255)) {
            $errors["voornaam"] = "Een voornaam kan enkel letters en spaties bevatten.";
        }
    }

    //postcode
    if (empty($_POST["postcode"])) {
        $errors["postcode"] = "Postcode is een verplicht veld.";
    } else {
        $postcode = test_input($_POST["postcode"]);
        //check if postal code is an integer of 4 digits
        if (!filter_var($postcode, FILTER_VALIDATE_INT) || strlen($postcode) > 4 || strlen($postcode) < 4) {
            $errors["postcode"] = "Een postcode moet uit 4 cijfers bestaan.";
        }
    }

    //conditions
    if(isset($_POST['conditions']) && $_POST['conditions'] == 'yes') {
        $conditions = $_POST['conditions'];
    } else {
        $errors['conditions'] = "Gelieve de algemene voorwaarden te accepteren";
    }

    //=== optional fields ===

    //straat
    if(!empty($_POST["straat"])){
        $straat = test_input($_POST["straat"]);
        if(strlen($straat) > 100){
            $errors["straat"] = "De opgegeven straatnaam is wel wat lang ...";
        }
    }

    //huisnummer
    if(!empty($_POST["huisnummer"])){
        $huisnummer = test_input($_POST["huisnummer"]);
        if(strlen($huisnummer) > 8){
            $errors["huisnummer"] = "De opgegeven huisnummer is wel wat lang ...";
        }
    }

    //stad
    if(!empty($_POST["stad"])){
        $stad = test_input($_POST["stad"]);
        if(!preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u",$stad) || strlen($stad) > 100){
            $errors["stad"] = "Een stadsnaam kan enkel letters en spaties bevatten ...";
        }
    }

    //telefoonnummer
    if(!empty($_POST["telefoonnummer"])){
        $telefoonnummer = test_input($_POST["telefoonnummer"]);
        if(!preg_match('/^[0-9]+$/', $telefoonnummer) || strlen($telefoonnummer) < 8 ||strlen($telefoonnummer) > 14){
            $errors["telefoonnummer"] = "Een telefoonnummer mag enkel uit cijfers bestaan en moet tussen de 8 en de 12 cijfers bevatten.";
        }
    }

    //verjaardag
    if(!empty($_POST["verjaardag"])){
        $verjaardag = test_input($_POST["verjaardag"]);

        if(!validateAge($verjaardag)){
            $errors["verjaardag"] = "Je moet minimum 12 jaar zijn om te mogen deelnemen, sorry.";
        }
    }

    //marketing
    $marketing = test_input($_POST["marketing"]);

    //if all the errors are empty, only then send the message
    if(count($errors) > 0){
        //if ajax request
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            echo json_encode($errors);
            exit();
        }
        //no ajax, just use php form submission
        foreach ($errors as $key => $value) {
            ${$key . '_error'} = $value;
        }
    }else{
        if(sendMail($email)){
            $player->lastname = $naam;
            $player->firstname = $voornaam;
            $player->street = $straat;
            $player->housenumber = $huisnummer;
            $player->postal = $postcode;
            $player->city = $stad;
            $player->phone = $telefoonnummer;
            $player->birthday = $verjaardag;
            $player->question_1 = $vraag_een;
            $player->question_2 = $vraag_twee;
            $player->conditions = $conditions;
            $player->marketing = $marketing;

            //if ajax request
            if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
                if($player->updatePlayer($email)) {
                    echo json_encode('true');
                }else{
                    echo json_encode('false');
                }
                exit();
            }

            //update player in db
            if($player->updatePlayer($email)){
                $feedback_success = "Woehoew, deelname voltooid! We hebben jou zonet een e-mail gestuurd met het juiste antwoord.";
            }else{
                $feedback_error = "Er ging iets mis met het opslaan van de gebruiker in de databank, probeer later opnieuw.";
            }
        }else{
            //if ajax request
            if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                echo json_encode('false');
                exit();
            }

            $feedback_error = "Er ging iets mis tijdens je deelname, probeer later opnieuw.";
        }
    }
}

//function that sends email to selected email-address
function sendMail($recipient){
    //create new mailin object
    $mailin = new Mailin('https://api.sendinblue.com/v2.0', 'gFfSEwGJ3MsWv7YP');

    //send mail
    $data = array("id" => 6,
        "to" => $recipient,
    );

    //send mail
    if($mailin->send_transactional_template($data)){
        return true;
    }else{
        return false;
    }
}