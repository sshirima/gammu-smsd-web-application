<?php

$rootDoc = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');
require $rootDoc.'controller/gammucontroller/GammuConfigs.php';

class GammuSmsd{
    
    var $processId;
    
    function pause(){
        $this->getProccessID();
        $exec = SmsdConfig::$command_Pause. ' '.$this->processId;
        $this->executeCmd($exec);
    }
    
    function getProccessID(){
        $exec = SmsdConfig::$command_getPID.' '. SmsdConfig::$GAMMU_SMSD_DIR;
        $this->processId = $this->executeCmd($exec);
    }
        
    function resume(){
        $this->getProccessID();
        $exec = SmsdConfig::$command_Resume. ' '.$this->processId;
        $this->executeCmd($exec);
    }
    
    function executeCmd($exec){
        $response = exec($exec);
        return $response;
    }
}

//$smsd = new GammuSmsd();
//
//$smsd->resume();
