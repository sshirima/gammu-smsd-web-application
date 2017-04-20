<?php
$rootDoc = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');

require_once $rootDoc . '/auag-project/controller/pagecontroller/MemberShowController.php';
require_once $rootDoc . '/auag-project/database/database.php';

$request = filter_input(INPUT_GET, 'requestType');
$MemberShowController = new MemberShowController();

//Get all the members from the database
if ($request == 1) {
    $members = $MemberShowController->getAllMembers();
    echo json_encode($members);
}else
    //update member inforamation
if ($request == 2) {
    $ID = filter_input(INPUT_GET, 'ID');
    $firstname = filter_input(INPUT_GET, 'Firstname');
    $lastname = filter_input(INPUT_GET, 'Lastname');
    $phonenumber = filter_input(INPUT_GET, 'PhoneNumber');
    $shares = filter_input(INPUT_GET, 'Shares');
    $jamii = filter_input(INPUT_GET, 'PendingJamii');
    $fines = filter_input(INPUT_GET, 'PendingFine');
    $NOR_date = filter_input(INPUT_GET, 'NOR_Date');
    
    if (!empty($ID) && !empty($firstname) && !empty($lastname) 
            && !empty($phonenumber)){
        $resp = $MemberShowController->updateMember($ID, 
                array(DatabaseConfig::$members_phonenumber, DatabaseConfig::$members_firstname, DatabaseConfig::$members_lastname,
                DatabaseConfig::$members_shares, DatabaseConfig::$members_pending_jamii,
                DatabaseConfig::$members_pending_fines, DatabaseConfig::$members_NOR_date),
                array($phonenumber, $firstname, $lastname, $shares, $jamii, $fines, $NOR_date));
        
    }
    $members = $MemberShowController->getAllMembers();
    echo json_encode($members);
    
}else
    //Add new mamber
if ($request == 3) {}else
    //Delete member
if ($request == 4) {}

//Get return columns
if ($request == 6) {
    $memberColumns = $MemberShowController->showMemberColumns();

    if (count($memberColumns) > 0) {
        $members_table;
        $i = 0;
        foreach ($memberColumns as $column) {
            $members_table[$i] = $column[DatabaseConfig::$columns_field];
            $i++;
        }
        echo json_encode($members_table);
    }
}
