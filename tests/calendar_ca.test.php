<?php

require_once(__DIR__."/../src/calendar_ca.php");

require_once(__DIR__."/../../pest/pest.php");

use function \pest\test;
use function \pest\expect;


date_default_timezone_set("UTC");

test("get_ca_calendar 2026", function(){
    $cal = \scalp\get_ca_calendar(2026);
    expect($cal->getTimezone())->toBe("EST");
    expect($cal->getCountryCode())->toBe("CA");

    $cal->applyTimezone();

    // Check that all holidays are marked as closed, do not test for time
    expect($cal->isMarkedClosed("2026-01-01"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-02-16"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-04-03"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-04-06"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-05-18"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-07-01"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-08-03"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-09-07"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-10-12"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-12-25"))->toBeTruthy();
    expect($cal->isMarkedClosed("2026-12-28"))->toBeTruthy();

    expect($cal->isHalfDay("2026-09-30"))->toBeTruthy();
    expect($cal->getClosingTime("2026-09-30"))->toBe("13:00");
    expect($cal->isHalfDay("2026-11-11"))->toBeTruthy();
    expect($cal->getClosingTime("2026-11-11"))->toBe("13:00");
    expect($cal->isHalfDay("2026-12-24"))->toBeTruthy();
    expect($cal->getClosingTime("2026-12-24"))->toBe("13:00");
});
