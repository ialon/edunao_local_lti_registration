<?php
/**
 * LTI Platform Registration plugin
 *
 * @package    local_lti_registration
 * @copyright  Josemaria Bolanos <admin@mako.digital>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 use enrol_lti\local\ltiadvantage\entity\application_registration;
 
/**
 * Send a notification when a new plaform is registered.
 *
 * @param application_registration $registration the application_registration instance
 * @return void
 */
function notify_registration($registration) {
    $sender = \core_user::get_noreply_user();
    $subject = get_string('notify_registration_subject', 'local_lti_registration');

    $name = $registration->get_name();
    $issuer = $registration->get_platformid();
    $body = get_string('notify_registration_body', 'local_lti_registration', ['name' => $name, 'issuer' => $issuer]);

    $admins = get_admins();
    foreach ($admins as $admin) {
        email_to_user(
            $admin,
            $sender,
            $subject,
            html_to_text($body),
            $body
        );
    }
}
