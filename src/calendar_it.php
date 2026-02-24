<?php

namespace scalp;
require_once(__DIR__."/holidays.php");
require_once(__DIR__."/calendar.class.php");

function get_it_calendar($year = null)
{
    if ($year === null)
    {
        $year = date('Y');
    }

    $holidays = get_holidays($year);

    $cal = new Calendar([
        "countrycode" => "IT",
        "opening_time" => "09:00", 
        "closing_time" => "17:30", 
        "has_lunch_break" => false,
        "timezone" => 'CET',
    ]);

    $cal->addClosedDay($holidays["New Year's Day"], "New Year's Day");
    $cal->addClosedDay($holidays["Epiphany"], "Epiphany");
    $cal->addClosedDay($holidays["Good Friday"], "Good Friday");
    $cal->addClosedDay($holidays["Easter Monday"], "Easter Monday");
    $cal->addClosedDay($holidays["Liberation Day"], "Liberation Day");
    $cal->addClosedDay($holidays["First of May"], "Labour Day");
    $cal->addClosedDay($holidays["Italian Republic Day"], "Republic Day");
    $cal->addClosedDay($holidays["Assumption of Mary"], "Ferragosto");
    $cal->addClosedDay($holidays["All Saints' Day"], "All Saints' Day");
    $cal->addClosedDay($holidays["Feast of the Immaculate Conception holiday"], "Feast of the Immaculate Conception");
    $cal->addClosedDay($holidays["Christmas Eve"], "Christmas Eve");
    $cal->addClosedDay($holidays["Christmas Day"], "Christmas Day");
    $cal->addClosedDay($holidays["Boxing Day"], "Saint Stephen's Day");
    $cal->addClosedDay($holidays["New Year's Eve"], "New Year's Eve");

    return $cal;
}
