<?php

namespace HolidaysTests;


require_once(__DIR__."/../src/holidays.php");

require_once(__DIR__."/../../pest/pest.php");

use function \pest\test;
use function \pest\expect;

date_default_timezone_set("UTC");

test("get_holidays 2026", function(){

    $holidays = \scalp\get_holidays(2026);
    expect($holidays["New Year's Day"])->toBe("2026-01-01");
    expect($holidays["St. Berchtold's Day"])->toBe("2026-01-02");
    expect($holidays["Epiphany"])->toBe("2026-01-06");
    expect($holidays["Martin Luther King, Jr. Day"])->toBe("2026-01-19");
    expect($holidays["Presidents' Day"])->toBe("2026-02-16");
    expect($holidays["Family Day"])->toBe("2026-02-16");
    expect($holidays["St. Patrick's Day"])->toBe("2026-03-17");
    expect($holidays["Holy Thursday"])->toBe("2026-04-02");
    expect($holidays["Good Friday"])->toBe("2026-04-03");
    expect($holidays["Easter Monday"])->toBe("2026-04-06");
    expect($holidays["Ascension Day"])->toBe("2026-05-14");
    expect($holidays["Eve of Ascension"])->toBe("2026-05-13");
    expect($holidays["Pentecost Monday"])->toBe("2026-05-25");
    expect($holidays["Liberation Day"])->toBe("2026-04-25");
    expect($holidays["Walpurgis Eve"])->toBe("2026-04-30");

    expect($holidays["First of May"])->toBe("2026-05-01");
    expect($holidays["Early May Bank Holiday"])->toBe("2026-05-04");

    expect($holidays["Victoria Day"])->toBe("2026-05-18");
    expect($holidays["Memorial Day"])->toBe("2026-05-25");
    expect($holidays["Spring Bank Holiday"])->toBe("2026-05-25");

    expect($holidays["Juneteenth"])->toBe("2026-06-19");
    expect($holidays["Midsummers Eve"])->toBe("2026-06-19");
    expect($holidays["Civic Holiday"])->toBe("2026-08-03");

    expect($holidays["Ferragosto"])->toBe("2026-08-15");
    expect($holidays["Summer Bank Holiday"])->toBe("2026-08-31");

    expect($holidays["Labor Day"])->toBe("2026-09-07");
    expect($holidays["Columbus Day"])->toBe("2026-10-12");
    expect($holidays["Canadian Thanksgiving"])->toBe("2026-10-12");

    expect($holidays["Swedish All Hallows' Eve"])->toBe("2026-10-30");
    expect($holidays["All Hallows' Eve"])->toBe("2026-10-31");
    expect($holidays["Halloween"])->toBe("2026-10-31");
    expect($holidays["All Hallows' Day"])->toBe("2026-11-01");

    expect($holidays["Veterans Day"])->toBe("2026-11-11");
    expect($holidays["Remembrance Day"])->toBe("2026-11-11");
    expect($holidays["Armistice Day"])->toBe("2026-11-11");
    expect($holidays["Thanksgiving"])->toBe("2026-11-26");
    expect($holidays["Black Friday"])->toBe("2026-11-27");

    expect($holidays["Constitution Day in Spain"])->toBe("2026-12-06");
    expect($holidays["Feast of the Immaculate Conception"])->toBe("2026-12-08");
    expect($holidays["Feast of the Immaculate Conception holiday"])->toBe("2026-12-08");

    expect($holidays["Independence Day holiday"])->toBe("2026-07-03");
    expect($holidays["Independence Day"])->toBe("2026-07-04");
});
