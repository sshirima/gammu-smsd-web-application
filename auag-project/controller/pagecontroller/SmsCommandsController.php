<?php
$rootDoc = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');

require_once $rootDoc.'/auag-project/controller/smscontroller/Commands.php';
require_once $rootDoc.'/auag-project/controller/gammucontroller/Gammu.php';
require_once $rootDoc.'/auag-project/controller/gammucontroller/GammuConfigs.php';
require_once $rootDoc.'/auag-project/controller/smscontroller/SMSProcessor.php';
require_once $rootDoc.'/auag-project/database/database.php';
require_once $rootDoc.'/auag-project/database/AppDatabase.php';
require_once $rootDoc.'/auag-project/database/QueryBuilder.php';
require_once $rootDoc.'/auag-project/database/TableInterfaces.php';

require_once $rootDoc.'/auag-project/database/schema/InboxItems.php';
require_once $rootDoc.'/auag-project/database/schema/OutboxItems.php';
require_once $rootDoc.'/auag-project/database/schema/Members.php';
require_once $rootDoc.'/auag-project/database/schema/Phones.php';
require_once $rootDoc.'/auag-project/database/schema/CommandTable.php';

class SmsCommandsController {
    //put your code here
    var $CommandTable;
    
    public function __construct() {
        
        $this->CommandTable = new CommandTable();
    }
    
    function getAllCommands(){
        return $this->CommandTable->getAllCommands(array('*'));
    }
    
    function addCommand(array $selection, array $selectionArgs){
        return $this->CommandTable->addCommand($selection, $selectionArgs);
    }
    
    function updateCommand($commandId,array $selection, array $selectionArgs ){
        return $this->CommandTable->updateCommand($commandId, $selection, $selectionArgs);
    }
    
    function getCommand($returnColumns, $selection, $selectionArgs){
        return $this->CommandTable->getCommand($returnColumns, $selection, $selectionArgs);
    }
    
    function deleteCommand($commandId){
        return $this->CommandTable->deleteCommand($commandId);
    }
}
