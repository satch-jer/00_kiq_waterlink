<?php

/*
 *
 * php function to check if email can participate
 *
 */

//includes
include_once 'classes/Player.php';
include_once 'helper.php';

//create new player object
$player = new Player();

//get value + test
$email = test_input($_POST["email"]);

if(empty($player->exist($email))){
    $error = "Dit e-mailadres is ons niet gekend, je kan niet deelnemen.";
}
//check if user can still participate
else if ($player->expirationDate($email) < date("Y-m-d")){
    $error = "De wedstrijd is ondertussen afgelopen, je kan niet meer deelnemen.";
}
//check if user hasn't participated yet
else if(!empty($player->participated($email))){
    $error = "Je hebt reeds deelgenomen, nog even geduld.";
}

echo json_encode($error);