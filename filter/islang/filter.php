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
 * Filter converting islang texts into images
 *
 * This filter uses the islang settings in Site admin > Appearance > HTML settings
 * and replaces islang texts with images.
 *
 * @package    filter
 * @subpackage islang
 * @see        islang_manager
 * @copyright  2010 David Mudrak <david@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class filter_islang extends moodle_text_filter {

    /**
     * @var array global configuration for this filter
     *
     * This might be eventually moved into parent class if we found it
     * useful for other filters, too.
     */
    protected static $globalconfig;

    /**
     * Apply the filter to the text
     *
     * @see filter_manager::apply_filter_chain()
     * @param string $text to be processed by the text
     * @param array $options filter options
     * @return string text after processing
     */
    public function filter($text, array $options = array()) {

        if (!isset($options['originalformat'])) {
            // if the format is not specified, we are probably called by {@see format_string()}
            // in that case, it would be dangerous to replace text with the image because it could
            // be stripped. therefore, we do nothing
            $pref = $this->get_global_config('langstringprefix');
            if(!isset($pref) || $pref === "")
                $pref = "))L((";
            $preflen = strlen ($pref);
            if(substr($text, 0, $preflen) === $pref)
                return $this->replace_langstring(substr($text, $preflen));
            return  $text;
        }
//        if (in_array($options['originalformat'], explode(',', $this->get_global_config('formats')))) {
//            $this->replace_langstring($text);
//        }
        return $text.var_export($options,true);
    }

    ////////////////////////////////////////////////////////////////////////////
    // internal implementation starts here
    ////////////////////////////////////////////////////////////////////////////

    /**
     * Returns the global filter setting
     *
     * If the $name is provided, returns single value. Otherwise returns all
     * global settings in object. Returns null if the named setting is not
     * found.
     *
     * @param mixed $name optional config variable name, defaults to null for all
     * @return string|object|null
     */
    protected function get_global_config($name=null) {
        $this->load_global_config();
        if (is_null($name)) {
            return self::$globalconfig;

        } elseif (array_key_exists($name, self::$globalconfig)) {
            return self::$globalconfig->{$name};

        } else {
            return null;
        }
    }

    /**
     * Makes sure that the global config is loaded in $this->globalconfig
     *
     * @return void
     */
    protected function load_global_config() {
        if (is_null(self::$globalconfig)) {
            self::$globalconfig = get_config(get_class($this));
        }
    }

    /**
     * Replace langstring found in the text with their images
     *
     * @param string $text to modify
     * @return void
     */
    protected function replace_langstring($text) {
        $langstrings = explode('||', $text);

        $curlang = current_language();
        foreach ($langstrings as $pos => $str)
        {
            list($slang, $sval) = explode('|', $str);
            if($slang === $curlang)
                return $sval;
        }
        $defaultLang = $this->get_global_config('defaultlang');
        foreach ($langstrings as $pos => $str)
        {
            list($slang, $sval) = explode('|', $str);
            if($slang === $defaultLang)
                return $sval;
        }
        // Если и языка по умолчанию нет, то показываем первый
        list($slang, $sval) = explode('|', $langstrings[0]);


        return $sval;



//        global $CFG, $OUTPUT, $PAGE;
//        static $emoticontexts = array();    // internal cache used for replacing
//        static $emoticonimgs = array();     // internal cache used for replacing
//
//        $lang = current_language();
//        $theme = $PAGE->theme->name;
//
//        if (!isset($emoticontexts[$lang][$theme]) or !isset($emoticonimgs[$lang][$theme])) {
//            // prepare internal caches
//            $manager = get_emoticon_manager();
//            $emoticons = $manager->get_emoticons();
//            $emoticontexts[$lang][$theme] = array();
//            $emoticonimgs[$lang][$theme] = array();
//            foreach ($emoticons as $emoticon) {
//                $emoticontexts[$lang][$theme][] = $emoticon->text;
//                $emoticonimgs[$lang][$theme][] = $OUTPUT->render($manager->prepare_renderable_emoticon($emoticon));
//            }
//            unset($emoticons);
//        }
//
//        if (empty($emoticontexts[$lang][$theme])) { // No emoticons defined, nothing to process here
//            return;
//        }
//
//        // detect all the <script> zones to take out
//        $excludes = array();
//        preg_match_all('/<script language(.+?)<\/script>/is', $text, $listofexcludes);
//
//        // take out all the <script> zones from text
//        foreach (array_unique($listofexcludes[0]) as $key => $value) {
//            $excludes['<+'.$key.'+>'] = $value;
//        }
//        if ($excludes) {
//            $text = str_replace($excludes, array_keys($excludes), $text);
//        }
//
//        // this is the meat of the code - this is run every time
//        $text = str_replace($emoticontexts[$lang][$theme], $emoticonimgs[$lang][$theme], $text);
//
//        // Recover all the <script> zones to text
//        if ($excludes) {
//            $text = str_replace(array_keys($excludes), $excludes, $text);
//        }
    }
}
