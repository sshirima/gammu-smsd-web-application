<?php
$rootDoc = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');
require_once $rootDoc.'/auag-project/database/schema/Members.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UploadData
 *
 * @author shirima
 */
class UploadDataController {
    //put your code here
    var $membersTable;
    
    public function __construct() {
        $this->membersTable = new Members();
    }
    
    public function updateMemberData($memeberId, $columnname, $columnsvalues){
        return $this->membersTable->updateMember($memeberId, $columnname, $columnsvalues);
    }
    
    public function insertMember($columnname, $columnsvalues){
         return $this->membersTable->addMember($columnname, $columnsvalues);
    }
    
    public function selectMember($memberId){
    return $this->membersTable->getMember(array(DatabaseConfig::$members_phonenumber), 
            array(DatabaseConfig::$members_phonenumber), 
            array($memberId));
    }
    
}
