<?php 
/**
 * @author Rainty Yek
 */

class DatabaseConn {
    protected $conn;

    /**
     * Constructor
     * 
     * Initialize DB Connection
     */
    public function __construct() 
    {
        // Establish Database Connection
        $this->conn = $this->connect();
    }

    // Connecting to database
    protected function connect() 
    {
        // Connect to Database
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        
        // Return DB Conn
        return $this->conn;
    }

    // Perform Insert Query
    public function insert($query = "" , $params = []) 
    {
        try {
            $stmt = $this->executeQuery($query , $params);
            $result = false;
            if ($stmt) {
                $result = true;
            }
            $stmt->close();
            return $result;
        } catch(Exception $e) {
            throw New Exception($e->getMessage());
        }
        return false;
    }

    // Perform Select Query
    public function select($query = "" , $params = []) 
    {
        try {
            $stmt = $this->executeQuery($query, $params);
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);               
            $stmt->close();
 
            return $result;
        } catch(Exception $e) {
            throw New Exception($e->getMessage());
        }
        return false;
    }
    
    // Perform Update Query
    public function update($query = "" , $params = [])
    {
        try {
            $stmt = $this->executeQuery($query , $params);
            $result = false;
            if ($stmt) {
                $result = true;
            }
            $stmt->close();
            return $result;
        } catch(Exception $e) {
            throw New Exception($e->getMessage());
        }
        return false;
    }
    
    // Perform Delete Query
    public function delete($query = "" , $params = [])
    {
        try {
            $stmt = $this->executeQuery($query , $params);
            $result = false;
            if ($stmt) {
                $result = true;
            }
            $stmt->close();
            return $result;
        } catch(Exception $e) {
            throw New Exception($e->getMessage());
        }
        return false;
    }

    // Execute Query
    private function executeQuery($query = "" , $params = []) {
        try {
            $stmt = $this->conn->prepare($query);
 
            if ($stmt === false) {
                throw New Exception("SQL Error: " . $query);
            }
 
            if ($params) {
                $params_definition = $params[0] ? $params[0] : '';
                array_shift($params);
                $stmt->bind_param($params_definition, ...$params);
            }
 
            $stmt->execute();
 
            return $stmt;
        } catch(Exception $e) {
            throw New Exception($e->getMessage());
        }   
    }
}