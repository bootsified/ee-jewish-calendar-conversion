<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Jewish Calendar Conversion Class
 *
 * @package		ExpressionEngine
 * @category	Plugin
 * @author		Boots Highland
 * @link		http://www.groupswitch.com/
 * @copyright	Copyright (c) 2012, Boots Highland
 *
 * Thanks to Ingmar Greil in the EE forums for pointing me in the right direction.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details <http://www.gnu.org/licenses/>.
 */

$plugin_info = array(
  'pi_name'         => 'Jewish Calendar Conversion',
  'pi_version'      => '1.1',
  'pi_author'       => 'Boots Highland',
  'pi_author_url'   => 'http://www.groupswitch.com/',
  'pi_description'  => 'Takes a Gregorian/Civil Calendar date and returns the corresponding Jewish/Hebrew Calendar date.',
  'pi_usage'        => Jewish_cal_conv::usage()
);

class Jewish_cal_conv {

    public $return_data = "";

    // --------------------------------------------------------------------

    /**
     * Jewish Calendar Conversion
     *
     * This function takes a Gregorian/Civil Calendar date and returns the corresponding Jewish/Hebrew Calendar date.
     *
     * @access  public
     * @return  string
     */
    public function __construct() {
        $this->EE =& get_instance();

        $date_in = $this->EE->TMPL->fetch_param('date');
        $date_fmt = date('m-d-Y', $date_in);

        $gregorian_date = explode("-", $date_fmt);
		$julian_date = gregoriantojd($gregorian_date[0],$gregorian_date[1],$gregorian_date[2]);
		$hebrew_date = jdtojewish($julian_date);
		$hebrew_month_name = jdmonthname($julian_date,4);

		list($hebrew_month, $hebrew_day, $hebrew_year) = explode('/',$hebrew_date);

        $vars = array(
                'hebrew_month' => $hebrew_month,
                'hebrew_month_name' => $hebrew_month_name,
                'hebrew_day' => $hebrew_day,
                'hebrew_year' => $hebrew_year
                );

        $output = $this->EE->TMPL->parse_variables_row($this->EE->TMPL->tagdata, $vars);
        $this->return_data = $output;
    }

    // --------------------------------------------------------------------

    /**
     * Usage
     *
     * This function describes how the plugin is used.
     *
     * @access  public
     * @return  string
     */
    public static function usage() {
        ob_start();  ?>
Examples:
// The following will output "Month DD, YYYY":
{exp:jewish_cal_conv date="{current_time}"}
{hebrew_month_name} {hebrew_day}, {hebrew_year}
{/exp:jewish_cal_conv}

// The following will output "MM/DD/YYYY":
{exp:jewish_cal_conv date="{entry_date}"}
{hebrew_month}/{hebrew_day}/{hebrew_year}
{/exp:jewish_cal_conv}

Required parameter:
"date" - A UNIX timestamp

Available variables:
{hebrew_month} - Numeric representation of the month
{hebrew_month_name} - A full textual representation of the month
{hebrew_day} - Numeric representation of the day
{hebrew_year} - Numeric representation of the year
    <?php
        $buffer = ob_get_contents();
        ob_end_clean();

        return $buffer;
    }
    // END
}
/* End of file pi.jewish_cal_conv.php */
/* Location: ./system/expressionengine/third_party/jewish_cal_conv/pi.jewish_cal_conv.php */