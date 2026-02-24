<?php

namespace scalp;

require_once(__DIR__."/easter.php");


function weekday_numeric($t)
{
    if(\is_string($t))
    {
       $t = strtotime($t);
    }
    return (int)date('N', $t);
}
function weekday_name($t)
{
    if(\is_string($t))
    {
       $t = strtotime($t);
    }
    return date('l', $t);
}

function get_holidays($year)
{
    $holidays = [];

    $holidays["New Year's Day"] = "{$year}-01-01";
    // Switzerland
    $holidays["St. Berchtold's Day"] = "{$year}-01-02";

    $holidays["Epiphany"] = "{$year}-01-06";

    $holidays["Martin Luther King, Jr. Day"] = date('Y-m-d', strtotime('third monday of january '.$year));
    //$holidays["Groundhog Day"] = "{$year}-02-02";
    
    //$holidays["Valentine's Day"] = "{$year}-02-14";
    // US celebration of Washingtons birthday, also known as Presidents' Day, is the third Monday in February
    $holidays["Presidents' Day"] = date('Y-m-d', strtotime('third monday of february '.$year));
    // Canada
    $holidays["Family Day"] = date('Y-m-d', strtotime('third monday of february '.$year));
    $holidays["St. Patrick's Day"] = "{$year}-03-17";

    // Following holidays depend on easter_days
    // Easter day (Sunday) is easter_days(year) from March 21
    $march21 = mktime(12, 0, 0, 3, 21, $year);
    $easterdays_3_21 = easter_days($year);

    // Holy Thursday, half day
    $holythursday = date('Y-m-d', strtotime(($easterdays_3_21 - 3).' days', $march21));
    $holidays["Holy Thursday"] = $holythursday;

    // Good Friday, closed
    $goodfriday = date('Y-m-d', strtotime(($easterdays_3_21 - 2).' days', $march21));
    $holidays["Good Friday"] = $goodfriday;

    $eastermonday = date('Y-m-d', strtotime(($easterdays_3_21 + 1).' days', $march21));
    $holidays["Easter Monday"] = $eastermonday;

    // Ascension Day
    $ascensionday = date('Y-m-d', strtotime(($easterdays_3_21 + 39).' days', $march21));
    $holidays["Ascension Day"] = $ascensionday;

    // Eve of Ascension
    $eveofascension = date('Y-m-d', strtotime(($easterdays_3_21 + 38).' days', $march21));
    $holidays["Eve of Ascension"] = $eveofascension;
    
    // Pentecost Monday, 
    $pentecostmonday = date('Y-m-d', strtotime(($easterdays_3_21 + 50).' days', $march21));
    $holidays["Pentecost Monday"] = $pentecostmonday;

    //$holidays["April Fools' Day"] = "{$year}-04-01";
    //$holidays["Earth Day"] = "{$year}-04-22";
    // Italy
    $holidays["Liberation Day"] = "{$year}-04-25";
    $holidays["Walpurgis Eve"] = "{$year}-04-30";

    $holidays["First of May"] = "{$year}-05-01";
    // Early May Bank Holiday or May Day Bank Holiday, is a public holiday in the United Kingdom celebrated on the first Monday in May.
    $holidays["Early May Bank Holiday"] = date('Y-m-d', strtotime('first monday of may '.$year));
    $holidays["Cinco de Mayo"] = "{$year}-05-05";
    // France celebrates the victory of the Allies in World War II on May 8, 1945 as Victory in Europe Day, also known as VE Day or V-Day. It is a public holiday in France and a national holiday in many other European countries.
    $holidays["Victory in Europe Day"] = "{$year}-05-08";

    //$holidays["Mother's Day"] = date('Y-m-d', strtotime('second sunday of may '.$year));
    
    // Memorial Day, is a federal holiday in the United States for honoring and mourning the military personnel who have died in the performance of their military duties. It is observed on the last Monday of May.
    $holidays["Memorial Day"] = date('Y-m-d', strtotime('last monday of may '.$year));

    // Spring Bank Holiday, also known as late May bank holiday, is a public holiday in the United Kingdom celebrated on the last Monday in May.
    $holidays["Spring Bank Holiday"] = date('Y-m-d', strtotime('last monday of may '.$year));

    // Canada celebrates Victoria Day on the Monday preceding May 25, which is the birthday of Queen Victoria.
    $holidays["Victoria Day"] = date('Y-m-d', strtotime('last monday of may '.$year.' -7 days'));
    /*for($j=1; $j<=7; $j++)
    {
        $ts = mktime(12, 0, 0, 5, 25-$j, $year);
        if((int)date('N', $ts) == 1)
        {
            $holidays["Victoria Day 2"] = date('Y-m-d', $ts);
            break;
        }
    }*/
    
    $holidays["Italian Republic Day"] = "{$year}-06-02";
    $holidays["Swedish National day"] = "{$year}-06-06";
  
    //$holidays["Father's Day"] = date('Y-m-d', strtotime('third sunday of june '.$year));
    
    $holidays["Juneteenth"] = "{$year}-06-19";


    // Midsummers Eve, a Friday between June 19 to 25
    for($j=19; $j<=25; $j++)
    {
        $ts = mktime(12, 0, 0, 6, $j, $year);
        if((int)date('N', $ts) == 5)
        {
            $midsummerseve = date('Y-m-d', $ts);
            $holidays["Midsummers Eve"] = $midsummerseve;
        }
    }

    $holidays["Canada Day"] = "{$year}-07-01";
    $holidays["Independence Day"] = "{$year}-07-04";
    $holidays["Independence Day holiday"] = "{$year}-07-04";
    $independenceday_weekday = date('N', mktime(12, 0, 0, 7, 4, $year));
    if($independenceday_weekday == 7)
    {
        // If Independence Day falls on a Sunday, it is observed on the following Monday
        $holidays["Independence Day holiday"] = date('Y-m-d', strtotime('next monday', mktime(12, 0, 0, 7, 4, $year)));
    }
    if($independenceday_weekday == 6)
    {
        // If Independence Day falls on a Saturday, it is observed on Friday
        $holidays["Independence Day holiday"] = date('Y-m-d', strtotime('previous friday', mktime(12, 0, 0, 7, 4, $year)));
    }

    // France celebrates the storming of the Bastille on July 14, 1789 as Bastille Day, also known as French National Day. It is a public holiday in France and a national holiday in many other countries.
    $holidays["Bastille Day"] = "{$year}-07-14";

    $holidays["Swiss National Day"] = "{$year}-08-01";

    // Canada celebrates the first Monday in August as a civic holiday in most provinces and territories, but not all.
    $holidays["Civic Holiday"] = date('Y-m-d', strtotime('first monday of august '.$year));

    // France, Italy, Spain and many other countries celebrate the Assumption of Mary on August 15 as a public holiday.
    $holidays["Assumption of Mary"] = "{$year}-08-15";
    // Italy
    $holidays["Ferragosto"] = "{$year}-08-15";

    // Summer Bank Holiday is a public holiday in the United Kingdom celebrated on the last Monday in August.
    $holidays["Summer Bank Holiday"] = date('Y-m-d', strtotime('last monday of august '.$year));

    // US & CA Labor Day 
    $holidays["Labor Day"] = date('Y-m-d', strtotime('first monday of september '.$year));

    // Canada
    $holidays["National Day for Truth and Reconciliation"] = "{$year}-09-30";

    $holidays["German Unity Day"] = "{$year}-10-03";

       // Columbus Day, is a national holiday in many countries of the Americas and elsewhere which officially celebrates the anniversary of Christopher Columbus's arrival in the Americas on October 12, 1492. In the United States, it is observed on the second Monday of October.
    $holidays["Columbus Day"] = date('Y-m-d', strtotime('second monday of october '.$year));
    $holidays["Canadian Thanksgiving"] = date('Y-m-d', strtotime('second monday of october '.$year));
    $holidays["National Day of Spain"] = "{$year}-10-12";


    $holidays["All Hallows' Eve"] = "{$year}-10-31";
    $holidays["Halloween"] = "{$year}-10-31";

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
            $holidays["Swedish All Hallows' Eve"] = $allhallowseve;
        }
    }

    $holidays["All Hallows' Day"] = "{$year}-11-01";
    $holidays["All Saints' Day"] = "{$year}-11-01";
    $holidays["All Souls' Day"] = "{$year}-11-02";
    
    // US
    $holidays["Veterans Day"] = "{$year}-11-11";
    // Canada
    $holidays["Remembrance Day"] = "{$year}-11-11";
    // France
    $holidays["Armistice Day"] = "{$year}-11-11";

    $holidays["Thanksgiving"] = date('Y-m-d', strtotime('fourth thursday of november '.$year));
    $holidays["Black Friday"] = date('Y-m-d', strtotime('fourth thursday of november '.$year.' +1 day'));
    $holidays["Cyber Monday"] = date('Y-m-d', strtotime('fourth thursday of november '.$year.' +4 days'));

    $holidays["Constitution Day in Spain"] = "{$year}-12-06";
    $holidays["Feast of the Immaculate Conception"] = "{$year}-12-08";
    $holidays["Feast of the Immaculate Conception holiday"] = "{$year}-12-08";
    $feastimmaculateconception_weekday = date('N', mktime(12, 0, 0, 12, 8, $year));
    if(\in_array($feastimmaculateconception_weekday, [7]))
    {
        // IT & ES
        // If the Feast of the Immaculate Conception falls on a Sunday, it is observed on the following Monday
        $holidays["Feast of the Immaculate Conception holiday"] = date('Y-m-d', strtotime('next monday', mktime(12, 0, 0, 12, 8, $year)));
    }
    $holidays["Christmas Eve"] = "{$year}-12-24";
    $holidays["Christmas Day"] = "{$year}-12-25";
    $holidays["Boxing Day"] = "{$year}-12-26";
    $holidays["Boxing Day holiday"] = "{$year}-12-26";
    $boxingday_weekday = date('N', mktime(12, 0, 0, 12, 26, $year));
    if(\in_array($boxingday_weekday, [6, 7]))
    {
        // UK & CA
        // If Boxing Day falls on a weekend, it is observed on the following Monday
        $holidays["Boxing Day holiday"] = date('Y-m-d', strtotime('next monday', mktime(12, 0, 0, 12, 26, $year)));
    }
    $holidays["New Year's Eve"] = "{$year}-12-31";

    return $holidays;
}

