<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Commands
 *
 * @author shirima
 */
class Commands {
    //put your code here
    public static $keyword_balance_eng = "Balance";
    public static $keyword_balance_kisw = "Salio";
    public static $keyword_shares_eng = "Shares";
    public static $keyword_shares_kisw = "Gawio";
    public static $keyword_passwordchange_eng = "ChangePassword";
    public static $keyword_passwordchange_kisw = "Badilinenolasiri";
}

class SMSReplies {
    public static $reply_shares_success = "Dear member, your current shares is %s";
    public static $reply_shares_error = "Sorry system could not retrieve your information, please confirm your password";
    public static $reply_error_passchange_mismatchparameter = "Dear member, you new password and repeat password dont match";
    public static $reply_error_wrongpass = "Sorry system could not retrieve your information, please confirm your password";
    public static $reply_error_passchange_failtochange = "Sorry the system could not change your password, please try again";
    public static $reply_success_passchange = "Dear member, your password has been changed successfully, your new password is %s";
}