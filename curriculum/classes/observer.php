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

 defined('MOODLE_INTERNAL') || die();

 class local_curriculum_observer {
     public static function custom_course_complete(\core\event\course_completed $event) {
         $data= $event->get_data();
        //  var_dump(json_encode($data));
        //  die;
     
        //update the course count of the current category
        $up_track_course = new stdClass();
        $up_track_course->user_id= $data->userid;
        $up_track_course->course_id =  $data->courseid;
        $up_track_course->complete =  1;
        $sql = $DB->update_record('track_courses', $up_track_course);

        echo "gkabkgb: $data->userid <br> $data->courseid";
     }

     public static function user_created(\core\event\user_created $event) {
        $data= $event->get_data();
        var_dump($data);
        // die;
    }
 }
 