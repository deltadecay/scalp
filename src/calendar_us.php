<?php

namespace scalp;
require_once(__DIR__."/holidays.php");
require_once(__DIR__."/calendar.class.php");

function get_us_calendar($year = null)
{
    if ($year === null)
    {
        $year = date('Y');
    }

    $holidays = get_holidays($year);

    $cal = new Calendar([
        "countrycode" => "US",
        "opening_time" => "9:30",
        "closing_time" => "16:00", 
        "has_lunch_break" => false,
        "timezone" => 'EST',
    ]);

    $cal->addClosedDay($holidays["New Year's Day"], "New Year's Day");
    $cal->addClosedDay($holidays["Martin Luther King, Jr. Day"], "Martin Luther King, Jr. Day");
    $cal->addClosedDay($holidays["Presidents' Day"], "Presidents' Day");
    
    $cal->addClosedDay($holidays["Good Friday"], "Good Friday");
    $cal->addClosedDay($holidays["Memorial Day"], "Memorial Day");
    $cal->addClosedDay($holidays["Juneteenth"], "Juneteenth");
    $cal->addClosedDay($holidays["Independence Day holiday"], "Independence Day holiday");
    $cal->addClosedDay($holidays["Labor Day"], "Labor Day");
    $cal->addClosedDay($holidays["Thanksgiving"], "Thanksgiving");
    $cal->addClosedDay($holidays["Christmas Day"], "Christmas Day");

    $closing_time_halfday = "14:00"; 
    
    //$cal->addHalfDay($holidays["Good Friday"], "12:00");

    $cal->addHalfDay($holidays["Columbus Day"], $closing_time_halfday);
    $cal->addHalfDay($holidays["Veterans Day"], $closing_time_halfday);
    $cal->addHalfDay($holidays["Black Friday"], $closing_time_halfday);
    $cal->addHalfDay($holidays["Christmas Eve"], $closing_time_halfday);

    // Day before Independence Day observed is a half day 
    if(weekday_numeric($holidays["Independence Day holiday"]) >= 2 && weekday_numeric($holidays["Independence Day holiday"]) <= 5)
    {
        $before_independence_day = date('Y-m-d', strtotime('-1 day', strtotime($holidays["Independence Day holiday"])));
        $cal->addHalfDay($before_independence_day, $closing_time_halfday);
    }
    return $cal;
}