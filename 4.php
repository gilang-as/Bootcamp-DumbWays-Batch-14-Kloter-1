<?php
function urutno($data){
    //simpel
    //asort($data);
    //manual
    $count = count($data);
    for ($i = 0; $i < $count; $i++) {
        for ($j = $i + 1; $j < $count; $j++) {
            if ($data[$i] > $data[$j]) {
                $temp = $data[$i];
                $data[$i] = $data[$j];
                $data[$j] = $temp;
            }
        }
    }
    return $data;
}

$a=[['g','h','i','j'],['a','c','b','e','d'],['g','e','f']];
print_r(urutno($a));