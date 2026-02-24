<?php

namespace scalp;
require_once(__DIR__."/holidays.php");
require_once(__DIR__."/calendar.class.php");

function get_es_calendar($year = null)
{
    if ($year === null)
    {
        $year = date('Y');
    }

    $holidays = get_holidays($year);

    $cal = new Calendar([
        "countrycode" => "ES",
        "opening_time" => "09:00", 
        "closing_time" => "17:30", 
        "has_lunch_break" => false,
        "timezone" => 'CET',
    ]);

    $cal->addClosedDay($holidays["New Year's Day"], "New Year's Day");
    $cal->addClosedDay($holidays["Good Friday"], "Good Friday");
    $cal->addClosedDay($holidays["Easter Monday"], "Easter Monday");
    $cal->addClosedDay($holidays["First of May"], "Labour Day");
    $cal->addClosedDay($holidays["Assumption of Mary"], "Assumption of Mary");
    $cal->addClosedDay($holidays["National Day of Spain"], "National Day of Spain");
    $cal->addClosedDay($holidays["All Saints' Day"], "All Saints' Day");
    $cal->addClosedDay($holidays["Constitution Day in Spain"], "Constitution Day");
    $cal->addClosedDay($holidays["Feast of the Immaculate Conception holiday"], "Feast of the Immaculate Conception");
    $cal->addClosedDay($holidays["Christmas Day"], "Christmas Day");
    $cal->addClosedDay($holidays["New Year's Eve"], "New Year's Eve");

    $cal->addHalfDay($holidays["Christmas Eve"], "13:00");

    return $cal;
}
