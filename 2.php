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

function sub1($a){
    foreach ($a as $id => $total) {
        //echo $id." -> ".count($total). " data <br>";
        $b[$id] = urutno($a[$id]);
    }
    return $b;
}
function sub2($a){
    return urutno(sub1($a));
}

echo "<pre>";
$data=[['T','S','Q','P','R'],['W','U','V']];
$datalain = [['M','L','O','N'],['T','S','Q','P','R'],['W','U','V']];
print_r(sub2($data));
//echo(json_encode($b));
