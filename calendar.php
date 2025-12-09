<?php

require_once("./src/easter.php");

date_default_timezone_set('CET');



// Set market closed and half days
$market_closed = [];
$market_halfday = [];

$fixed_holidays = [
    "01-01" => "New Years Day",
    "01-06" => "Epiphany", // Thirteen days from Xmas eve, Twelfth Day or Epiphany
    "05-01" => "First of May", 
    "06-06" => "Swedish National day",
    "12-24" => "Christmas Eve",
    "12-25" => "Christmas Day",
    "12-26" => "Boxing Day Christmas",
    "12-31" => "New Years Eve",
];

$year = date('Y');
foreach($fixed_holidays as $fh_md => $fh_name)
{
    $market_closed["{$year}-{$fh_md}"] = $fh_name;
}

// Walpurgis Eve, half day
$market_halfday["{$year}-04-30"] = "Walpurgis Eve";


// All Hallows' Eve is the evening before the Christian holiday All Hallows' Day, 
// which in Sweden is celebrated on the Saturday occurring between Oct 31 and Nov 6. 
for($j=0; $j<=6; $j++)
{
    $oct31 = mktime(12, 0, 0, 10, 31, $year);
    $ts = strtotime($j.' days', $oct31);
    if((int)date('N', $ts) == 6)
    {
        // All Hallows' Day, a Saturday between Oct 31 and Nov 6
        // All Hallows' Eve is the Friday before, half day
        $allhallowseve = date('Y-m-d', strtotime(($j - 1).' days', $oct31));
        $market_halfday["{$allhallowseve}"] = "All Hallows' Eve";
    }
}


// Following holidays/half-days depend on easter_days
{
    // Easter day (Sunday) is easter_days(year) from March 21
    $march21 = mktime(12, 0, 0, 3, 21, $year);
    $easterdays_3_21 = easter_days($year);

    // Holy Thursday, half day
    $holythursday = date('Y-m-d', strtotime(($easterdays_3_21 - 3).' days', $march21));
    $market_halfday["{$holythursday}"] = "Holy Thursday";

    // Good Friday, closed
    $goodfriday = date('Y-m-d', strtotime(($easterdays_3_21 - 2).' days', $march21));
    $market_closed["{$goodfriday}"] = "Good Friday";

    // Easter Monday, closed
    $eastermonday = date('Y-m-d', strtotime(($easterdays_3_21 + 1).' days', $march21));
    $market_closed["{$eastermonday}"] = "Easter Monday";

    // Ascension Day, easter+39, closed
    $ascensionday = date('Y-m-d', strtotime(($easterdays_3_21 + 39).' days', $march21));
    $market_closed["{$ascensionday}"] = "Ascension Day";

    // Eve of Ascension, half day
    $eveofascension = date('Y-m-d', strtotime(($easterdays_3_21 + 38).' days', $march21));
    $market_halfday["{$eveofascension}"] = "Eve of Ascension";
}

// Midsummers Eve, a Friday between June 19 to 25
for($j=19; $j<=25; $j++)
{
    $ts = mktime(12, 0, 0, 6, $j, $year);
    if((int)date('N', $ts) == 5)
    {
        $midsummerseve = date('Y-m-d', $ts);
        $market_closed["{$midsummerseve}"] = "Midsummers Eve";
        break;
    }
}


ksort($market_closed);
ksort($market_halfday);

function is_market_closed($ts)
{
    global $market_closed;
    $weekday = (int)date('N', $ts);
    if($weekday == 6 || $weekday == 7) {
        // Weekends are closed
        return true;
    }

    $ymd = date("Y-m-d", $ts);
    // Holidays are closed
    return isset($market_closed[$ymd]);
}

function is_half_day($ts)
{
    global $market_halfday;
    $ymd = date("Y-m-d", $ts);
    // Half days
    return isset($market_halfday[$ymd]);
}
