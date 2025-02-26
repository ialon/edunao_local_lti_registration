<?php
/**
 * LTI Platform Registration plugin
 *
 * @package    local_lti_registration
 * @copyright  Josemaria Bolanos <admin@mako.digital>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['pluginname'] = "Registro de Plataformas LTI";

// Configuraciones
$string['pendingregistrations'] = "Registros pendientes";
$string['authorize'] = "Autorizar";
$string['nopendingregistrations'] = "No hay registros pendientes";
$string['autoapprove'] = "Aprobación automática";
$string['autoapprove_desc'] = "Aprobar nuevos registros automáticamente";

// Correo de notificación
$string['notify_registration_subject'] = "Nueva plataforma LTI registrada";
$string['notify_registration_body'] = 'Se ha registrado una nueva plataforma LTI. Nombre: {$a->name}, Emisor: {$a->issuer}';

// Formulario de prueba
$string['generate'] = "Generar llamadas al Webservice";
$string['action'] = "Seleccionar llamada";
$string['check_registration'] = "Verificar registro";
$string['register_platform'] = "Registrar plataforma";
$string['url'] = "URL de la herramienta";
$string['token'] = "Token de accesso";
$string['local_lti_check_success'] = "La plataforma ya está registrada";
$string['local_lti_check_error'] = "La plataforma no está registrada";
$string['local_lti_registration_approved'] = "El registro de la plataforma ha sido aprobado.";
$string['local_lti_registration_success'] = "Plataforma registrada con éxito";
$string['local_lti_registration_error'] = "El registro de la plataforma falló";
