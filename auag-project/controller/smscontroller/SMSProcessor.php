<?php

//$rootDoc = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');
//
//require $rootDoc.'/auag-project/controller/smscontroller/Commands.php';
//require $rootDoc.'/auag-project/database/database.php';
//require $rootDoc.'/auag-project/database/AppDatabase.php';
//require $rootDoc.'/auag-project/database/QueryBuilder.php';
//require $rootDoc.'/auag-project/database/TableInterfaces.php';
//
//require $rootDoc.'/auag-project/database/schema/InboxItems.php';
//require $rootDoc.'/auag-project/database/schema/OutboxItems.php';
//require $rootDoc.'/auag-project/database/schema/Members.php';

class SMSProcessor {
    
    var $inboxTable;
    var $outboxTable;
    var $memberTable;
    var $commandProcessor;
    
    public function __construct() {
        $this->inboxTable = new InboxItems();
        $this->outboxTable = new OutboxItems();
        $this->memberTable = new Members();
        $this->commandProcessor = new CommandProcessor();
    }
    
    public function getUnProcessedSMS($returnColumns, $selection, $selectionArgs) {
        return $this->inboxTable->getInboxSMS($returnColumns, $selection, $selectionArgs);
    }
    
    public function saveSMSOutbox($columnname, $columnValues){
        return $this->outboxTable->addOutboxSMS($columnname, $columnValues);
    }
    
    public function updateProcessedSMS($smsId, $columnname, $columnsvalues){
        return $this->inboxTable->updateInboxSMS($smsId, $columnname, $columnsvalues);
    }

    public function run() {
        // Get all unprocessed SMS
        $msgs = $this->getUnProcessedSMS(array('*'), array(DatabaseConfig::$inbox_Processed), array('false'));

        // Prosses Unprocessed SMSs
        if (count($msgs) > 0) {
            $this->process($msgs);
        }
    }

    private function process($msgs) {

        foreach ($msgs as $msg) {
            
            $msgreply = "";
            
            $msgtext = $msg[DatabaseConfig::$inbox_TextDecoded];
            
            $senderNumber = $msg[DatabaseConfig::$inbox_SenderNumber];
            
            $smsId = $msg[DatabaseConfig::$inbox_ID];
            
            $text = explode(" ", $msgtext);

            if (($text[0] === Commands::$keyword_shares_eng) && (count($text) === 2)) {
                
                $msgreply = $this->commandProcessor->commandCheckShares($senderNumber, $text[1]);
                
            } else 
                
                if (($text[0] === Commands::$keyword_passwordchange_eng) && (count($text) === 4)) {
                
                //$msgreply = $this->commandShares($senderNumber, $text[1]);
                $oldpassword = $text[1];
                $newpassword = $text[2];
                $repeatnewpassword = $text[3];
                
                $msgreply = $this->commandProcessor->commandChangePassword($senderNumber, $oldpassword, $newpassword, $repeatnewpassword);
            } 
            
            else {
                
                // Delete msg from inbox
                $this->inboxTable->deleteInBoxSMS($msg[DatabaseConfig::$inbox_ID]);
                continue;
            }
            
            //Save msg to outbox
            $this->saveSMSOutbox(array(
                DatabaseConfig::$outbox_updatedInDB,
                DatabaseConfig::$outbox_InsertIntoDB,
                DatabaseConfig::$outbox_DestinationNumber,
                DatabaseConfig::$outbox_Coding,
                DatabaseConfig::$outbox_UDH,
                DatabaseConfig::$outbox_Class,
                DatabaseConfig::$outbox_TextDecoded,
                DatabaseConfig::$outbox_CreatorID
                    ), array(
                        date("Y-m-d G:i:s"),
                        date("Y-m-d G:i:s"),
                        $msg[DatabaseConfig::$inbox_SenderNumber],
                        $msg[DatabaseConfig::$inbox_Coding],
                        $msg[DatabaseConfig::$inbox_UDH],
                        $msg[DatabaseConfig::$inbox_Class],
                        $msgreply,
                        'Gammu'
                        ));
            
            // Mark the SMS as processed
            $this->inboxTable->updateInboxSMS($smsId, array(DatabaseConfig::$inbox_Processed), 
                    array('True'));
        }
    }
}

//$smsprocessor = new SMSProcessor();
//
//$smsprocessor->run();

