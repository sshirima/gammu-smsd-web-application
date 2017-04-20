<?php

$rootDoc = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');

require_once $rootDoc . '/auag-project/controller/smscontroller/Commands.php';
require_once $rootDoc . '/auag-project/controller/gammucontroller/Gammu.php';
require_once $rootDoc . '/auag-project/controller/gammucontroller/GammuConfigs.php';
require_once $rootDoc . '/auag-project/controller/smscontroller/SMSProcessor.php';
require_once $rootDoc . '/auag-project/database/database.php';
require_once $rootDoc . '/auag-project/database/AppDatabase.php';
require_once $rootDoc . '/auag-project/database/QueryBuilder.php';
require_once $rootDoc . '/auag-project/database/TableInterfaces.php';

require_once $rootDoc . '/auag-project/database/schema/InboxItems.php';
require_once $rootDoc . '/auag-project/database/schema/OutboxItems.php';
require_once $rootDoc . '/auag-project/database/schema/Members.php';
require_once $rootDoc . '/auag-project/database/schema/Phones.php';
require_once $rootDoc . '/auag-project/database/schema/CommandTable.php';

class ReportShowController {

    var $memberTable;
    var $commandTable;

    public function __construct() {
        $this->memberTable = new ActionsTable();
        $this->commandTable = new CommandTable();
    }

    public function getUserReports() {
        $query = "SELECT MemberSentitem.ID, MemberSentitem.FirstName, MemberSentitem.phonenumber,MemberSentitem.SentSMS, MemberInbox.ReceivedSMS FROM\n"
                . "(SELECT members.memberID as ID, members.Firstname, members.phonenumber, \n"
                . "COUNT(inbox.SenderNumber) as ReceivedSMS\n"
                . "FROM members INNER JOIN inbox ON\n"
                . "members.phonenumber = inbox.SenderNumber\n"
                . "GROUP BY members.memberID) AS MemberInbox INNER JOIN (SELECT members.memberID as ID, members.Firstname AS FirstName, members.phonenumber AS phonenumber, \n"
                . "COUNT(sentitems.DestinationNumber) as SentSMS\n"
                . "FROM members INNER JOIN sentitems ON\n"
                . "members.phonenumber = sentitems.DestinationNumber\n"
                . "WHERE sentitems.Status LIKE 'SendingOKNoReport' OR sentitems.Status LIKE 'SendingOK'"
                . "GROUP BY members.memberID) AS MemberSentitem ON MemberInbox.ID = MemberSentitem.ID";
        return $this->memberTable->rawQuery($query);
    }

    public function getSummaryReport() {
        $query = "SELECT inboxProc.ProcessedSMS, SentItemOK.SentSMS, SentItemFail.FailedSMS FROM \n"
                . "(SELECT COUNT(inbox.Processed) AS ProcessedSMS FROM\n"
                . "inbox WHERE inbox.Processed = 'true') AS inboxProc\n"
                . "JOIN\n"
                . "(SELECT COUNT(sentitems.Status) as SentSMS FROM sentitems WHERE sentitems.Status LIKE 'SendingOKNoReport' OR sentitems.Status LIKE 'SendingOK') AS SentItemOK\n"
                . "JOIN \n"
                . "(SELECT COUNT(sentitems.Status) as FailedSMS FROM sentitems WHERE sentitems.Status LIKE 'SendingError' OR sentitems.Status LIKE 'Error') as SentItemFail";
        return $this->commandTable->rawQuery($query);
    }

    public function getReceivingQueueTimeAvg() {
        $repl = '0';
        $sql = "SELECT AVG(inboxAv.InsertDelay) as InsertDelayAvg FROM \n"
                . "(SELECT TIMEDIFF(UpdatedInDB, ReceivingDateTime) AS InsertDelay FROM inbox) as inboxAv";
        $res = $this->commandTable->rawQuery($sql);
        if (!$res == 0) {
            $repl = $res[0]['InsertDelayAvg'];
        }
        return intval($repl);
    }

    public function getProcessingTimeAvg() {
        $repl = '0';
        $sql = "SELECT AVG(QueueAvg.QueueDelay) as QueueDelayAvg FROM (SELECT TIMEDIFF(sentitems.UpdatedInDB, inbox.UpdatedInDB) AS QueueDelay FROM inbox INNER JOIN\n"
                . "sentitems ON inbox.ID = sentitems.ID) as QueueAvg";
        $res = $this->commandTable->rawQuery($sql);
        if (!$res == 0) {
            $repl = $res[0]['QueueDelayAvg'];
        }
        return intval($repl);
    }

    public function getSMSResponseTimeAvg() {
        $repl = '0';
        $sql = "SELECT AVG(TotalAvg.TotalDelay) as QueueDelayAvg FROM (SELECT TIMEDIFF(sentitems.SendingDateTime, inbox.ReceivingDateTime) AS TotalDelay FROM inbox INNER JOIN\n"
                . "sentitems ON inbox.ID = sentitems.ID) as TotalAvg";
        $res = $this->commandTable->rawQuery($sql);
        if (!$res == 0) {
            $repl = $res[0]['QueueDelayAvg'];
        }
        return intval($repl);
    }

    public function getUnregisteredCount() {
        $repl = '0';
        $sql = "SELECT COUNT(*) as Unregistered FROM (SELECT sentitems.TextDecoded, sentitems.DestinationNumber FROM sentitems WHERE sentitems.DestinationNumber NOT IN\n"
                . "(SELECT members.phonenumber FROM members)) AS UnregTable";
        $res = $this->commandTable->rawQuery($sql);
        if (!$res == 0) {
            $repl = $res[0]['Unregistered'];
        }
        return intval($repl);
    }

    public function getSummarySMSTable() {
        $result = $this->getSummaryReport();
        $r = "";
        $table = "<table class='table'>
                                    <tbody>
                                        <tr class='info'>
                                            <td>Total SMS processed:</td>
                                            <td><b>%s</b></td>
                                        </tr>
                                        <tr class='info'>
                                            <td>Total SMS sent:</td>
                                            <td><b>%s</b></td>
                                        </tr>
                                        <tr class='info'>
                                            <td>Total SMS failed:</td>
                                            <td><b>%s</b></td>
                                        </tr>
                                    </tbody>
                                </table>";
        if (!$result == 0) {
            $processed = $result[0]['ProcessedSMS'];
            $sent = $result[0]['SentSMS'];
            $failed = $result[0]['FailedSMS'];

            $r = sprintf($table, $processed, $sent, $failed);
        }
        return $r;
    }

    public function getOverallSysreport() {
        $table = "<table class='table-condensed'>
                                    <tbody>
                                        <tr >
                                            <td>
                                            Receiving queue time (average):</td>
                                            <td > <b>%s seconds</b></td>
                                        </tr>
                                        <tr >
                                            <td>Processing time (average):</td>
                                            <td> <b>%s seconds</b></td>
                                        </tr>
                                        <tr >
                                            <td>SMS response time (average):</td>
                                            <td> <b>%s seconds</b></td>
                                        </tr>
                                        <tr >
                                            <td>Unregistered number(count):</td>
                                            <td> <b>%s</b></td>
                                        </tr>
                                    </tbody>
                                </table>";
        return sprintf($table, $this->getReceivingQueueTimeAvg(), $this->getProcessingTimeAvg(), $this->getSMSResponseTimeAvg(), $this->getUnregisteredCount());
    }

}

//$cont = new ReportShowController();
//echo $cont->getOverallSysreport();
