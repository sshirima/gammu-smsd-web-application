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
class CommandProcessor {
    
    var $inboxTable;
    var $outboxTable;
    var $memberTable;
    
     public function __construct() {
        $this->inboxTable = new InboxItems();
        $this->outboxTable = new OutboxItems();
        $this->memberTable = new Members();
     }
    
    public function commandCheckShares($parameter1, $parameter2){
        $replymsg = '';
        
        $resp = $this->memberTable->getMember(array("*"),
                array(DatabaseConfig::$members_phonenumber, DatabaseConfig::$members_Password), 
                array($parameter1, $parameter2));
        
        if (count($resp) === 1){
            $shares = $resp[0][DatabaseConfig::$members_shares];
            $replymsg = sprintf(SMSReplies::$reply_shares_success, $shares);
        } else {
            $replymsg = SMSReplies::$reply_shares_error;
        } 
        return $replymsg;
    }
    
    public function commandChangePassword($phoneNumber, $oldpassword, $newpasswod, $repeatPassword){
        $replymsg = '';
        
        if ($newpasswod === $repeatPassword) {

            // Check if the password is valid
            $resp = $this->memberTable->getMember(array("*"), array(DatabaseConfig::$members_phonenumber, DatabaseConfig::$members_Password), array($phoneNumber, $oldpassword));

            if (count($resp) === 1) {
                $memberId = $resp[0][DatabaseConfig::$members_id];

                $r = $this->memberTable->updateMember($memberId, array(DatabaseConfig::$members_Password), array($newpasswod));
                if ($r === 1) {
                    $replymsg = sprintf(SMSReplies::$reply_success_passchange, $newpasswod);
                } else {
                    $replymsg = SMSReplies::$reply_error_passchange_failtochange;
                }
            } else {
                $replymsg = SMSReplies::$reply_error_wrongpass;
            }
        } else {
            $replymsg = SMSReplies::$reply_error_passchange_mismatchparameter;
        }
        
        return $replymsg;
    }
    
}
