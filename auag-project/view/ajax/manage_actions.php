<?php

$rootDoc = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');

require_once $rootDoc . '/auag-project/controller/pagecontroller/ActionShowController.php';
require_once $rootDoc . '/auag-project/database/database.php';

$request = filter_input(INPUT_GET, 'requestType');
$ActionShowController = new ActionShowController();

//Get all the members from the database
if ($request == 1) {
    $actions = $ActionShowController->getAllActions(array('*'));
    echo json_encode($actions);
} else

//update action inforamation
if ($request == 2) {
    $actionID = filter_input(INPUT_GET, 'ID');
    $actionName = filter_input(INPUT_GET, 'Name');
    $actionDescription = filter_input(INPUT_GET, 'Description');
    $actionreturncolumn = filter_input(INPUT_GET, 'ReturnColumn');

    if (!$actionID == null && !$actionName == null && !$actionDescription == null && !$actionreturncolumn == null) {
        $ActionShowController->updateAction($actionID, array(DatabaseConfig::$action_name, 
            DatabaseConfig::$action_description, DatabaseConfig::$action_returncolumn), array($actionName, $actionDescription, $actionreturncolumn));
    }

    //Query all actions
    $actions = $ActionShowController->getAllActions(array('*'));
    echo json_encode($actions);
} else
//Add new action
if ($request == 3) {
    $actionName = filter_input(INPUT_GET, 'Name');
    $actionDescription = filter_input(INPUT_GET, 'Description');
    $actionreturncolumn = filter_input(INPUT_GET, 'ReturnColumn');

    if (!$actionName == null && !$actionDescription == null && !$actionreturncolumn == null) {
        $ActionShowController->addAction(
                array(DatabaseConfig::$action_name, DatabaseConfig::$action_description,
            DatabaseConfig::$action_returncolumn), array($actionName, $actionDescription, $actionreturncolumn));
    }
    //Query all actions
    $actions = $ActionShowController->getAllActions(array('*'));
    echo json_encode($actions);
} else
//Delete action
if ($request == 4) {
    $actionID = filter_input(INPUT_GET, 'ID');

    if (!$actionID == null) {
        $ActionShowController->deleteAction($actionID);
    }

    //Query all actions
    $actions = $ActionShowController->getAllActions(array('*'));
    echo json_encode($actions);
} else

//Get all actions (with action_name only)
if ($request == 5) {
    $actions = $ActionShowController->getAllActions(array(DatabaseConfig::$action_name));

    if (count($actions) > 0) {
        $action_array;
        $i = 0;
        foreach ($actions as $action) {
            $action_array[$i] = $action[DatabaseConfig::$action_name];
            $i++;
        }
        echo json_encode($action_array);
    }
}



