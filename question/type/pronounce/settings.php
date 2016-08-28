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
 * Pronounce question settings page.
 *
 * @package    qtype_pronounce
 * @copyright  2016 Karaulnykh Denis
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    $settings->add(new admin_setting_configselect('qtype_pronounce/defaultanswerformat',
            get_string('defaultanswerformat', 'qtype_pronounce'), '', FORMAT_MOODLE, format_text_menu()));
            
           
/*    $soundTypes = array(
        'phoneme' => get_string('response', 'pronounce'),
        'word' => get_string('submitted', 'pronounce'),
        'phrase' => get_string('submitted', 'pronounce'),
    ); 
    $settings->add(new admin_setting_configmultiselect('questionnaire/downloadoptions',
            get_string('textdownloadoptions', 'questionnaire'), '', array_keys($choices), $choices));*/
            
    //$str = get_string('configserviceaddress', 'qtype_pronounce');  
    
    $settings->add(new admin_setting_configtext('qtype_pronounce/configserviceaddress', new lang_string('configserviceaddress', 'qtype_pronounce'), 
          new lang_string('configserviceaddress_desc', 'qtype_pronounce'), '', PARAM_TEXT));


    $choices = array();
    $choices['0'] = new lang_string('disable');
    $choices['1'] = new lang_string('enable');
    $settings->add(new admin_setting_configselect('qtype_pronounce/flash', new lang_string('enable_flash', 'qtype_pronounce'),
        new lang_string('enable_flash_help', 'qtype_pronounce'), 1, $choices));
//    $settings->add(new admin_setting_configtext('qtype_pronounce/configmark5stars',
//                                    get_string('configmark5starsdefault', 'qtype_pronounce'),
//                                    '', 10, PARAM_INT));
                                    
                                    
                                    
    $marks = array(
            1.0000000,
            0.8000000,
            0.6666666,
            0.6000000,
            0.5000000,
            0.4000000,
            0.3333333,
            0.2500000,
            0.2000000,
            0.1000000,
            0.0000000
        );
//        if (!empty($this->question->penalty) && !in_array($this->question->penalty, $penalties)) {
//            $penalties[] = $this->question->penalty;
//            sort($penalties);
//        }
        $marksoptions = array();
        foreach ($marks as $mark) {
            $marksoptions["{$mark}"] = (100 * $mark) . '%';
        }
//        $mform->addElement('select', 'penalty',
//                get_string('penaltyforeachincorrecttry', 'question'), $penaltyoptions);
//        $mform->addHelpButton('penalty', 'penaltyforeachincorrecttry', 'question');
//        $mform->setDefault('penalty', 0.3333333);                                 
                                    
                                    
       //                             new lang_string('gradeexportdecimalpoints', 'grades')
       $settings->add(new admin_setting_configselect('qtype_pronounce/configmark5stars', 
            new lang_string('configmark5starsdefault', 'qtype_pronounce'), '', 1, $marksoptions)); 
                                  
       $settings->add(new admin_setting_configselect('qtype_pronounce/configmark4stars', 
            new lang_string('configmark4starsdefault', 'qtype_pronounce'), '', '0.8', $marksoptions)); 
       $settings->add(new admin_setting_configselect('qtype_pronounce/configmark3stars', 
            new lang_string('configmark3starsdefault', 'qtype_pronounce'), '', '0.6', $marksoptions)); 
       $settings->add(new admin_setting_configselect('qtype_pronounce/configmark2stars', 
            new lang_string('configmark2starsdefault', 'qtype_pronounce'), '', '0.4', $marksoptions)); 
       $settings->add(new admin_setting_configselect('qtype_pronounce/configmark1stars', 
            new lang_string('configmark1starsdefault', 'qtype_pronounce'), '', '0.2', $marksoptions)); 
                                   
                                    
                                    
    //$settings->add(new admin_setting_configmultiselect('questionnaire/downloadoptions',
    //        get_string('textdownloadoptions', 'questionnaire'), '', array_keys($choices), $choices));      
}
