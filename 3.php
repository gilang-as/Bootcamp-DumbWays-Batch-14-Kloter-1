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

function bilang($total){
    $a=1;
    $b=0;
    while(true){
        if(cek($a)==1){
            $prima[]=$a.", ";
            $b++;
        }
        if($b==$total){
            break;
        }
        $a++;
    }
    return $prima;
}
//print_r(bilang(50));
function total($total){
    $z=0;
    for($a=1;$a<=$total;$a++){
        for($b=1;$b<=$a;$b++){
            $z++;
        }
    } 
    return $z;
}

function cetak($total){
    $totdata = total($total);
    $data = bilang($totdata);
    $z=0;
    for($a=1;$a<=$total;$a++){
        for($b=1;$b<=$a;$b++){
            echo $data[$z]."  ";
            $z++;
        }
       echo "<br>";
    }
}

cetak(8);

?>