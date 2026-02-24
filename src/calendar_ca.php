<?php

namespace scalp;
require_once(__DIR__."/holidays.php");
require_once(__DIR__."/calendar.class.php");

function get_ca_calendar($year = null)
{
    if ($year === null)
    {
        $year = date('Y');
    }

    $holidays = get_holidays($year);

    $cal = new Calendar([
        "countrycode" => "CA",
        "opening_time" => "09:30", 
        "closing_time" => "16:00", 
        "has_lunch_break" => false,
        "timezone" => 'EST',
    ]);


    $cal->addClosedDay($holidays["New Year's Day"], "New Year's Day");
    $cal->addClosedDay($holidays["Family Day"], "Family Day");
    $cal->addClosedDay($holidays["Good Friday"], "Good Friday");
    $cal->addClosedDay($holidays["Easter Monday"], "Easter Monday");
    $cal->addClosedDay($holidays["Victoria Day"], "Victoria Day");
    $cal->addClosedDay($holidays["Canada Day"], "Canada Day");
    $cal->addClosedDay($holidays["Civic Holiday"], "Civic Holiday");
    $cal->addClosedDay($holidays["Labor Day"], "Labor Day");
    $cal->addClosedDay($holidays["Canadian Thanksgiving"], "Canadian Thanksgiving");
    $cal->addClosedDay($holidays["Christmas Day"], "Christmas Day");
    $cal->addClosedDay($holidays["Boxing Day holiday"], "Boxing Day holiday");

    // Half days
    $cal->addHalfDay($holidays["National Day for Truth and Reconciliation"], "13:00");
    $cal->addHalfDay($holidays["Remembrance Day"], "13:00");
    $cal->addHalfDay($holidays["Christmas Eve"], "13:00");

    return $cal;
}
