<?php

$rootDoc = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');

require_once $rootDoc.'/auag-project/database/database.php';
require_once $rootDoc.'/auag-project/database/AppDatabase.php';
require_once $rootDoc.'/auag-project/database/QueryBuilder.php';
require_once $rootDoc.'/auag-project/database/TableInterfaces.php';

class Phones implements PhonesInterface{
    //put your code here
    var $_database;
    var $_tablename;
    
    
    public function __construct(){
        
        // Create an instance of the database with configuration from Database config file
        $this->_database = new AppDatabase(
                DatabaseConfig::$_serverName,
                DatabaseConfig::$_username, 
                DatabaseConfig::$_password,
                DatabaseConfig::$_dbname);
        
        $this->_tablename = DatabaseConfig::$table_phones;
    }
    
    public function dbconnect() {
        return $this->_database->connect();
    }

    public function getAllPhones(array $returnColumns) {
        $queryBuilder = new MySqlQuery();
        
        $getPhonesQuery = $queryBuilder->selectQuery($this->_tablename, $returnColumns, array(), 
                    array());
        
        return $this->_database->selectData($getPhonesQuery);
    }

}

//$Phones = new Phones();
//
//$resp = $Phones->getAllPhones(array('*'));
//
//echo $resp;
