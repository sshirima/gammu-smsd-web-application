<?php

$rootDoc = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');

require_once $rootDoc.'/auag-project/database/database.php';
require_once $rootDoc.'/auag-project/database/AppDatabase.php';
require_once $rootDoc.'/auag-project/database/QueryBuilder.php';
require_once $rootDoc.'/auag-project/database/TableInterfaces.php';

class InboxItems implements InboxTable {
    
    var $_database;
    var $_tablename;
    
    public function __construct(){
        
        // Create an instance of the database with configuration from Database config file
        $this->_database = new AppDatabase(
                DatabaseConfig::$_serverName,
                DatabaseConfig::$_username, 
                DatabaseConfig::$_password,
                DatabaseConfig::$_dbname);
        
        $this->_tablename = DatabaseConfig::$table_inbox;
    }
    
    public function dbconnect() {
        // Connect to the database
        return $this->_database->connect();
    }

    public function getAllInboxSMS(array $returnColumns) {
        
    }

    public function getInboxSMS(array $returnColumns, array $selection, array $selectionArgs) {
        $queryBuilder = new MySqlQuery();
        
        $getMemberQuery = $queryBuilder->selectQuery($this->_tablename, $returnColumns, $selection, $selectionArgs);
        
        return $this->_database->selectData($getMemberQuery);
    }

    public function updateInboxSMS($smsId, array $columnname, array $columnsvalues) {
        // Prepare a query to add new member
        $queryBuilder = new MySqlQuery();
        
        $updatequery = $queryBuilder->updateQuery($this->_tablename, 
                $columnname, 
                $columnsvalues,
                array(DatabaseConfig::$inbox_ID),
                array($smsId));
        
       return $this->_database->updateData($updatequery);
        
    }

    public function deleteInBoxSMS($smsId) {
        $queryBuilder = new MySqlQuery();
        
        $deleteQuery = $queryBuilder->deleteQuery($this->_tablename, 
                array(DatabaseConfig::$inbox_ID), 
                array($smsId));
        
        return $this->_database->deleteData($deleteQuery);
    }

}

