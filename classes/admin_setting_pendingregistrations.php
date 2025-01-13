<?php
/**
 * LTI Platform Registration plugin
 *
 * @package    local_lti_registration
 * @copyright  Josemaria Bolanos <admin@mako.digital>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_lti_registration;

use enrol_lti\local\ltiadvantage\repository\application_registration_repository;

/**
 * The admin_setting_pendingregistrations class, for rendering a table of platforms which have been registered but are pending authorization.
 */
class admin_setting_pendingregistrations extends \admin_setting {
    /**
     * Calls parent::__construct with specific arguments
     */
    public function __construct() {
        $this->nosave = true;
        parent::__construct(
            'enrol_lti_tool_pendingregistrations',
            get_string('pendingregistrations', 'local_lti_registration'),
            '',
            ''
        );
    }

    /**
     * Always returns true, does nothing.
     *
     * @return bool true.
     */
    public function get_setting() {
        return true;
    }

    /**
     * Always returns true, does nothing.
     *
     * @return bool true.
     */
    public function get_defaultsetting() {
        return true;
    }

    /**
     * Always returns '', does not write anything.
     *
     * @param string|array $data the data
     * @return string Always returns ''.
     */
    public function write_setting($data) {
        return '';
    }

    /**
     * Checks if $query is one of the available external services
     *
     * @param string $query The string to search for
     * @return bool Returns true if found, false if not
     */
    public function is_related($query) {
        if (parent::is_related($query)) {
            return true;
        }

        $appregistrationrepo = new application_registration_repository();
        $registrations = $appregistrationrepo->find_all();
        foreach ($registrations as $reg) {
            if ($reg->is_complete()) {
                continue;
            }
            if (stripos($reg->get_name(), $query) !== false) {
                return true;
            }
        }
        return false;
    }

    /**
     * Builds the HTML to display the table.
     *
     * @param string $data Unused
     * @param string $query
     * @return string
     */
    public function output_html($data, $query='') {
        global $PAGE;

        $appregistrationrepo = new application_registration_repository();
        $renderer = $PAGE->get_renderer('local_lti_registration');
        $allplatforms = $appregistrationrepo->find_all();
        $platforms = [];
        foreach ($allplatforms as $platform) {
            if (!$platform->is_complete()) {
                $platforms[] = $platform;
            }
        }
        $return = $renderer->render_admin_setting_pendingregistrations($platforms);
        return highlight($query, $return);
    }
}
