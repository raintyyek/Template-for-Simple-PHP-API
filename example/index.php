<?php
/**
 * @author Rainty Yek
 */
  
define("ROOT_PATH", __DIR__ . '/..');

$allowed_methods = "GET";
include_once ROOT_PATH . '/inc/APIGateway.php';

try {
    $response = array('success' => true, 'status' => 'SUCCESS', 'data' => $db->getTestsData());
} catch (Exception $e) {
    // Exception
    throw New Exception($e->getMessage());
}

http_response_code($status_code);
die(json_encode($response, JSON_INVALID_UTF8_SUBSTITUTE | JSON_PARTIAL_OUTPUT_ON_ERROR));
?>