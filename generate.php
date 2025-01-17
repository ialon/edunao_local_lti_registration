<?php
/**
 * LTI Platform Registration plugin
 *
 * @package    local_lti_registration
 * @copyright  Josemaria Bolanos <admin@mako.digital>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . '/mod/lti/locallib.php');

$tooldomain = optional_param('tooldomain', null, PARAM_LOCALURL);

require_login();

$context = context_system::instance();

$title = get_string('generate', 'local_lti_registration');

$PAGE->set_context($context);
$PAGE->set_url('/local/lti_registration/generate.php');
$PAGE->navbar->add($title);
$PAGE->set_heading($title);

require_once('generate_form.php');
$generateform = new generate_form('generate.php');

if ($generateform->is_cancelled()) {
    redirect($CFG->wwwroot . '/local/lti_registration/generate.php');
} else if ($data = $generateform->get_data()) {
    $generateform->set_data($data);

    $result = \local_lti_registration\webservice::call($data->action, $data->url, $data->token);

    if ($result) {
        $message = get_string($data->action . '_success', 'local_lti_registration');
        $type = \core\output\notification::NOTIFY_SUCCESS;
    } else {
        $message = get_string($data->action . '_error', 'local_lti_registration');
        $type = \core\output\notification::NOTIFY_ERROR;
    }
}

// Activate the tool on the client side
if ($tooldomain && confirm_sesskey()) {
    $types = lti_get_tools_by_url($tooldomain, LTI_TOOL_STATE_PENDING);
    if ($type = reset($types)) {
        $type->state = LTI_TOOL_STATE_CONFIGURED;
        lti_update_type($type, new stdClass());

        $message = get_string('local_lti_registration_approved', 'local_lti_registration');
        $type = \core\output\notification::NOTIFY_SUCCESS;
    }

}

echo $OUTPUT->header();

if (isset($message)) {
    echo $OUTPUT->notification($message, $type);
}

$generateform->display();

echo $OUTPUT->footer();
