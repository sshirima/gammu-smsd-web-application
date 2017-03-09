<?php

//$rootDoc = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');
//
//require $rootDoc.'/auag-project/database/database.php';
//require $rootDoc.'/auag-project/database/AppDatabase.php';
//require $rootDoc.'/auag-project/database/QueryBuilder.php';
//require $rootDoc.'/auag-project/database/TableInterfaces.php';

class Members implements MembersInterface{
    
    var $_database;
    var $_tablename;
   
    public function __construct(){
        
        // Create an instance of the database with configuration from Database config file
        $this->_database = new AppDatabase(
                DatabaseConfig::$_serverName,
                DatabaseConfig::$_username, 
                DatabaseConfig::$_password,
                DatabaseConfig::$_dbname);
        
        $this->_tablename = DatabaseConfig::$table_members;
    }
    
    public function dbconnect() {
        
        // Connect to the database
        return $this->_database->connect();
    }

    public function addMember(array $columnname, array $columnsvalues) {
        
        // Prepare a query to add new member
        $queryBuilder = new MySqlQuery();
        
        $insertquery = $queryBuilder->insertQuery($this->_tablename, $columnname, $columnsvalues);
        
        return $this->_database->insertData($insertquery);
        
    }

    public function deleteMemberById($memberId) {
        // Prepare Query to delete member from the DB
        $queryBuilder = new MySqlQuery();
        
        $deleteQuery = $queryBuilder->deleteQuery($this->_tablename, 
                array(DatabaseConfig::$members_id), 
                array($memberId));
        
        return $this->_database->deleteData($deleteQuery);
        
    }

    public function getAllMembers(array $returnColumns) {
        $queryBuilder = new MySqlQuery();
        
        $getMemberQuery = $queryBuilder->selectQuery($this->_tablename, $returnColumns, array(), 
                    array());
        
        return $this->_database->selectData($getMemberQuery);
    }

    public function getMember(array $returnColumns, array $selection, array $selectionArgs) {
        $queryBuilder = new MySqlQuery();
        
        $getMemberQuery = $queryBuilder->selectQuery($this->_tablename, $returnColumns, $selection, $selectionArgs);
        
        return $this->_database->selectData($getMemberQuery);
    }

    public function updateMember($memeberId, array $columnname, array $columnsvalues) {
        
        // Prepare a query to add new member
        $queryBuilder = new MySqlQuery();
        
        $updatequery = $queryBuilder->updateQuery($this->_tablename, 
                $columnname, 
                $columnsvalues,
                array(DatabaseConfig::$members_id),
                array($memeberId));
        
       return $this->_database->updateData($updatequery);
    }

}

/**
 * Codes for testing the file
 */
//$members = new Members();
//
//if ($members->dbconnect() == 1){
//    echo 'Connected<br>';
//} else {
//    echo 'Could not connect<br>';
//}
//
//$res = $members->addMember(array(DatabaseConfig::$members_phonenumber, 
//    DatabaseConfig::$members_firstname, 
//    DatabaseConfig::$members_lastname,
//    DatabaseConfig::$members_Password,
//    DatabaseConfig::$members_shares,
//    DatabaseConfig::$members_currency),
//    array("+2557547111111","Adelina", "Kishimbo", "123456","20000", "Tsh" ));
////
//if ($res === 1){
//    echo 'Record was was added<br>';
//} else {
//    echo 'Failed<br>';
//}
//$r = $members->deleteMemberById(24);
//if ($r === 1){
//    echo 'Record was deleted<br>';
//} else {
//    echo 'Failed<br>';
//}
//$result = $members->getAllMembers(array('*'));

//echo json_encode($result);