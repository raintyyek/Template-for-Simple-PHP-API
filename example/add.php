<?php
/**
 * @author Rainty Yek
 */
  
define("ROOT_PATH", __DIR__ . '/..');

$allowed_methods = "POST";
include_once ROOT_PATH . '/inc/APIGateway.php';

try {
    if (isset($_REQUEST['label']) && trim($_REQUEST['label']) &&
        isset($_REQUEST['data']) && trim($_REQUEST['data'])) {
        $label = trim($_REQUEST['label']);
        $data = trim($_REQUEST['data']);
        $insert_success = $db->addTestData($label, $data);
        if ($insert_success) {
            $response = array('success' => true, 'status' => 'SUCCESS');
        } else {
            $response['status'] = 'FAILED_TO_ADD';
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