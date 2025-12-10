<?php

namespace scalp;

function easter_date($year)
{
    // If php is compiled with calendar then easter_date exists
    if (function_exists("\\easter_date"))
    {
        return \easter_date($year);
    }
    // https://www.linuxtopia.org/online_books/programming_books/python_programming/python_ch38.html
    // Algorithm F
    //
    // G is the Golden Number-1
    // C is the century-1
    // H is 23-Epact (modulo 30)
    // I is the number of days from 21 March to the Paschal full moon
    // J is the weekday for the Paschal full moon (0=Sunday, 1=Monday, etc.)
    // L is the number of days from 21 March to the Sunday on or before
    //   the Paschal full moon (a number between -6 and 28)
    $G = $year % 19;
    $C = (int)($year / 100);
    $H = (int)($C - (int)($C / 4) - (int)((8*$C+13) / 25) + 19*$G + 15) % 30;
    $I = (int)$H - (int)($H / 28)*(1 - (int)($H / 28)*(int)(29 / ($H + 1))*((int)(21 - $G) / 11));
    $J = ($year + (int)($year/4) + $I + 2 - $C + (int)($C/4)) % 7;
    $L = $I - $J;
    $m = 3 + (int)(($L + 40) / 44);
    $d = $L + 28 - 31 * ((int)($m / 4));
    $ts = mktime(0,0,0, $m, $d, $year);
    return $ts;
}

function easter_days($year)
{
    // If php is compiled with calendar then easter_days exists
    if (function_exists("\\easter_days"))
    {
        return \easter_days($year);
    }
    return (int)round((easter_date($year)-mktime(0, 0, 0, 3, 21, $year))/(3600*24));
}
