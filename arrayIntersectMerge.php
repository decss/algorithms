<?php 
/**
 * Search ranges like [4,7] and merge them if intersect
 * Not optimized
 * @param  array  $input    Array of range items [[1,5], [4,7], ...]
 * @return array            Result array with non-intersected ranges
 */
function arrayIntersectMerge(array $input): array
{
    usort($input, function($a, $b) {return $a[0] > $b[0];});
    $result = [array_shift($input)];

    foreach ($input as $value) {
        $last = $result[count($result) - 1];

        // In range
        if ($value[0] >= $last[0] && $value[1] <= $last[1]) {
            // skip

        // Intersect from right
        } else if (
            ($value[0] >= $last[0] && $value[0] <= $last[1] && $value[1] > $last[1])
            || ($value[0] - 1 == $last[1]) // next to the right
        ) {
            $last[1] = $value[1];
            $result[count($result) - 1] = $last;

        } else {
            $result[] = $value;
        }
    }

    return $result;
}
?>


<b>Test</b>
<pre>
<?php
$inputs = [
    ['2-4', '7-9', '1-3', ],
    ['7-10', '11-11', '15-15', '12-15', '44-49', '43-43', '50-51', ],
];
foreach ($inputs as $input) {
    $inputArray = [];
    foreach ($input as $value) {
        $inputArray[] = explode('-', $value);
    }

    echo 'For <b>[' . implode(', ', $input) . ']</b> ranges result is:<br>';
    print_r(arrayIntersectMerge($inputArray));
}
?>