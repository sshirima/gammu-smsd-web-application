<?php

$rootDoc = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');
require_once $rootDoc . '/auag-project/controller/pagecontroller/HomePageController.php';

$REQUEST_TYPE = filter_input(INPUT_GET, 'REQUEST_TYPE');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HomepageScript
 *
 * @author shirima
 */
class HomepageScript {
    //put your code here
}

if ($REQUEST_TYPE == 1) {
    //Check modem status

    $homePageController = new HomePageController();

    $phones = $homePageController->getPhoneDetails();

    echo $phones;
} else if ($REQUEST_TYPE == 2) {
    //Check Gammu smsd status

    $homePageController = new HomePageController();

    echo $homePageController->getGammuSmsdStatus();
} else if ($REQUEST_TYPE == 3) {
    //Check server status

    $homePageController = new HomePageController();

    $homePageController->processSMS();

    echo 0;
}