<?php
/**
 * LTI Platform Registration plugin
 *
 * @package    local_lti_registration
 * @copyright  Josemaria Bolanos <admin@mako.digital>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$functions = array(
    'local_lti_check' => array(
        'classname'   => 'local_lti_registration\external',
        'methodname'  => 'check_registration',
        'classpath'   => '',
        'description' => 'Check if platform is registered.',
        'type'        => 'read',
    ),
    'local_lti_registration' => array(
        'classname'   => 'local_lti_registration\external',
        'methodname'  => 'register_platform',
        'classpath'   => '',
        'description' => 'Register new platform.',
        'type'        => 'write',
    ),
);
