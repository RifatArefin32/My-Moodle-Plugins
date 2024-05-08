<?php 
/**
 * Version details.
 *
 * @package   local_curriculum
 * @copyright 2024 Rifat Arefin
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . '/local/curriculum/classes/form/edit.php');

//This snippet is the part of Purge_caches
// define('CLI_SCRIPT', true);
// require_once($CFG->libdir.'/clilib.php');

$PAGE->set_url(new moodle_url('/local/curriculum/edit.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Edit Curriculum');

global $DB;
$sql = "SELECT * FROM {course} WHERE id != 1";
$courses = $DB->get_records_sql($sql);


//var_dump($courses);
global $DB, $OUTPUT;
$catId=optional_param('id',0,PARAM_INT); //course ID

$courses_from_db = [
    'courses' => $courses,
    'catId' => $catId,
];

$mform = new edit(null, $courses_from_db);
if ($mform->is_cancelled()) {
    redirect(new moodle_url('/local/curriculum/manage.php'), get_string('no_crs_added', 'local_curriculum'));
} else if ($fromform = $mform->get_data()) {

    //  var_dump($fromform);
    //  echo "<br>";
    // // die;
    $flag = false;
    
    foreach($fromform as $key=>$value){
        if((string)(int)$key==$key){

            // ***** Update the course count of current and updated categories *****

            //find the current category of the checked course from course table
            $sql = "SELECT category FROM {course} WHERE id = $key";
            $courses = array_values($DB->get_records_sql($sql));
            $temp = $courses[0]->category;

            //find the course count of the current category
            $sql = "SELECT coursecount FROM {course_categories} WHERE id = $temp";
            $courses = array_values($DB->get_records_sql($sql));
            $temp_cnt = $courses[0]->coursecount;

            //update the course count of the current category
            $up_course_cat = new stdClass();
            $up_course_cat->id = $temp;
            $up_course_cat->coursecount =  $temp_cnt-1;
            $sql = $DB->update_record('course_categories', $up_course_cat);

            //Find the course count of the updated category
            $sql = "SELECT coursecount FROM {course_categories} WHERE id =  $fromform->catId";
            $courses = array_values($DB->get_records_sql($sql));
            $temp_cnt = $courses[0]->coursecount;

            //update the course count of the updated category            
            $up_course_cat = new stdClass();
            $up_course_cat->id =  $fromform->catId;
            $up_course_cat->coursecount =  $temp_cnt+1;
            $sql = $DB->update_record('course_categories', $up_course_cat);

            // ***** update the category of the checked course from course table *****
            $up_course = new stdClass();
            $up_course->id = $key;
            $up_course->category =  $fromform->catId;
            $sql = $DB->update_record('course', $up_course);
        }
    }
    // //purge caches before redirect
    // cli_purge_caches();
    redirect($CFG->wwwroot . '/local/curriculum/manage.php', get_string('crs_added', 'local_curriculum'));

} else {
    echo $OUTPUT->header();
    $mform->display();
    echo $OUTPUT->footer();
}


