<?php
$array[0] = 234;
$array[1] = 123;
$array[2] = 400;
$array[3] = 240;
$array[4] = 108;
$array[5] = 115;
var_dump($array);
for ($i = 1; $i < 6; $i++) {
    for ($j = 0; $j < 6 - $i; $j++) {
        if ($array[$j] < $array[$j + 1]) {
            $temp = $array[$j];
            $array[$j] = $array[$j + 1];
            $array[$j + 1] = $temp;
        }
    }
}

var_dump($array);
?>

