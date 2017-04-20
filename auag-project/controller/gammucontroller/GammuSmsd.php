<?php

$rootDoc = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');
require_once $rootDoc.'/auag-project/controller/gammucontroller/GammuConfigs.php';

class GammuSmsd{
    
    var $Phones;
    
    public function __construct() {
        $this->Phones = new Phones();
    }
    
    public function getModemDetails(){
        return $this->Phones->getAllPhones(array('*'));
    }
    
}
