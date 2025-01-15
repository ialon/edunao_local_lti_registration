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

        // Select action.
        $options = [
            'local_lti_check' => get_string('check_registration', 'local_lti_registration'),
            'local_lti_registration' => get_string('register_platform', 'local_lti_registration')
        ];
        $mform->addElement('select', 'action', get_string('action', 'local_lti_registration'), $options);

        // Tool URL.
        $mform->addElement('text', 'url', get_string('url', 'local_lti_registration'));
        $mform->setType('url', PARAM_URL);
        // Local
        // $mform->setDefault('url', 'http://edunao.local');
        // Mako Moodle
        $mform->setDefault('url', 'https://moodle.mako.digital');

        // WS Token.
        $mform->addElement('text', 'token', get_string('token', 'local_lti_registration'));
        $mform->setType('token', PARAM_TEXT);
        // Local
        // $mform->setDefault('token', '00972cdf9b4c2bdd51a3a046c55d0829');
        // Mako Moodle
        $mform->setDefault('token', 'a662fd3fc60f5aa3c82f387195342b58');

        // Buttons.
        $this->add_action_buttons(true, get_string('submit'));
    }
}
