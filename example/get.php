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