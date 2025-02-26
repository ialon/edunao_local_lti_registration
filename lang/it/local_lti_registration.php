<?php
/**
 * LTI Platform Registration plugin
 *
 * @package    local_lti_registration
 * @copyright  Josemaria Bolanos <admin@mako.digital>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['pluginname'] = "Registrazione Piattaforma LTI";

// Impostazioni
$string['pendingregistrations'] = "Registrazioni in sospeso";
$string['authorize'] = "Autorizza";
$string['nopendingregistrations'] = "Nessuna registrazione in sospeso";
$string['autoapprove'] = "Approvazione automatica";
$string['autoapprove_desc'] = "Approva automaticamente le nuove registrazioni";

// Email di notifica
$string['notify_registration_subject'] = "Nuova piattaforma LTI registrata";
$string['notify_registration_body'] = 'È stata registrata una nuova piattaforma LTI. Nome: {$a->name}, Emittente: {$a->issuer}';

// Modulo di test
$string['generate'] = "Genera chiamate al Webservice";
$string['action'] = "Seleziona chiamata";
$string['check_registration'] = "Verifica registrazione";
$string['register_platform'] = "Registra piattaforma";
$string['url'] = "URL dello strumento";
$string['token'] = "Token WS";
$string['local_lti_check_success'] = "La piattaforma è già registrata";
$string['local_lti_check_error'] = "La piattaforma non è registrata";
$string['local_lti_registration_approved'] = "La registrazione della piattaforma è stata approvata.";
$string['local_lti_registration_success'] = "Piattaforma registrata con successo";
$string['local_lti_registration_error'] = "Registrazione della piattaforma fallita";
