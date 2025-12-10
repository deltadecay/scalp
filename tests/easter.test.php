<?php

namespace EasterTests;


require_once(__DIR__."/../src/easter.php");

require_once(__DIR__."/../../pest/pest.php");

use function \pest\test;
use function \pest\expect;

date_default_timezone_set("UTC");

test("easter_date", function(){
    $easter2025 = date("Y-m-d", \scalp\easter_date(2025));
    expect($easter2025)->toBe("2025-04-20");
    $easter2026 = date("Y-m-d", \scalp\easter_date(2026));
    expect($easter2026)->toBe("2026-04-05");
});

test("easter_days", function(){
    $daysFromMarch21 = \scalp\easter_days(2025);
    expect($daysFromMarch21)->toBe(30);
    $daysFromMarch21 = \scalp\easter_days(2026);
    expect($daysFromMarch21)->toBe(15);
});