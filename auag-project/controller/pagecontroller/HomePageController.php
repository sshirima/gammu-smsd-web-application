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

class HomePageController {
    
    var $SMSProcessor;
    var $Gammu;
    var $Phones;
    
    public function __construct() {
        $this->SMSProcessor = new SMSProcessor();
        
        $this->Phones = new Phones();
    }
    
    public function getPhones(){
        return $this->Phones->getAllPhones(array('*'));
    }
    
    function processSMS(){
        $this->SMSProcessor->run();
        
    }
    
    function getGammuSmsdStatus(){
        $command= "pidof /usr/bin/gammu-smsd";
        $gammuID = exec($command);
        
        if (empty($gammuID)){
            return "<div class=\"alert alert-danger\" role=\"alert\"><b>Smsd Deamon:</b> Stopped, please run <i>/usr/bin/gammu-smsd</i> from command prompt</div>";
        } else {
            return "<div class=\"alert alert-success\" role=\"alert\"> <b>Smsd Deamon:</b> Running, process id: ".$gammuID ."</div>";
        }
    }
            
    function getPhoneDetails() {
        
        $phones = $this->getPhones();
        
        $timeNow = new DateTime();
        
        
        $responce = "";
        
        
        
        $label = "<b>%s</b>";
        
        $phoneInfo = "";

        if (count($phones) > 0) {

            foreach ($phones as $phone) {
                $timeUpdate = new DateTime($phone[DatabaseConfig::$phone_UpdatedInDB]);
                $timeDiff = $timeUpdate->diff($timeNow);
                $lastChecked = "%s day(s) %s hrs %s min %s sec";
                
                $phoneInfo = $phoneInfo.sprintf($label,"IMSI: ").$phone[DatabaseConfig::$phone_IMSI]."<br>";
                $phoneInfo = $phoneInfo.sprintf($label,"IMEI: ").$phone[DatabaseConfig::$phone_IMEI]."<br>";
                $phoneInfo = $phoneInfo.sprintf($label,"Network: ").$phone[DatabaseConfig::$phone_NetName]."<br>";
                $phoneInfo = $phoneInfo.sprintf($label,"Network Code: ").$phone[DatabaseConfig::$phone_NetCode]."<br>";
                $phoneInfo = $phoneInfo.sprintf($label,"Last checked: "). 
                        sprintf($lastChecked, $timeDiff->d, $timeDiff->h, $timeDiff->i, $timeDiff->s)." <br>";
                
                $responce = $this->formatReplyResponce($timeDiff, $phoneInfo);
            }
        }
        
        return $responce;
    }
    
    private function formatReplyResponce($timeDiff, $phoneInfo) {
        
        $responce = "";

        $nodeScriptSuccess = "<div class=\"alert alert-success\" role=\"alert\">%s</div>";

        $nodeScriptWarning = "<div class=\"alert alert-warning\" role=\"alert\">%s</div>";

        $nodeScriptDanger = "<div class=\"alert alert-danger\" role=\"alert\">%s</div>";

        $timeDiffsec = $timeDiff->s;

        $timeDiffmin = $timeDiff->i;
        
        $timeDiffhrs = $timeDiff->h;
        
        $timeDiffday = $timeDiff->d;

        if ($timeDiffmin == 0 && $timeDiffsec <= 30) {

            $responce = $responce . sprintf($nodeScriptSuccess, $phoneInfo);
            
        } else
            
        if (($timeDiffmin == 0 && $timeDiffsec > 30) || ($timeDiffmin == 1)) {
            
            $responce = $responce . sprintf($nodeScriptWarning, $phoneInfo);
            
        } else 
            
            if ($timeDiffmin >= 2 || $timeDiffhrs > 0 || $timeDiffday > 0) {
            
            $responce = $responce . sprintf($nodeScriptDanger, $phoneInfo);
            
        }
        
        return $responce;
    }

}

//$homePageController = new HomePageController();
//    
//    $homePageController->processSMS();
