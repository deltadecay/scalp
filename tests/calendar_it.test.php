<?php

require_once(__DIR__."/../src/calendar_it.php");

require_once(__DIR__."/../../pest/pest.php");

use function \pest\test;
use function \pest\expect;



date_default_timezone_set("UTC");

test("get_it_calendar 2026", function(){
    $cal = \scalp\get_it_calendar(2026);
    expect($cal->getTimezone())->toBe("CET");
    expect($cal->getCountryCode())->toBe("IT");

    date_default_timezone_set($cal->getTimezone());

    // Check that all holidays are marked as closed, do not test for time

    expect($cal->isMarkedClosed("2026-01-01"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-01-06"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-04-03"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-04-05"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-04-06"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-04-25"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-05-01"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-06-02"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-08-15"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-11-01"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-12-08"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-12-24"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-12-25"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-12-26"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-12-31"))->toBeTruthy();
});
