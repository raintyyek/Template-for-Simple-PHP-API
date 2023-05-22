# Template for Simple PHP API

This is a template for Simple PHP API. The Supported DBMS for this template is MySQL.

**Author:** [Rainty Yek](https://github.com/raintyyek)

**License:** MIT


# Setup
Copy content of inc/Config.example.php to inc/Config.php. And then replace Database Configs with your own DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE

```php
<?php 
    /**
     * API Configs
    */
    define("VALIDATE_WITH_KEY", false);
    define("ENCRYPT_KEY", "XXXXXXXXXXX");

    /**
     * Database config variables
    */
    define("DB_HOST", "XXXXXXXX");
    define("DB_USER", "XXXXXXXX");
    define("DB_PASSWORD", "XXXXXXX");
    define("DB_DATABASE", "XXXXXXX");
?>
```


# Usage

## DB Functions
Add your custom DB functions to inc/DBFunctions.php
### E.g
```php


    /**
     *  Get All Data From tests table
     * @return array
     */
    public function getTestsData() {
        return $this->select("SELECT * FROM tests");
    }
    
    /**
     * Add Test Data
     * @param string $label Label
     * @param string $data Data
     * @return bool
     */
    public function addTestData($label, $data) {
        return $this->insert("INSERT INTO tests (label, data) VALUES (?,?)", ['ss', $label, $data]);
    }
    
    /**
     * Update Data by id
     * @param int $id ID
     * @param string $label Label
     * @param string $data Data
     * @return bool
     */
    public function updateDataByID($id, $label, $data) {
        return $this->update("UPDATE tests SET label=?, data=? WHERE id=?", ['iss', $label, $data, $id]);
    }
    
    /**
     * Delete Data by id
     * @param int $id ID
     * @return bool
     */
    public function deleteDataByID($id) {
        return $this->delete("DELETE FROM tests WHERE id=?", ['i', $id]);
    }

    /**
     *  Get Data By ID From tests table
     * @param Int $id ID of test data
     * @return array
     */
    public function getDataByID($id) {
        $test_data = $this->select("SELECT * FROM tests WHERE id = ?", ['i', $id]);
        return $test_data[0] ?? false;
    }
```


## API
- Create a folder for your custom API module (e.g ROOT_PATH/example)
- Create PHP Scripts for your APIs and copy & modify codes from the template below
### E.g
```php
<?php
    /**
     * @author Rainty Yek
     */
    
    define("ROOT_PATH", __DIR__ . '/..');

    $allowed_methods = "GET";
    include_once ROOT_PATH . '/inc/APIGateway.php';

    try {
        if (isset($_REQUEST['id']) && trim($_REQUEST['id'])) {
            $test_data_by_id = $db->getDataByID(trim($_REQUEST['id']));
            if ($test_data_by_id !== false) {
                $response = array('success' => true, 'status' => 'SUCCESS', 'data' => $test_data_by_id);
            } else {
                $response['status'] = 'NOT_FOUND';
            }
        } else {
            $response['status'] = 'MISSING_ID';
        }
    } catch (Exception $e) {
        // Exception
        throw New Exception($e->getMessage());
    }

    http_response_code($status_code);
    die(json_encode($response, JSON_INVALID_UTF8_SUBSTITUTE | JSON_PARTIAL_OUTPUT_ON_ERROR));
?>
```