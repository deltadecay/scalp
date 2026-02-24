<?php

namespace scalp;
require_once(__DIR__."/holidays.php");
require_once(__DIR__."/calendar.class.php");

function get_de_calendar($year = null)
{
    if ($year === null)
    {
        $year = date('Y');
    }

    $holidays = get_holidays($year);

    $cal = new Calendar([
        "countrycode" => "DE",
        "opening_time" => "09:00", 
        "closing_time" => "17:30", 
        "has_lunch_break" => false,
        "timezone" => 'CET',
    ]);

    $cal->addClosedDay($holidays["New Year's Day"], "New Year's Day");
    $cal->addClosedDay($holidays["Good Friday"], "Good Friday");
    $cal->addClosedDay($holidays["Easter Monday"], "Easter Monday");
    $cal->addClosedDay($holidays["First of May"], "Labour Day");
    $cal->addClosedDay($holidays["Ascension Day"], "Ascension Day");
    $cal->addClosedDay($holidays["Pentecost Monday"], "Whit Monday");
    $cal->addClosedDay($holidays["German Unity Day"], "German Unity Day");
    $cal->addClosedDay($holidays["Christmas Eve"], "Christmas Eve");
    $cal->addClosedDay($holidays["Christmas Day"], "Christmas Day");
    $cal->addClosedDay($holidays["Boxing Day"], "Boxing Day");
    $cal->addClosedDay($holidays["New Year's Eve"], "New Year's Eve");

    return $cal;
}
