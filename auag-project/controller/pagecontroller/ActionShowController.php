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
require_once $rootDoc.'/auag-project/database/schema/Actions.php';

class ActionShowController{
    var $ActionTable;
    
    public function __construct() {
        $this->ActionTable = new ActionsTable();
    }
    
    public function getAllActions(array $returnColumns){
        if ($returnColumns == NULL){
           return $this->ActionTable->getAllActions(array('*'));
        } else {
            return $this->ActionTable->getAllActions($returnColumns);
        }
    }
    
    public function addAction(array $selection, array $selectionArgs){
        return $this->ActionTable->addAction($selection, $selectionArgs);
    }
    
    public function getAction($returnColumns,array $selection, array $selectionArgs ){
        return $this->ActionTable->getAction($returnColumns, $selection, $selectionArgs);
    }
    
    public function updateAction($actionId, $selection, $selectionArgs){
        return $this->ActionTable->updateAction($actionId, $selection, $selectionArgs);
    }
    
    public function deleteAction($actionName){
        return $this->ActionTable->deleteAction($actionName);
    }
    
}

