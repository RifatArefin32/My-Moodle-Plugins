<?php 
/**
 * Version details.
 *
 * @package   local_curriculum
 * @copyright 2024 Rifat Arefin
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// require_once(__DIR__ . './../../config.php');
require_once(__DIR__ . '/../../../config.php');

use local_curriculum\observer;
$observers = array(
    array(
        'eventname'   => '\core\event\course_completed',
        'callback'    => 'local_curriculum_observer::on_course_completed',
    ),
);