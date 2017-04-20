<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CommandProcessor
 *
 * @author shirima
 */
require_once $rootDoc . '/auag-project/database/schema/Actions.php';
require_once $rootDoc . '/auag-project/database/schema/Members.php';

class CommandProcessor {

    var $inboxTable;
    var $outboxTable;
    var $memberTable;
    var $actiontable;

    public function __construct() {
        $this->actiontable = new ActionsTable();
        $this->memberTable = new Members();
    }

    public function getValuesToReturn($command) {

        //Get action from command keyword
        $q1 = "SELECT action_returncolumn, action_description FROM commands INNER JOIN actions ON cmd_actionname LIKE action_name WHERE cmd_keyword LIKE '" . $command . "' ";

        return $this->actiontable->rawQuery($q1);
    }

    public function getReplyMsg($command, $senderNumber, $returnvalues) {
        $msgreply = '';

        if (!$returnvalues == 0) {

            $returnColm = $returnvalues[0][DatabaseConfig::$action_returncolumn];

            $actiondesc = strtolower($returnvalues[0][DatabaseConfig::$action_description]);

            $q2 = "SELECT *\n"
                    . "FROM member_command INNER JOIN members ON member_FK = memberID\n"
                    . "INNER JOIN commands ON command_FK = cmd_id \n"
                    . "INNER JOIN actions ON cmd_actionname LIKE action_name\n"
                    . "WHERE members.phonenumber LIKE '" . $senderNumber . "' AND cmd_keyword = '" . $command . "'";
            $r2 = $this->memberTable->rawQuery($q2);

            if (!$r2 == 0) {

                $value = $r2[0][$returnColm];
                $msgreply = "Dear member, your " . $actiondesc . " is: " . $value;
                
            } else {
                $msgreply = "You are not registered";
            }
        } else {
            $msgreply = 'Command not found!';
        }
        
        return $msgreply;
    }

}
