<?php
function cek($no){ 
    if ($no == 1) 
    return 0; 
    for ($i = 2; $i <= $no/2; $i++){ 
        if ($no % $i == 0) 
            return 0; 
    } 
    return 1; 
} 

function bilang($no1,$no2){
    $total=$no1*$no2;
    $a=1;
    $b=0;
    while(true){
        if(cek($a)==1){
            echo $a.", ";
            $b++;
        }
        if($b==$total){
            break;
        }
        $a++;
    }
}

bilang(3,4);
 ?>