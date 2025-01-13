<?php
/**
 * LTI Platform Registration plugin
 *
 * @package    local_lti_registration
 * @copyright  Josemaria Bolanos <admin@mako.digital>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once($CFG->libdir . '/formslib.php');

/**
 * Class generate_form
*/
class generate_form extends moodleform {

    /**
     * Form definition
     */
    public function definition(): void {
        global $CFG;

        $mform =& $this->_form;

        // WS Token
        $mform->addElement('text', 'token', get_string('token', 'local_lti_registration'));
        $mform->setType('token', PARAM_TEXT);
        // Local
        // $mform->setDefault('token', '00972cdf9b4c2bdd51a3a046c55d0829');
        // Mako Moodle
        $mform->setDefault('token', '1a515f7c4a7f138d98386a28ecabfa2b');

        // Platform URL
        $mform->addElement('text', 'url', get_string('url', 'local_lti_registration'));
        $mform->setType('url', PARAM_URL);
        $mform->setDefault('url', 'https://sandbox.moodledemo.net');

        // Platform name
        $mform->addElement('text', 'name', get_string('sitename', 'hub'), array('maxlength' => 255));
        $mform->setType('name', PARAM_TEXT);
        $mform->addHelpButton('name', 'sitename', 'hub');
        $mform->setDefault('name', 'Moodle Demo');

        // OpenID configuration URL
        $mform->addElement('text', 'openid', get_string('openid_configuration', 'local_lti_registration'));
        $mform->setType('openid', PARAM_URL);
        $mform->setDefault('openid', 'https://sandbox.moodledemo.net/mod/lti/openid-configuration.php');

        // Registration token
        $mform->addElement('text', 'registration_token', get_string('registration_token', 'local_lti_registration'));
        $mform->setType('registration_token', PARAM_TEXT);
        $mform->setDefault('registration_token', '0992496d6c75fc29f98ec4dc978c145abe0f3400f2bfd68e9191d58df976');

        // Buttons.
        $this->add_action_buttons(true, get_string('savechanges'));
    }
}
