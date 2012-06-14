Jewish Calendar Conversion Plugin
=============================

ExpressionEngine plugin to convert a Gregorian/Civil calendar date to Jewish/Hebrew calendar date.

**Examples:**  
*// The following will output "Month DD, YYYY":*  
    {exp:jewish_cal_conv date="{current_time}"}  
    {hebrew_month_name} {hebrew_day}, {hebrew_year}  
    {/exp:jewish_cal_conv}  

*// The following will output "MM/DD/YYYY":*  
    {exp:jewish_cal_conv date="{entry_date}"}  
    {hebrew_month}/{hebrew_day}/{hebrew_year}  
    {/exp:jewish_cal_conv}  

**Required parameter:**  
"date" - A UNIX timestamp

**Available variables:**  
{hebrew_month} - Numeric representation of the month  
{hebrew_month_name} - A full textual representation of the month  
{hebrew_day} - Numeric representation of the day  
{hebrew_year} - Numeric representation of the year  