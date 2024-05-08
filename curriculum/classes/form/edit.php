<?php 
/**
 * Version details.
 *
 * @package   local_curriculum
 * @copyright 2024 Rifat Arefin
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 // moodleform is defined in formslib.php
require_once("$CFG->libdir/formslib.php");

class edit extends moodleform {
    // Add elements to form.
    public function definition() {
        global $CFG;
        $mform = $this->_form; // Don't forget the underscore!
        if(isset($this->_customdata['courses'])){
            foreach($this->_customdata['courses'] as $course){
                $mform->addElement('checkbox', $course->id, $course->fullname);
                $mform->setDefault($course->id, null);
            }
        }
        // $mform->addElement('checkbox', 'catId',);
        // $mform->setDefault('catId', $this->_customdata['catId']);
        
        // $mform->addElement('hidden', 'catId', $this->_customdata['catId']);
        // $mform->setDefault('catId', $this->_customdata['catId']);
        $mform->addElement('hidden', 'catId', (int)$this->_customdata['catId']);
        $mform->setType('catId', PARAM_INT);
        
        $this->add_action_buttons();  
    }

    // Custom validation should be added here.
    function validation($data, $files) {
        return [];
    }
}