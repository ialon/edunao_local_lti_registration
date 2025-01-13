<?php
/**
 * LTI Platform Registration plugin
 *
 * @package    local_lti_registration
 * @copyright  Josemaria Bolanos <admin@mako.digital>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

// Create a tool settings page for new registrations pending authorization.
$settings = new admin_settingpage(
    'enrolsettingslti_pendingregistrations',
    get_string('pendingregistrations', 'local_lti_registration'),
    'moodle/site:config',
    $this->is_enabled() === false
);

$settings->add(
    new admin_setting_heading(
        'enrol_lti_tool_pendingregistrations_heading',
        get_string('pendingregistrations', 'local_lti_registration'),
        ''
    )
);
$settings->add(new \local_lti_registration\admin_setting_pendingregistrations());

$ADMIN->add('enrolltifolder', $settings);
