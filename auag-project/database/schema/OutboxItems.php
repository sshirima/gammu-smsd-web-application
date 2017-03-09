<?php
//$rootDoc = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');
//
//require $rootDoc.'/auag-project/database/database.php';
//require $rootDoc.'/auag-project/database/AppDatabase.php';
//require $rootDoc.'/auag-project/database/QueryBuilder.php';
//require $rootDoc.'/auag-project/database/TableInterfaces.php';

class OutboxItems implements OutboxTable{
    
    var $_database;
    var $_tablename;
    
    public function __construct(){
        
        // Create an instance of the database with configuration from Database config file
        $this->_database = new AppDatabase(
                DatabaseConfig::$_serverName,
                DatabaseConfig::$_username, 
                DatabaseConfig::$_password,
                DatabaseConfig::$_dbname);
        
        $this->_tablename = DatabaseConfig::$table_outbox;
    }
    
    public function dbconnect() {
        // Connect to the database
        return $this->_database->connect();
    }

    public function deleteOutBoxSMS($smsId) {
        $queryBuilder = new MySqlQuery();
        
        $deleteQuery = $queryBuilder->deleteQuery($this->_tablename, 
                array(DatabaseConfig::$outbox_ID), 
                array($smsId));
        
        return $this->_database->deleteData($deleteQuery);
    }

    public function getAllOutboxSMS(array $returnColumns) {
        $queryBuilder = new MySqlQuery();
        
        $getOutboxSMSQuery = $queryBuilder->selectQuery($this->_tablename, $returnColumns, array(), 
                    array());
        
        return $this->_database->selectData($getOutboxSMSQuery);
    }

    public function getOutboxSMS(array $returnColumns, array $selection, array $selectionArgs) {
        $queryBuilder = new MySqlQuery();
        
        $getMemberQuery = $queryBuilder->selectQuery($this->_tablename, $returnColumns, $selection, $selectionArgs);
        
        return $this->_database->selectData($getMemberQuery);
    }

    public function updateOutboxSMS($smsId, array $columnname, array $columnsvalues) {
        // Prepare a query to add new member
        $queryBuilder = new MySqlQuery();
        
        $updatequery = $queryBuilder->updateQuery($this->_tablename, 
                $columnname, 
                $columnsvalues,
                array(DatabaseConfig::$outbox_ID),
                array($smsId));
        
       return $this->_database->updateData($updatequery);
        
    }

    public function addOutboxSMS(array $columnname, array $columnsvalues) {
        $queryBuilder = new MySqlQuery();
        
        $insertquery = $queryBuilder->insertQuery($this->_tablename, $columnname, $columnsvalues);
        
        return $this->_database->insertData($insertquery);
    }

}

