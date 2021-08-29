<?php 

/**
 * Convert 24h to 12 and handle 12 o'clock (to 0h)
 */
function normalizeHour(int $hour): int {
    if ($hour == 12) {
        $hour = 0;
    } elseif ($hour >= 13) {
        $hour = $hour - 12;
    }

    return $hour;
}

/**
 * Angle between 12:00 and minute hand
 */
function getMinuteAngle(int $minute): float {
    $minuteAngle = 360 / 60 * $minute;

    return $minuteAngle;
}

/**
 * Angle between 12:00 and hour hand
 */
function getHourAngle(int $hour, int $minute): float {
    $minuteAngle = getMinuteAngle($minute);
    $hourAngle  = 360 / 12 * $hour
                + (1 / 12 * $minuteAngle);

    return $hourAngle;
}

/**
 * Angle between hour and minute hand of the clock
 * @param  int $hour        Hour value
 * @param  int $minute      Minutes value
 * @param  bool $closest    Return closest angle between clock hands instead of clockwise-direction angle
 * @return float
 */
function getClockAngle(int $hour, int $minute = 0, bool $closest = false): float {
    // 0. Normalize hours (24h to 12h)
    $hour       = normalizeHour($hour);

    // 1. Calc angle between 12:00 and minute hand
    $minuteAngle = getMinuteAngle($minute);

    // 2. Calc angle between 12:00 and hour hand
    $hourAngle  = getHourAngle($hour, $minute);

    // 3. subtract angles and get result
    $angle      = abs($hourAngle - $minuteAngle);

    // closest angle between clock hands instead of clockwise-direction angle
    if ($closest && $angle > 180) {
        $angle = 360 - $angle;
    }

    return $angle;
}
?>


<b>Test</b>
<pre>
<?php
function printClockAngle($hour, $minute = 0, $closest = false) {
    $result = str_pad($hour, 2, '0', STR_PAD_LEFT) . ':'
            . str_pad($minute, 2, '0', STR_PAD_LEFT) . ' = '
            . getClockAngle($hour, $minute, $closest) 
            . ' deg<br>';

    echo $result;
}

printClockAngle(0, 59);
printClockAngle(0, 59, true);
printClockAngle(2, 15);
printClockAngle(14, 15);
printClockAngle(16, 30);
printClockAngle(17, 30);
printClockAngle(18, 30);
printClockAngle(11, 59);
printClockAngle(12, 59);
printClockAngle(13, 59);
?>
</pre>