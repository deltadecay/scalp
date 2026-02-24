<?php

require_once(__DIR__."/../src/calendar_de.php");

require_once(__DIR__."/../../pest/pest.php");

use function \pest\test;
use function \pest\expect;



date_default_timezone_set("UTC");

test("get_de_calendar 2026", function(){
    $cal = \scalp\get_de_calendar(2026);
    expect($cal->getTimezone())->toBe("CET");
    expect($cal->getCountryCode())->toBe("DE");

    date_default_timezone_set($cal->getTimezone());

    // Check that all holidays are marked as closed, do not test for time

    expect($cal->isMarkedClosed("2026-01-01"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-04-03"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-04-06"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-05-01"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-05-14"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-05-25"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-10-03"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-12-24"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-12-25"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-12-26"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-12-31"))->toBeTruthy();
});
