<?php

$rootDoc = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');

require_once $rootDoc . '/auag-project/controller/smscontroller/Commands.php';
require_once $rootDoc . '/auag-project/controller/smscontroller/CommandProcessor.php';
require_once $rootDoc . '/auag-project/database/AppDatabase.php';
require_once $rootDoc . '/auag-project/database/database.php';
require_once $rootDoc . '/auag-project/database/AppDatabase.php';
require_once $rootDoc . '/auag-project/database/QueryBuilder.php';
require_once $rootDoc . '/auag-project/database/TableInterfaces.php';

require_once $rootDoc . '/auag-project/database/schema/InboxItems.php';
require_once $rootDoc . '/auag-project/database/schema/OutboxItems.php';
require_once $rootDoc . '/auag-project/database/schema/Members.php';
require_once $rootDoc . '/auag-project/database/schema/CommandTable.php';
require_once $rootDoc . '/auag-project/database/schema/Actions.php';

class SMSProcessor {

    var $inboxTable;
    var $outboxTable;
    var $memberTable;
    var $commandTable;
    var $commandProcessor;

    public function __construct() {
        $this->inboxTable = new InboxItems();
        $this->outboxTable = new OutboxItems();
        $this->memberTable = new Members();
        $this->commandProcessor = new CommandProcessor();
        $this->commandTable = new CommandTable();
    }

    public function getUnProcessedSMS($returnColumns, $selection, $selectionArgs) {
        return $this->inboxTable->getInboxSMS($returnColumns, $selection, $selectionArgs);
    }

    public function saveSMSOutbox($columnname, $columnValues) {
        return $this->outboxTable->addOutboxSMS($columnname, $columnValues);
    }

    public function updateProcessedSMS($smsId, $columnname, $columnsvalues) {
        return $this->inboxTable->updateInboxSMS($smsId, $columnname, $columnsvalues);
    }

    public function run() {
        // Get all unprocessed SMS
        $msgs = $this->getUnProcessedSMS(array('*'), array(DatabaseConfig::$inbox_Processed), array('false'));

        // Prosses Unprocessed SMSs
        if (count($msgs) > 0 && !($msgs === 0)) {
            $this->process($msgs);
        }
    }

    private function getCommandsKeywords() {
        $commands = $this->commandTable->getAllCommands(array(DatabaseConfig::$commands_keyword));
        if (count($commands) > 0) {
            $command_array = array();
            $i = 0;
            foreach ($commands as $command) {
                $command_array[$i] = $command[DatabaseConfig::$commands_keyword];
                $i++;
            }
            return $command_array;
        } else {
            return 0;
        }
    }

    private function process($msgs) {

        $counter = 0;

        //Get all the commands from command table

        $command_array = $this->getCommandsKeywords();

        if ($command_array === 0) {
            return 0;
        }

        while ($counter < count($msgs)) {

            $msg = $msgs[$counter];

            $msgreply = "";

            $msgtext = $msg[DatabaseConfig::$inbox_TextDecoded];

            $senderNumber = $msg[DatabaseConfig::$inbox_SenderNumber];

            $smsId = $msg[DatabaseConfig::$inbox_ID];

            $text = explode(" ", $msgtext);
            
            $command = strtoupper($text[0]);

            if (in_array($command, $command_array)) {

                //Get return column name
                
                $r1 = $this->commandProcessor->getValuesToReturn($command);

                $msgreply = $this->commandProcessor->getReplyMsg($command, $senderNumber, $r1);
                
            } else {
                
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
                DatabaseConfig::$outbox_ID,
                DatabaseConfig::$outbox_CreatorID
                    ), array(
                date("Y-m-d G:i:s"),
                date("Y-m-d G:i:s"),
                $msg[DatabaseConfig::$inbox_SenderNumber],
                $msg[DatabaseConfig::$inbox_Coding],
                $msg[DatabaseConfig::$inbox_UDH],
                $msg[DatabaseConfig::$inbox_Class],
                $msgreply,
                $smsId,
                'Gammu'
            ));

            // Mark the SMS as processed
            $this->inboxTable->updateInboxSMS($smsId, array(DatabaseConfig::$inbox_Processed), array('True'));

            $counter++;
        }
    }

}
//
//$smsprocessor = new SMSProcessor();
//
//$smsprocessor->run();

