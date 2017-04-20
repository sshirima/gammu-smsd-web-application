<?php
$rootDoc = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');

require_once $rootDoc.'/auag-project/database/database.php';
require_once $rootDoc.'/auag-project/database/AppDatabase.php';
require_once $rootDoc.'/auag-project/database/QueryBuilder.php';
require_once $rootDoc.'/auag-project/database/TableInterfaces.php';

class CommandTable implements CommandsInterface {
    //put your code here
    var $_database;
    var $_tablename;
    
    public function __construct() {
        // Create an instance of the database with configuration from Database config file
        $this->_database = new AppDatabase(
                DatabaseConfig::$_serverName,
                DatabaseConfig::$_username, 
                DatabaseConfig::$_password,
                DatabaseConfig::$_dbname);
        
        $this->_tablename = DatabaseConfig::$table_commands;
    }
    
    public function dbconnect() {
        
        return $this->_database->connect();
    }

    public function deleteCommand($commandId) {
        $queryBuilder = new MySqlQuery();
        
        $deleteQuery = $queryBuilder->deleteQuery($this->_tablename, 
                array(DatabaseConfig::$commands_id), 
                array($commandId));
        
        return $this->_database->deleteData($deleteQuery);
    }

    public function getAllCommands(array $returnColumns) {
        $queryBuilder = new MySqlQuery();
        
        $getPhonesQuery = $queryBuilder->selectQuery($this->_tablename, $returnColumns, array(), 
                    array());
        
        return $this->_database->selectData($getPhonesQuery);
    }

    public function getCommand(array $returnColumns, array $selection, array $selectionArgs) {
        $queryBuilder = new MySqlQuery();
        
        $getMemberQuery = $queryBuilder->selectQuery($this->_tablename, $returnColumns, $selection, $selectionArgs);
        
        return $this->_database->selectData($getMemberQuery);
    }

    public function updateCommand($commandId, array $columnname, array $columnsvalues) {
         // Prepare a query to update command
        $queryBuilder = new MySqlQuery();
        
        $updatequery = $queryBuilder->updateQuery($this->_tablename, 
                $columnname, 
                $columnsvalues,
                array(DatabaseConfig::$commands_id),
                array($commandId));
        
       return $this->_database->updateData($updatequery);
    }
    public function addCommand(array $columnname, array $columnsvalues) {
        // Prepare a query to add new command
        $queryBuilder = new MySqlQuery();
        
        $insertquery = $queryBuilder->insertQuery($this->_tablename, $columnname, $columnsvalues);
        
        return $this->_database->insertData($insertquery);
    }
    
    public function rawQuery($query){
        return $this->_database->rawQuery($query);
    }

}

//$smscommand = new CommandTable();
//
//$res = $smscommand->getAllCommands(array('*'));
//
//echo $res;