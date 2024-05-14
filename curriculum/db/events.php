<?php 
/**
 * Version details.
 *
 * @package   local_curriculum
 * @copyright 2024 Rifat Arefin
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../../config.php');

$observers = array(
    array(
        'eventname'   => '\core\event\course_completed',
        'callback'    => 'local_curriculum_observer::custom_course_complete',
    ),[
        'eventname'   => '\core\event\user_created',
        'callback'    => 'local_curriculum_observer::user_created',
    ]
);