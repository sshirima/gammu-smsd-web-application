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

class MemberShowController{
    var $MembersTable;
    
    public function __construct() {
        $this->MembersTable = new Members();
    }
    
    public function getAllMembers(){
        return $this->MembersTable->getAllMembers(array('*'));
    }
    public function addMember(){
        
    }
    public function updateMember($memeberId, array $columnname, array $columnsvalues){
        return $this->MembersTable->updateMember($memeberId, $columnname, $columnsvalues);
    }
    public function deleteMember(){
        
    }
    
    public function showMemberColumns(){
        return $this->MembersTable->showMemberColumns();
    }
}
