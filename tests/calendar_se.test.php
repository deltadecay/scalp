<?php

require_once(__DIR__."/../src/calendar_se.php");

require_once(__DIR__."/../../pest/pest.php");

use function \pest\test;
use function \pest\expect;



date_default_timezone_set("UTC");

test("get_swedish_calendar 2026", function(){
    $cal = \scalp\get_se_calendar(2026);
    expect($cal->getTimezone())->toBe("CET");
    expect($cal->getCountryCode())->toBe("SE");
    expect($cal->getCountryCode())->toBe("SE");

    $cal->applyTimezone();

    // Check that all holidays are marked as closed, do not test for time

    expect($cal->isMarkedClosed("2026-01-01"))->toBeTruthy();

    expect($cal->isMarkedClosed("2026-01-02"))->toBeFalsy();
    expect($cal->isMarkedClosed("2026-01-06"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-04-03"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-04-06"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-05-14"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-05-01"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-06-06"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-12-24"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-12-25"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-12-26"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-12-31"))->toBeTruthy();

    expect($cal->isHalfDay("2026-01-05"))->toBeTruthy();
    expect($cal->getClosingTime("2026-01-05"))->toBe("13:00");
    expect($cal->isHalfDay("2026-04-02"))->toBeTruthy();
    expect($cal->getClosingTime("2026-04-02"))->toBe("13:00");
    expect($cal->isHalfDay("2026-05-13"))->toBeTruthy();
    expect($cal->getClosingTime("2026-05-13"))->toBe("13:00");
    expect($cal->isHalfDay("2026-10-30"))->toBeTruthy();
    expect($cal->getClosingTime("2026-10-30"))->toBe("13:00");
});

test("Test opening times", function(){
    $cal = \scalp\get_se_calendar(2026);
    expect($cal->getTimezone())->toBe("CET");
    date_default_timezone_set($cal->getTimezone());

    // 5th January 2026 is a half day, market closes at 13:00
    $ts = strtotime("2026-01-05 12:00:00");
    expect($cal->isMarkedClosed($ts))->toBeFalsy();
    expect($cal->isMarkedClosed($ts, true))->toBeFalsy();
    $ts = strtotime("2026-01-05 13:01:00");
    // If not checking time then the day is open
    expect($cal->isMarkedClosed($ts))->toBeFalsy();
    // but if we check the time, it should be closed
    expect($cal->isMarkedClosed($ts, true))->toBeTruthy();

    // February 20, 2026 is a regular day, market closes at 17:30
    $ts = strtotime("2026-02-20 15:10:04");
    expect($cal->isMarkedClosed($ts))->toBeFalsy();
    expect($cal->isMarkedClosed($ts, true))->toBeFalsy();  
    $ts = strtotime("2026-02-20 17:31:00");
    expect($cal->isMarkedClosed($ts))->toBeFalsy();
    expect($cal->isMarkedClosed($ts, true))->toBeTruthy();
    // Market opens at 09:00
    $ts = strtotime("2026-02-20 08:45:00");
    expect($cal->isMarkedClosed($ts))->toBeFalsy();
    expect($cal->isMarkedClosed($ts, true))->toBeTruthy();
});

