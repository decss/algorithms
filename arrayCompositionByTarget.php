<?php 
/**
 * Get uniq combinations of array items
 * Each combination contains the least number of elements to reach $target sum 
 * @param  array    $input      Flat array with values that will be combined
 * @param  int      $target     Sequense sum target limit
 * @return array                Result combinations
 */
function arrayCompositionByTarget(array $input, int $target = 1, array $sequence = [])
{
    static $result = [];

    // Clear static $result (for new calls) to prevent data flow between calls
    if (!$sequence) {
        $result = [];
    }

    // When sequence sum reach limit - add sequence to result array
    if (array_sum($sequence) >= $target) {
        rsort($sequence);
        
        // Filter sequences - check for redundant values
        $new = [];
        while (array_sum($new) < $target && $sequence) {
            $new[] = array_shift($sequence);
        }
        // Store only uniq sequences
        if (!in_array($new, $result)) {
            array_push($result, $new);
        }

        return false;
    }

    // Init loop
    foreach ($input as $value) {
        arrayCompositionByTarget($input, $target, array_merge($sequence, [$value]));
    }

    return $result;
}
?>


<b>Test</b>
<pre>
<?php
$array = [3, 6, 11];
$target = 22;
$combinations = arrayCompositionByTarget($array, $target);
rsort($combinations);

echo "Uniq combinations of <b>" . implode(',', $array) ."</b> with target sum = <b>{$target}</b><br>";
foreach ($combinations as $value) {
    echo implode(':', $value) . ' - ' . array_sum($value) . '<br>';
}
?>
</pre>