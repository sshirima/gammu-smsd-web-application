<?php

$rootDoc = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');

require $rootDoc.'/auag-project/controller/smscontroller/Commands.php';
require $rootDoc.'/auag-project/database/database.php';
require $rootDoc.'/auag-project/database/AppDatabase.php';
require $rootDoc.'/auag-project/database/QueryBuilder.php';
require $rootDoc.'/auag-project/database/TableInterfaces.php';

require $rootDoc.'/auag-project/database/schema/InboxItems.php';
require $rootDoc.'/auag-project/database/schema/OutboxItems.php';
require $rootDoc.'/auag-project/database/schema/Members.php';

class HomePageController {
    
    var $SMSProcessor;
    var $Gammu;
    
    public function __construct() {
        $this->SMSProcessor = new SMSProcessor();
        
        $this->Gammu = new Gammu(GammuConfig::$GAMMU_DIR);
    }
    
    function detectModem(){
        return $this->Gammu->Identify();
    }
    
    function processSMS(){
        $this->SMSProcessor->run();
    }
}
