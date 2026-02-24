<?php

namespace scalp;
require_once(__DIR__."/holidays.php");
require_once(__DIR__."/calendar.class.php");

function get_fr_calendar($year = null)
{
    if ($year === null)
    {
        $year = date('Y');
    }

    $holidays = get_holidays($year);

    $cal = new Calendar([
        "countrycode" => "FR",
        "opening_time" => "09:00", 
        "closing_time" => "17:30", 
        "has_lunch_break" => false,
        "timezone" => 'CET',
    ]);

    $cal->addClosedDay($holidays["New Year's Day"], "New Year's Day");
    $cal->addClosedDay($holidays["Good Friday"], "Good Friday");
    $cal->addClosedDay($holidays["Easter Monday"], "Easter Monday");
    $cal->addClosedDay($holidays["First of May"], "Labour Day");
    $cal->addClosedDay($holidays["Victory in Europe Day"], "Victory in Europe Day");
    $cal->addClosedDay($holidays["Ascension Day"], "Ascension Day");
    $cal->addClosedDay($holidays["Pentecost Monday"], "Whit Monday");
    $cal->addClosedDay($holidays["Bastille Day"], "Bastille Day");
    $cal->addClosedDay($holidays["Assumption of Mary"], "Assumption of Mary");
    $cal->addClosedDay($holidays["All Saints' Day"], "All Saints' Day");
    $cal->addClosedDay($holidays["Armistice Day"], "Armistice Day");
    $cal->addClosedDay($holidays["Christmas Day"], "Christmas Day");
    $cal->addClosedDay($holidays["Boxing Day"], "Saint Stephen's Day");

    $cal->addHalfDay($holidays["Christmas Eve"], "13:00");
    $cal->addHalfDay($holidays["New Year's Eve"], "13:00");

    return $cal;
}
