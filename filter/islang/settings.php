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
 * @package    filter
 * @subpackage islang
 * @copyright  2010 David Mudrak <david@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {

//    $settings->add(new admin_setting_configmulticheckbox('filter_islang/formats',
//            get_string('settingformats', 'filter_islang'),
//            get_string('settingformats_desc', 'filter_islang'),
//            array(FORMAT_HTML => 1, FORMAT_MARKDOWN => 1, FORMAT_MOODLE => 1), format_text_menu()));

    $settings->add(new admin_setting_configtext('filter_islang/langstringprefix', new lang_string('langstringprefix', 'filter_islang'),
        new lang_string('langstringprefix_desc', 'filter_islang'), '))L((', PARAM_TEXT));

    $langs = array();
    $langs['en'] = new lang_string('english');
    $langs['ru'] = new lang_string('russian', 'filter_islang');
    $settings->add(new admin_setting_configselect('filter_islang/defaultlang', new lang_string('defaultlang', 'filter_islang'),
        new lang_string('defaultlang_desc', 'filter_islang'), 'en', $langs));

}
