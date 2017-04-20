<?php

$rootDoc = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');

require_once $rootDoc . '/auag-project/controller/pagecontroller/SmsCommandsController.php';
require_once $rootDoc . '/auag-project/controller/pagecontroller/ActionShowController.php';
require_once $rootDoc . '/auag-project/database/database.php';

$request = filter_input(INPUT_GET, 'requestType');
$CommandController = new SmsCommandsController();
$ActionController = new ActionShowController();

//Process get all commands request
if ($request == 1) {
    $commands = $CommandController->getAllCommands();
    echo json_encode($commands);
    
} else
    
//Process update command request
if ($request == 2) {
    //Get all the parameters
    $cmdId = filter_input(INPUT_GET, 'ID');
    $cmdName = filter_input(INPUT_GET, 'Name');
    $cmdDescription = filter_input(INPUT_GET, 'Description');
    $cmdAction = filter_input(INPUT_GET, 'Action');

    //Update the command
    if (!$cmdId == null && !$cmdName == null && !$cmdDescription == null) {

        $CommandController->updateCommand($cmdId, array(DatabaseConfig::$commands_keyword,
            DatabaseConfig::$commands_description, DatabaseConfig::$commands_action), 
                array($cmdName, $cmdDescription, $cmdAction));
    }
    //Query all commands
    $commands = $CommandController->getAllCommands();
    echo json_encode($commands);
    
} else
//Process add command request
if ($request == 3) {
    //Get all the parameters
    $cmdName = filter_input(INPUT_GET, 'Name');
    $cmdDescription = filter_input(INPUT_GET, 'Description');
    $cmdAction = filter_input(INPUT_GET, 'Action');
    
    //Update the command
    if (!$cmdName == null && !$cmdDescription == null) {
        $CommandController->addCommand(array(DatabaseConfig::$commands_keyword,
            DatabaseConfig::$commands_description,DatabaseConfig::$commands_action), 
                array($cmdName, $cmdDescription, $cmdAction));
    }
    //Query all commands
    $commands = $CommandController->getAllCommands();
    echo json_encode($commands);
    
} else
//Process delete command request
if ($request == 4) {
    //Get all the parameters
    $cmdId = filter_input(INPUT_GET, 'ID');

    //Update the command
    if (!$cmdId == null) {
        $CommandController->deleteCommand($cmdId);
    }
    //Query all commands
    $commands = $CommandController->getAllCommands();
    echo json_encode($commands);
    
}



