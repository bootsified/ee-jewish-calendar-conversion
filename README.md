ee-jewish-calendar-conversion
=============================

ExpressionEngine plugin to convert a Gregorian/Civil calendar date to Jewish/Hebrew calendar date.

Examples:
// The following will output "Month DD, YYYY":
{exp:jewish_cal_conv date="{current_time}"}
{month_name} {day}, {year}
{/exp:jewish_cal_conv}

// The following will output "MM/DD/YYYY":
{exp:jewish_cal_conv date="{entry_date}"}
{month}/{day}/{year}
{/exp:jewish_cal_conv}

Required parameter:
"date" - A UNIX timestamp

Available variables:
{month} - Numeric representation of the month
{month_name} - A full textual representation of the month
{day} - Numeric representation of the day
{year} - Numeric representation of the year