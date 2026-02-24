<?php

require_once(__DIR__."/../src/calendar_uk.php");

require_once(__DIR__."/../../pest/pest.php");

use function \pest\test;
use function \pest\expect;



date_default_timezone_set("UTC");

test("get_uk_calendar 2026", function(){
    $cal = \scalp\get_uk_calendar(2026);
    expect($cal->getTimezone())->toBe("GMT");
    expect($cal->getCountryCode())->toBe("GB");

    date_default_timezone_set($cal->getTimezone());

    // Check that all holidays are marked as closed, do not test for time
/*
* January 1, New Year's Day, closed
* April 3, Good Friday, closed
* April 6, Easter Monday, bank holiday, closed
* May 4, May Day, Early May Bank Holiday, first Monday in May, closed
* May 25, Spring Bank Holiday, last Monday in May, closed
* August 31, Summer Bank Holiday, last Monday in August (except Scotland = first Monday in August), closed
* December 24, Christmas Eve, half day
* December 25, Christmas Day, closed
* December 28, Boxing Day holiday (although Boxing Day is 26th), monday, closed
* December 31, New Year's Eve, half day
*/
    expect($cal->isMarkedClosed("2026-01-01"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-04-03"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-04-06"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-05-04"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-05-25"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-08-31"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-12-25"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-12-28"))->toBeTruthy();

    expect($cal->isHalfDay("2026-12-24"))->toBeTruthy();
    expect($cal->getClosingTime("2026-12-24"))->toBe("13:00");
    expect($cal->isHalfDay("2026-12-31"))->toBeTruthy();
    expect($cal->getClosingTime("2026-12-31"))->toBe("13:00");
});
