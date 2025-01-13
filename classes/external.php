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
                'platformid' => new external_value(PARAM_URL, 'The platform\'s URL'),
                'clientid' => new external_value(PARAM_TEXT, 'The platform\'s Client ID'),
                'openid' => new external_value(PARAM_URL, 'The platform\'s OpenID configuration URL'),
                'registration_token' => new external_value(PARAM_RAW, 'The registration token')
            )
        );
    }

    /**
     * Register an LTI platform.
     *
     * @param  string $name
     * @param  string $platformid
     * @param  string $clientid
     * @param  string $openid
     * @param  string $regtoken
     * @return array
     */
    public static function register_platform(string $name, string $platformid, string $clientid, string $openid, string $regtoken) {
        global $DB;

        // Create an incomplete registration.
        $regservice = new application_registration_service(
            new application_registration_repository(),
            new deployment_repository(),
            new resource_link_repository(),
            new context_repository(),
            new user_repository()
        );

        $data = new \stdClass();
        $data->name = $name;
        $data->platformid = $platformid;
        $data->clientid = $clientid;

        $registration = $regservice->create_draft_application_registration($data);

        $data->id = $registration->get_id();
        $DB->update_record('enrol_lti_app_registration', $data);

        $pending = new \stdClass();
        $pending->registrationid = $registration->get_id();
        $pending->openid = $openid;
        $pending->regtoken = $regtoken;
        
        $result = $DB->insert_record('enrol_lti_app_registration_pending', $pending);

        return ['result' => (bool) $result];
    }

    /**
     * register_platform return
     *
     * @return \core_external\external_single_structure
     */
    public static function register_platform_returns() {
        return new external_single_structure([
            'result' => new external_value(PARAM_BOOL, 'Result (successfully registered or not)')
        ]);
    }

    /**
     * check_registration parameters.
     *
     * @return external_function_parameters
     */
    public static function check_registration_parameters() {
        return new external_function_parameters(
            array(
                'platformid' => new external_value(PARAM_URL, 'The platform\'s URL'),
            )
        );
    }

    /**
     * Check if the platform is already registered
     *
     * @param  string $platformid
     * @return array Contains the result of the check
     */
    public static function check_registration(string $platformid) {
        global $DB;

        $sql = "SELECT *
                  FROM {enrol_lti_app_registration}
                 WHERE " . $DB->sql_compare_text('platformid') . ' = ' . $DB->sql_compare_text(':platformid');
        $result = $DB->record_exists_sql($sql, ['platformid' => $platformid]);

        return ['result' => $result];
    }

    /**
     * check_registration return
     *
     * @return \core_external\external_single_structure
     */
    public static function check_registration_returns() {
        return new external_single_structure([
            'result' => new external_value(PARAM_BOOL, 'Result (already registered or not)')
        ]);
    }
}
