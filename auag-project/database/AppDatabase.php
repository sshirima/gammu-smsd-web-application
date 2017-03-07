<?php
class AppDatabase {
    
    protected $_connection;
            
    public function __construct($servername, $username, $password, $dbname) {
        $this->_serverName = $servername;
        $this->_username = $username;
        $this->_password = $password;
        $this->_dbname = $dbname;
    }

    // Connect to the database
    public function connect() {
        // Create connection
        /* @var $_serverName string */
        /* @var $_username string */
        /* @var $_password string */
        $this->_connection = new mysqli($this->_serverName, $this->_username, $this->_password, $this->_dbName);

        // Check connection
        if ($this->_connection->connect_error) {
            die("Connection failed: " . $this->_connection->connect_error);
        }
        return 1;
    }
    
    // Query onto the database
    public function insertData($insertQuery) {

        $this->_connection = new mysqli($this->_serverName, $this->_username, $this->_password, $this->_dbname);

        if ($this->_connection->connect_error) {
            die("Connection failed: " . $this->_connection->connect_error);
        }

        if ($this->_connection->query($insertQuery) === TRUE) {
            $this->_connection->close();
            return 1;
            
        } else {
            return "Error: " . $insertQuery . "<br>" . $this->_connection->error;
            
        }
        
        $this->_connection->close();
    }
    
    public function updateData($updateQuery) {
        
        $this->_connection = new mysqli($this->_serverName, $this->_username, $this->_password, $this->_dbname);
        
        $returnvalue = "";
        
        if ($this->_connection->connect_error) {
            die("Connection failed: " . $this->_connection->connect_error);
        }
        if ($this->_connection->query($updateQuery) === TRUE) {
            $returnvalue = 1;
        } else {
            $returnvalue = "Error updating record: " . $this->_connection->error;
        }
        
        $this->_connection->close();
        return $returnvalue;
    }

    public function selectData($selectQuery) {
        $this->_connection = new mysqli($this->_serverName, $this->_username, $this->_password, $this->_dbname);

        if ($this->_connection->connect_error) {
            die("Connection failed: " . $this->_connection->connect_error);
        }

        $result = $this->_connection->query($selectQuery);
        
        $returnedResult = array();
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $returnedResult[] = $row;
            }
            
        } else {
            
            return 0;
        }
        $this->_connection->close();
        return $returnedResult;
    }
    
    public function deleteData($deleteQuery){
         $this->_connection = new mysqli($this->_serverName, $this->_username, $this->_password, $this->_dbname);
        
        $returnvalue = "";
        
        if ($this->_connection->connect_error) {
            die("Connection failed: " . $this->_connection->connect_error);
        }
        if ($this->_connection->query($deleteQuery) === TRUE) {
            $returnvalue = 1;
        } else {
            $returnvalue = "Error updating record: " . $this->_connection->error;
        }
        
        $this->_connection->close();
        return $returnvalue;
    }

}

