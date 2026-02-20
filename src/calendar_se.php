<?php

namespace scalp;
require_once(__DIR__."/holidays.php");
require_once(__DIR__."/calendar.class.php");

function get_swedish_calendar($year = null)
{
    if ($year === null)
    {
        $year = date('Y');
    }

    $holidays = get_holidays($year);

    $cal = new Calendar([
        "countrycode" => "SE",
        "opening_time" => "09:00", 
        "closing_time" => "17:30", 
        "has_lunch_break" => false,
        "timezone" => 'CET',
    ]);
    $cal->addClosedDay($holidays["New Year's Day"], "New Year's Day");
    $cal->addClosedDay($holidays["Epiphany"], "Epiphany");
    $cal->addClosedDay($holidays["Good Friday"], "Good Friday");
    $cal->addClosedDay($holidays["Easter Monday"], "Easter Monday");
    $cal->addClosedDay($holidays["Ascension Day"], "Ascension Day");
    $cal->addClosedDay($holidays["First of May"], "First of May");
    $cal->addClosedDay($holidays["Swedish National day"], "Swedish National day");
    $cal->addClosedDay($holidays["Midsummers Eve"], "Midsummers Eve");
    $cal->addClosedDay($holidays["Christmas Eve"], "Christmas Eve");
    $cal->addClosedDay($holidays["Christmas Day"], "Christmas Day");
    $cal->addClosedDay($holidays["Boxing Day"], "Boxing Day");
    $cal->addClosedDay($holidays["New Year's Eve"], "New Year's Eve");

    $closing_time_halfday = "13:00";
    if(weekday_name($holidays["Epiphany"]) == "Tuesday")
    {
        $before_epiphany = date('Y-m-d', strtotime('-1 day', strtotime($holidays["Epiphany"])));
        $cal->addHalfDay($before_epiphany, $closing_time_halfday);
    }
    if(weekday_name($holidays["Epiphany"]) == "Thursday")
    {
        $after_epiphany = date('Y-m-d', strtotime('+1 day', strtotime($holidays["Epiphany"])));
        $cal->addHalfDay($after_epiphany, $closing_time_halfday);
    }
    $cal->addHalfDay($holidays["Holy Thursday"], $closing_time_halfday);
    $cal->addHalfDay($holidays["Eve of Ascension"], $closing_time_halfday);
    $cal->addHalfDay($holidays["Walpurgis Eve"], $closing_time_halfday);
    $cal->addHalfDay($holidays["Swedish All Hallows' Eve"], $closing_time_halfday);
    return $cal;
}