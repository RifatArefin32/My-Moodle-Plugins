<?php 
/**
 * Version details.
 *
 * @package   local_curriculum
 * @copyright 2024 Rifat Arefin
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . './../../config.php');

//Require Login before entering this page
try {
   require_login();
} catch (Exception $exception) {
   print_r($exception);
}

$PAGE->set_url(new moodle_url('/local/curriculum/manage.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Curriculums');
$PAGE->requires->css('/local/curriculum/css/style.css');

global $DB, $OUTPUT;

// find all the categories except the top category
$sql = "SELECT * FROM {course_categories} WHERE id!= 1";
$categories = array_values($DB->get_records_sql($sql));
$mytext= get_string('av_curr', 'local_curriculum');

// ***** page body starts here *****
echo $OUTPUT->header();
if(sizeof($categories)){
    $mytext = get_string('all_av_curr', 'local_curriculum');
} 
$categories_template = (object)[
    'category' => $categories,
    'mytext' => $mytext,
    'myurl' => new moodle_url('/local/curriculum/edit.php'),
    'myurl2' => new moodle_url($CFG->wwwroot . '/course/management.php'),  
    'myurl3' => new moodle_url($CFG->wwwroot . '/course/editcategory.php?parent=0') 
];
echo $OUTPUT->render_from_template('local_curriculum/manage', $categories_template);
echo $OUTPUT->footer();