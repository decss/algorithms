<?php
/**
 * Notes:
 * - for recursive functions "static $a" is very important for memorization (cahce) mechanism
 * - recursive functions can't fire with big $n ($n > 510) somewhere due to "function nesting level" limitation
 * 
 */


/**
 * Recursive Fibonacci function
 * 
 * @param  int $n   position number (from 0 to +inf)
 * @return int
 */
function fibRecursive($n)
{
    static $a = [
        0 => 0,
        1 => 1,
    ];

    if ($n < 0) {
        return false;
    }

    if (!isset($a[$n])) {
        $a[$n] = fibRecursive($n - 2) + fibRecursive($n - 1);
    }
    return $a[$n];
}

/**
 * Recursive Fibonacci function with negative $n support
 * 
 * @param  int $n   position number (from -inf to +inf)
 * @return int
 */
function fibRecursiveNeg($n)
{
    static $a = [
        0 => 0,
        1 => 1,
    ];
    $na = abs($n);

    if (!isset($a[$na])) {
        $a[$na] = fibRecursive($na - 2) + fibRecursive($na - 1);
    }
    $result = $a[$na];

    // For negative $n
    if ($n < 0 && $n % 2 == 0) {
        $result = -1 * $result;
    }

    return $result;
}


/**
 * Cycled Fibonacci function
 * 
 * @param  int $n   position number (from 0 to +inf)
 * @return int
 */
function fibCycle($n)
{
    $a = [
        0 => 0,
        1 => 1,
    ];

    for ($i = 2; $i <= $n ; $i++) { 
        $a[$i] = $a[$i - 2] + $a[$i - 1];
    }
    return $a[$n];
}
/**
 * Cycled Fibonacci function with negative $n support
 * 
 * @param  int $n   position number (from -inf to +inf)
 * @return int
 */
function fibCycleNeg($n)
{
    $a = [
        0 => 0,
        1 => 1,
    ];
    $na = abs($n);

    for ($i = 2; $i <= $na ; $i++) { 
        $a[$i] = $a[$i - 2] + $a[$i - 1];
    }
    $result = $a[$na];

    // For negative $n
    if ($n < 0 && $n % 2 == 0) {
        $result = -1 * $result;
    }

    return $result;
}
?>



<h2>Test 1</h2>
<pre>
<?php
$n      = 48;
$nNeg   = -1 * $n;
echo "fibCycle({$n}):  " . fibCycle($n) . "
fibCycleNeg({$nNeg}):  " . fibCycleNeg($nNeg) . "
fibRecursive({$n}):  " . fibRecursive($n) . "
fibRecursiveNeg({$nNeg}):  " . fibRecursiveNeg($nNeg);
?>
</pre>


<?php
$i1 = -10;
$i2 = 30;
?>
<h2>Test 2</h2>
<table>
    <tr>
        <th></th>
        <?php for ($n = $i1; $n <= $i2 ; $n++) {
            echo '<th>' . $n . '</th>';
        } ?>
    </tr>
    <tr>
        <td>fibCycle</td>
        <?php for ($n = $i1; $n <= $i2 ; $n++) {
            echo '<td>' . fibCycle($n) . '</td>';
        } ?>
    </tr>
    <tr>
        <td>fibRecursive</td>
        <?php for ($n = $i1; $n <= $i2 ; $n++) {
            echo '<td>' . fibRecursive($n) . '</td>';
        } ?>
    </tr>
    <tr>
        <td>fibCycleNeg</td>
        <?php for ($n = $i1; $n <= $i2 ; $n++) {
            echo '<td>' . fibCycleNeg($n) . '</td>';
        } ?>
    </tr>
    <tr>
        <td>fibRecursiveNeg</td>
        <?php for ($n = $i1; $n <= $i2 ; $n++) {
            echo '<td>' . fibRecursiveNeg($n) . '</td>';
        } ?>
    </tr>
</table>


<style type="text/css">
    h2 {margin: 10px 0 5px 0; font-size: 20px;}
    table {font-size: 14px; border-collapse: collapse;}
    table td, table th {padding: 2px 3px; border: 1px solid #bbb;}
</style>