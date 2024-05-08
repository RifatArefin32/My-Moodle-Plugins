<?php 
/**
 * Version details.
 *
 * @package   local_curriculum
 * @copyright 2024 Rifat Arefin
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 require_once(__DIR__ . './../../config.php');

 $PAGE->set_url(new moodle_url('/local/curriculum/curriculum_list.php'));
 $PAGE->set_context(\context_system::instance());
 $PAGE->set_title('Curriculums');

global $DB, $OUTPUT;
$catId=optional_param('id',0,PARAM_INT);

// $sql="SELECT * FROM {course} WHERE category = $catId";
$sql="SELECT * FROM {course}";
$courses = $DB->get_records_sql($sql);
// echo "<pre>";
// var_dump($Courses);

echo $OUTPUT->header();
$course_template = (object)[
    'category' => array_values($courses),
];
echo $OUTPUT->render_from_template('local_curriculum/list', $course_template);
echo $OUTPUT->footer();


