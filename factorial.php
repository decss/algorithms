<?php

/**
 * Cycled Factorial function
 * 
 * @param  int $n   from 0 to +inf
 * @return int
 */
function factorialCycle($n)
{
    if ($n < 0) {
        return false;
    }

    $result = 1;
    for ($i = 1; $i <= $n; $i++) {
        $result = $result * $i;
    }

    return $result;
}

/**
 * Recursive Factorial function
 * 
 * @param  int $n   from 0 to +inf
 * @return int
 */
function factorialRecursive($n)
{
    static $a = [
        0 => 1, 
    ];

    if ($n < 0) {
        return false;
    }

    if (!isset($a[$n])) {
        $a[$n] = factorialRecursive($n - 1) * $n;
    }

    return $a[$n];
}
?>