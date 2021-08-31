<?php 
/**
 * Get 1d array items variations 
 * @param  array        $input     Flat array with values that will be combined
 * @param  int|integer  $depth     Combination depth/length ie 2 for 11, 12, 21, 22
 * @param  bool|boolean $anyLength Add to output results that less then $depth ie 1, 11 for $depth = 3
 * @return array                   Result combinations
 */
function arrayComposition(array $input, int $depth = 1, bool $anyLength = false): array
{
    $result = [];

    if ($depth < 1) {
        return [];

    } else if ($depth === 1) {
        foreach ($input as $value) {
            $result[] = [$value];
        }

    } else {
        $previous = arrayComposition($input, $depth - 1, $anyLength);
        
        foreach ($input as $value) {
            if ($anyLength) {
                $result[] = [$value];
            }
            foreach ($previous as $value2) {
                $result[] = array_merge([$value], $value2);
            }
        }
    }

    return $result;
}
?>


<b>Test</b>
<pre>
<?php
$array = [1, 2, 3];
$anyLength = true;

echo '<b>Alphabet:</b><br>';
print_r($array);

for ($i = 0; $i < 5; $i++) { 
    echo "<br><b>depth = {$i}:</b><br>";
    foreach (arrayComposition($array, $i, $anyLength) as $value) {
        echo implode(':', $value) . '<br>';
    }
    // print_r(arrayComposition($array, $i, $anyLength));
}
?>
</pre>