<?php
/**
 * LTI Platform Registration plugin
 *
 * @package    local_lti_registration
 * @copyright  Josemaria Bolanos <admin@mako.digital>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_lti_registration\output;

defined('MOODLE_INTERNAL') || die();

use plugin_renderer_base;

class renderer extends plugin_renderer_base {
    /**
     * Render the table of registered platforms pending approval.
     *
     * @param array $registrations The list of registrations to render.
     * @return string the html.
     */
    public function render_admin_setting_pendingregistrations(array $registrations): string {
        global $DB;

        $registrationscontext = [
            'registrations' => [],
            'autoapprove' => get_config('local_lti_registration_autoapprove')
        ];
        $registrationscontext['hasregs'] = count($registrations) > 0;
        foreach ($registrations as $reg) {
            $pending = $DB->get_record('enrol_lti_app_registration_pending', ['registrationid' => $reg->get_id()], '*', MUST_EXIST);
            $regparams = [
                'token' => $reg->get_uniqueid(),
                'openid_configuration' => $pending->openid,
                'registration_token' => $pending->regtoken
            ];
            $status = get_string('registrationstatuspending', 'enrol_lti');
            $registrationscontext['registrations'][] = [
                'name' => $reg->get_name(),
                'issuer' => $reg->get_platformid(),
                'clientid' => $reg->get_clientid(),
                'statusstring' => $status,
                'approveurl' => (new \moodle_url('/enrol/lti/register.php', $regparams))->out(false),
                'deleteurl' => (new \moodle_url('/enrol/lti/register_platform.php',
                    ['action' => 'delete', 'regid' => $reg->get_id()]))->out(false)
            ];
        }

        $return = parent::render_from_template('local_lti_registration/pendingregistrations', $registrationscontext);

        return $return;
    }
}
