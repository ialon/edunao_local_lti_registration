<?php
/**
 * LTI Platform Registration plugin
 *
 * @package    local_lti_registration
 * @copyright  Josemaria Bolanos <admin@mako.digital>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_lti_registration;

use core_external\external_api;
use core_external\external_function_parameters;
use core_external\external_value;
use core_external\external_single_structure;

use enrol_lti\local\ltiadvantage\repository\application_registration_repository;
use enrol_lti\local\ltiadvantage\repository\context_repository;
use enrol_lti\local\ltiadvantage\repository\deployment_repository;
use enrol_lti\local\ltiadvantage\repository\resource_link_repository;
use enrol_lti\local\ltiadvantage\repository\user_repository;
use enrol_lti\local\ltiadvantage\service\application_registration_service;

class external extends external_api {
    /**
     * register_platform parameters.
     *
     * @return external_function_parameters
     */
    public static function register_platform_parameters() {
        return new external_function_parameters(
            array(
                'name' => new external_value(PARAM_TEXT, 'The platform\'s name'),
                'openid' => new external_value(PARAM_URL, 'The platform\'s OpenID configuration URL'),
                'registration_token' => new external_value(PARAM_RAW, 'The registration token')
            )
        );
    }

    /**
     * Register an LTI platform.
     *
     * @param  string $name
     * @param  string $openid
     * @param  string $regtoken
     * @return void
     */
    public static function register_platform(string $name, string $openid, string $regtoken) {
        // Create an incomplete registration.
        $regservice = new application_registration_service(
            new application_registration_repository(),
            new deployment_repository(),
            new resource_link_repository(),
            new context_repository(),
            new user_repository()
        );
        $draft = $regservice->create_draft_application_registration((object) ['name' => $name]);

        // Get the registration URL
        $regrepo = new application_registration_repository();
        $registration = $regrepo->find($draft->get_id());
        $regurl = new \moodle_url('/enrol/lti/register.php', ['token' => $registration->get_uniqueid()]);
        $regurl->param('openid_configuration', $openid);
        $regurl->param('registration_token', $regtoken);
        
        redirect($regurl);
    }

    /**
     * register_platform return
     *
     * @return \core_external\external_description
     */
    public static function register_platform_returns(): void {}

    /**
     * check_registration parameters.
     *
     * @return external_function_parameters
     */
    public static function check_registration_parameters() {
        return new external_function_parameters(
            array(
                'url' => new external_value(PARAM_URL, 'The platform\'s URL'),
            )
        );
    }

    /**
     * Check if the platform is already registered
     *
     * @param  string $url
     * @return array Contains the result of the check
     */
    public static function check_registration(string $url) {
        global $DB;

        $result = $DB->record_exists('enrol_lti_app_registration', ['platformid' => $url]);

        return ['result' => $result];
    }

    /**
     * check_registration return
     *
     * @return \core_external\external_description
     */
    public static function check_registration_returns() {
        return new external_single_structure([
            'result' => new external_value(PARAM_BOOL, 'Result (already registered or not)')
        ]);
    }
}
