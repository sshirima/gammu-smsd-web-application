<?php

$rootDoc = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');
require_once $rootDoc.'controller/gammucontroller/Gammu.php';
require_once $rootDoc.'/auag-project/database/schema/OutboxItems.php';
require_once $rootDoc.'/auag-project/database/schema/SentItems.php';

class SMSHandler{
    
    var $gammu;
    var $outboxTable;
    var $sentItemTable;
    
    public function __construct($gammuDir) {
        $this->gammu = new Gammu($gammuDir);
        $this->outboxtable = new OutboxItems();
        $this->sentItemTable = new SentItems();
    }
    
    public function getAllSMSOutbox($returnColumns){
        return $this->outboxtable->getAllOutboxSMS($returnColumns);
    }
    
    public function sendSMS($recepientNumber, $msg){
        $responce =0;
        if (!empty($this->gammu)){
            $responce = $this->gammu->Send($recepientNumber, $msg);
        }
        return $responce;
    }
    
    public function deleteSMSOutbox($smsId){
        return $this->outboxtable->deleteOutBoxSMS($smsId);
    }
    
    public function saveSMSSentItems($columnNames, $columnValues){
        return $this->sentItemTable->addSentSMS($columnNames, $columnValues);
    }
}

