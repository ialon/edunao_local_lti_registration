<?php

require_once(__DIR__ . '/../../config.php');

use Firebase\JWT\JWT;
use mod_lti\local\ltiopenid\jwks_helper;
use mod_lti\local\ltiopenid\registration_helper;

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
    echo $OUTPUT->header();
    $generateform->set_data($data);
    $generateform->display();

    $base = new \moodle_url('/webservice/rest/server.php');
    $base->param('wstoken', $data->token);
    $base->param('moodlewsrestformat', 'json');

    // Print URL for check_registration
    $check = clone $base;
    $check->param('wsfunction', 'local_lti_check');
    $check->param('url', $data->url);
    echo html_writer::div($check->out());

    // Print URL for register_platform
    $register = clone $base;
    $register->param('wsfunction', 'local_lti_registration');
    $register->param('name', $data->name);
    $register->param('openid', $data->openid);
    $register->param('registration_token', $data->registration_token);
    echo html_writer::div($register->out());

    /*

    echo '<pre>';
    
    echo "https://moodle.mako.digital/enrol/lti/register.php?token=0992496d6c75fc29f98ec4dc978c145abe0f3400f2bfd68e9191d58df976";
    
    echo "&amp;";
    
    $confurl = new \moodle_url('/mod/lti/openid-configuration.php');
    echo "openid_configuration=" . htmlspecialchars($confurl->out(false));
    
    echo "&amp;";
    
    $sub = registration_helper::get()->new_clientid();
    $scope = registration_helper::REG_TOKEN_OP_NEW_REG;
    $now = time();
    $token = [
        "sub" => $sub,
        "scope" => $scope,
        "iat" => $now,
        "exp" => $now + HOURSECS
    ];
    $privatekey = jwks_helper::get_private_key();
    $regtoken = JWT::encode($token, $privatekey['key'], 'RS256', $privatekey['kid']);
    echo "registration_token=" . $regtoken;
    
    echo '</pre>';



    require_sesskey();
    $sub = registration_helper::get()->new_clientid();
    $scope = registration_helper::REG_TOKEN_OP_NEW_REG;
    if ($typeid > 0) {
        // In the context of an update, the sub is the id of the type.
        $sub = strval($typeid);
        $scope = registration_helper::REG_TOKEN_OP_UPDATE_REG;
    }
    $now = time();
    $token = [
        "sub" => $sub,
        "scope" => $scope,
        "iat" => $now,
        "exp" => $now + HOURSECS
    ];
    $privatekey = jwks_helper::get_private_key();
    $regtoken = JWT::encode($token, $privatekey['key'], 'RS256', $privatekey['kid']);
    $confurl = new moodle_url('/mod/lti/openid-configuration.php');
    $url = new moodle_url($starturl);
    $url->param('openid_configuration', $confurl->out(false));
    $url->param('registration_token', $regtoken);
    header("Location: ".$url->out(false));

    */

} else {
    echo $OUTPUT->header();
    $generateform->display();
}
echo $OUTPUT->footer();

