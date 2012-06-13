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
  'pi_version'      => '1.0',
  'pi_author'       => 'Boots Highland',
  'pi_author_url'   => 'http://www.groupswitch.com/',
  'pi_description'  => 'Takes a Gregorian Calendar date and returns the Jewish/Hebrew Calendar date.',
  'pi_usage'        => Jewish_cal_conv::usage()
);

class Jewish_cal_conv
{

    public $return_data = "";

    // --------------------------------------------------------------------

    /**
     * Jewish Calendar Conversion
     *
     * This function Takes a Gregorian Calendar date and returns the Jewish/Hebrew Calendar date.
     *
     * @access  public
     * @return  string
     */
    public function __construct()
    {
        $this->EE =& get_instance();

        $date_in = $this->EE->TMPL->fetch_param('date');
        
        $gregorian_date = explode("-", $date_in); 
		$julian_date = gregoriantojd($gregorian_date[0],$gregorian_date[1],$gregorian_date[2]); 
		$hebrew_date = jdtojewish($julian_date); 
		$hebrew_month_name = jdmonthname($julian_date,4); 
		
		list($hebrew_month, $hebrew_day, $hebrew_year) = explode('/',$hebrew_date); 
        
        $vars = array(
                'month' => $hebrew_month,
                'month_name' => $hebrew_month_name,
                'day' => $hebrew_day,
                'year' => $hebrew_year
                );
        
        $output = $this->EE->TMPL->parse_variables($this->EE->TMPL->tagdata, $vars);
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
    public static function usage()
    {
        ob_start();  ?>

Example:
{exp:jewish_cal_conv date="09-04-2012"} // Output: Elul 17, 5772

Date variables can also be used:
{exp:jewish_cal_conv date="{current_time format='%m-%d-%Y'}"}

Note "date" parameter must be in "MM-DD-YYYY" format. Currently, the output
is only in "Month DD, YYYY" format, but I hope to expand this plugin soon
to be more flexible.

    <?php
        $buffer = ob_get_contents();
        ob_end_clean();

        return $buffer;
    }
    // END
}
/* End of file pi.jewish_cal_conv.php */
/* Location: ./system/expressionengine/third_party/jewish_cal_conv/pi.jewish_cal_conv.php */