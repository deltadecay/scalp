<?php

namespace scalp;
require_once(__DIR__."/holidays.php");
require_once(__DIR__."/calendar.class.php");

function get_uk_calendar($year = null)
{
    if ($year === null)
    {
        $year = date('Y');
    }

    $holidays = get_holidays($year);

    $cal = new Calendar([
        "countrycode" => "GB",
        "opening_time" => "08:00", 
        "closing_time" => "16:30", 
        "has_lunch_break" => false,
        "timezone" => 'GMT',
    ]);

    $cal->addClosedDay($holidays["New Year's Day"], "New Year's Day");
    $cal->addClosedDay($holidays["Good Friday"], "Good Friday");
    $cal->addClosedDay($holidays["Easter Monday"], "Easter Monday");
    $cal->addClosedDay($holidays["Early May Bank Holiday"], "Early May Bank Holiday");
    $cal->addClosedDay($holidays["Spring Bank Holiday"], "Spring Bank Holiday");
    $cal->addClosedDay($holidays["Summer Bank Holiday"], "Summer Bank Holiday");
    $cal->addClosedDay($holidays["Christmas Day"], "Christmas Day");
    $cal->addClosedDay($holidays["Boxing Day holiday"], "Boxing Day holiday");

    $cal->addHalfDay($holidays["Christmas Eve"], "13:00");
    $cal->addHalfDay($holidays["New Year's Eve"], "13:00");

    return $cal;
}