<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Version details.
 *
 * @package   local_curriculum
 * @copyright 2024 Rifat Arefin
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_curriculum\observer;
 defined('MOODLE_INTERNAL') || die();


 use core\event\course_completed;
 
 class local_curriculum_observer {
     /**
      * Event observer for course completion.
      * @param \core\event\course_completed $event
      */
     public static function on_course_completed(course_completed $event) {
         // You can perform actions here when a course is completed.
         // For example, auto-enrollment of users into another course.
         var_dump("Course is Finished!");
     }
 }
 