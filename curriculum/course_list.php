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

$PAGE->set_url(new moodle_url('/local/curriculum/course_list.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Courses');
$PAGE->requires->css('/local/curriculum/css/style.css');

global $DB, $OUTPUT;
//$catId = optional_param('catId', 0, PARAM_INT);*************

/************************/
// INSERT INTO mdl_track_courses (user_id, cat_id, course_id, complete)
// SELECT 
//     3 AS user_id,
//     5 AS cat_id,
//     id,
//     0 AS complete
// FROM 
//     mdl_course
// WHERE 
//     category = 5;
/************************/

// find all the categories except the top category
//$sql = "SELECT * FROM {course} WHERE id = $catId";***********
$sql = "SELECT * FROM {course} WHERE category = 5";//**************** */
$categories = array_values($DB->get_records_sql($sql));
$mytext= get_string('av_crs', 'local_curriculum');

$sql = "SELECT course_id, complete FROM {track_courses} WHERE user_id =3 ";
$temp = array_values($DB->get_records_sql($sql));

$role_id = 5;

// ***** page body starts here *****
echo $OUTPUT->header();

foreach($temp as $tmp){
    if(!$tmp->complete){
        $instance = $DB->get_record('enrol', ['courseid' => $tmp->course_id, 'enrol' => 'manual']);
        $enrolplugin = enrol_get_plugin($instance->enrol);
        $enrolplugin->enrol_user($instance, 3,$role_id, time(),0);
        break;
    }
}


if(sizeof($categories)){
    $mytext = get_string('all_av_crs', 'local_curriculum');
} 
$categories_template = (object)[
    'category' => $categories,
    'mytext' => $mytext,
    'myurl2' => new moodle_url($CFG->wwwroot . '/course/view.php'),  
    'myurl3' => new moodle_url($CFG->wwwroot . '/my') 
];
//var_dump($categories);
echo $OUTPUT->render_from_template('local_curriculum/course_list', $categories_template);
echo $OUTPUT->footer();