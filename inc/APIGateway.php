<?php
/**
 * @author Rainty Yek
 */

require_once ROOT_PATH . '/inc/Config.php';
require_once ROOT_PATH . '/inc/DBFunctions.php';

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Max-Age: 86400');
    header("Access-Control-Allow-Methods: " . (!isset($allowed_methods) || !$allowed_methods ? "GET,PUT,POST,DELETE,PATCH,OPTIONS" : $allowed_methods));
}

header('Content-Type: application/json; charset=UTF-8');
date_default_timezone_set('Asia/Singapore');

$db = new DBFunctions();

$status_code = 200;
$response = array('success' => false, 'status' => 'INVALID_REQUEST');

$gateway_validated = false;
// Validate Encryption Key
if (!(VALIDATE_WITH_KEY ?? false)) {
    $gateway_validated = true;
} else if (isset($_REQUEST['api_key']) && trim($_REQUEST['api_key']) &&
    md5(ENCRYPT_KEY) === trim($_REQUEST['api_key'])) {
    $gateway_validated = true;
}

// Return Response if not validated
if (!$gateway_validated) {
    $status_code = 401;
    $response['status'] = 'UNAUTHORIZED';
    http_response_code($status_code);
    die(json_encode($response, JSON_INVALID_UTF8_SUBSTITUTE | JSON_PARTIAL_OUTPUT_ON_ERROR));
}