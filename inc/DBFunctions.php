<?php 
/**
 * @author Rainty Yek
 */

require_once ROOT_PATH . '/inc/Config.php';
require_once ROOT_PATH . '/inc/DatabaseConn.php';

class DBFunctions extends DatabaseConn {

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
}