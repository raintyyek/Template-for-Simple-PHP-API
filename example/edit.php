<?php
/**
 * @author Rainty Yek
 */
  
define("ROOT_PATH", __DIR__ . '/..');

$allowed_methods = "PUT";
include_once ROOT_PATH . '/inc/APIGateway.php';

try {
    if (isset($_REQUEST['id']) && trim($_REQUEST['id']) &&
        isset($_REQUEST['label']) && trim($_REQUEST['label']) &&
        isset($_REQUEST['data']) && trim($_REQUEST['data'])) {
        $test_data_by_id = $db->getDataByID(trim($_REQUEST['id']));
        if ($test_data_by_id !== false) {
            $id = trim($_REQUEST['id']);
            $label = trim($_REQUEST['label']);
            $data = trim($_REQUEST['data']);
            $update_success = $db->updateDataByID($id, $label, $data);
            if ($update_success) {
                $response = array('success' => true, 'status' => 'SUCCESS');
            } else {
                $response['status'] = 'FAILED_TO_UPDATE';
            }
        } else {
            $response['status'] = 'NOT_FOUND';
        }
    } else {
        $response['status'] = 'MISSING_FIELDS';
    }
} catch (Exception $e) {
    // Exception
    throw New Exception($e->getMessage());
}

http_response_code($status_code);
die(json_encode($response, JSON_INVALID_UTF8_SUBSTITUTE | JSON_PARTIAL_OUTPUT_ON_ERROR));
?>