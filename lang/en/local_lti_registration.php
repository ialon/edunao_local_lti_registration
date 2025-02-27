<?php
/**
 * LTI Platform Registration plugin
 *
 * @package    local_lti_registration
 * @copyright  Josemaria Bolanos <admin@mako.digital>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['pluginname'] = "LTI Platform Registration";

// Settings
$string['pendingregistrations'] = "Pending registrations";
$string['authorize'] = "Authorize";
$string['nopendingregistrations'] = "No pending registrations";
$string['autoapprove'] = "Auto approve";
$string['autoapprove_desc'] = "Automatically approve new registrations";

// Notification email
$string['notify_registration_subject'] = "New LTI platform registered";
$string['notify_registration_body'] = 'A new LTI platform has been registered. Name: {$a->name}, Issuer: {$a->issuer}';

// Test form
$string['generate'] = "Generate calls to Webservice";
$string['action'] = "Select call";
$string['check_registration'] = "Check registration";
$string['register_platform'] = "Register platform";
$string['url'] = "Tool URL";
$string['token'] = "WS Token";
$string['local_lti_check_success'] = "Platform is already registered";
$string['local_lti_check_error'] = "Platform is not registered";
$string['local_lti_registration_approved'] = "Platform registration has been approved.";
$string['local_lti_registration_success'] = "Platform registered successfully";
$string['local_lti_registration_error'] = "Platform registration failed";
