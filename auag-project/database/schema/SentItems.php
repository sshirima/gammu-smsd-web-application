<?php
require '../database.php';
require '../AppDatabase.php';
require '../QueryBuilder.php';
require '../TableInterfaces.php';

class SentItems implements SentItemsTable{
    
    var $_database;
    var $_tablename;
    
    public function __construct(){
        
        // Create an instance of the database with configuration from Database config file
        $this->_database = new AppDatabase(
                DatabaseConfig::$_serverName,
                DatabaseConfig::$_username, 
                DatabaseConfig::$_password,
                DatabaseConfig::$_dbname);
        
        $this->_tablename = DatabaseConfig::$table_sentitems;
    }
    
    public function dbconnect() {
        // Connect to the database
        return $this->_database->connect();
    }

    public function deleteSentSMS($smsId) {
        
    }

    public function getAllSentSMS(array $returnColumns) {
        
    }

    public function getSentSMS(array $returnColumns, array $selection, array $selectionArgs) {
        
    }

    public function updateSentSMS($smsId, array $columnname, array $columnsvalues) {
        
    }

}

