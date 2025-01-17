<?php
/**
 * LTI Platform Registration plugin
 *
 * @package    local_lti_registration
 * @copyright  Josemaria Bolanos <admin@mako.digital>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
$string['pluginname'] = "Enregistrement de la plateforme LTI";

// Paramètres
$string['pendingregistrations'] = "Inscriptions en attente";
$string['authorize'] = "Autoriser";
$string['nopendingregistrations'] = "Aucune inscription en attente";
$string['autoapprove'] = "Approbation automatique";
$string['autoapprove_desc'] = "Approuver automatiquement les nouvelles inscriptions";

// Email de notification
$string['notify_registration_subject'] = "Nouvelle plateforme LTI enregistrée";
$string['notify_registration_body'] = 'Une nouvelle plateforme LTI a été enregistrée. Nom : {$a->name}, Émetteur : {$a->issuer}';

// Formulaire de test
$string['generate'] = "Générer des appels au Webservice";
$string['action'] = "Sélectionner l'appel";
$string['check_registration'] = "Vérifier l'inscription";
$string['register_platform'] = "Enregistrer la plateforme";
$string['url'] = "URL de l'outil";
$string['token'] = "Jeton WS";
$string['local_lti_check_success'] = "La plateforme est déjà enregistrée";
$string['local_lti_check_error'] = "La plateforme n'est pas enregistrée";
$string['local_lti_registration_approved'] = "L'inscription de la plateforme a été approuvée.";
$string['local_lti_registration_success'] = "Plateforme enregistrée avec succès";
$string['local_lti_registration_error'] = "L'inscription de la plateforme a échoué";
