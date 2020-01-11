<?php
/* Seseorang mengendarai mobil dengan kecepatan tetap. Tepat pukul
05:25:15 pagi kecepatan masih tetap 3 m/detik. Tetapi sepuluh menit
kemudian, kecepatannya dinaikkan 1m/detik sehingga kecepatan
menjadi tetap 4 m/detik. Demikian 7 menit berikutnya kecepatannya
selalu dinaikkan 1 m/detik. Susun algoritma untuk sampai jam tepat
menunjukkan 09:00:00 pagi pada hari yang sama */


$mobil['mulai']=array(
    'waktu' => '05:25:15',
    'kecepatan' => 3
);
$mobil['sampai']=array(
    'waktu' => '09:00:00'
);

$wmulai = explode(":", $mobil['mulai']['waktu']);
$wakhir = explode(":", $mobil['sampai']['waktu']);
$kecepatan = 3;
$indikator1= explode(":", '00:10:00');
$indikator2= explode(":", '00:17:00');

$mulai = $wmulai[0]*3600 + $wmulai[1]*60 + $wmulai[2];
$akhir = $wakhir[0]*3600 + $wakhir[1]*60 + $wakhir[2];
$indi1 = $mulai + $indikator1[0]*3600 + $indikator1[1]*60 + $indikator1[2];
$indi2 = $mulai + $indikator2[0]*3600 + $indikator2[1]*60 + $indikator2[2];


for($a=$mulai;$a<$akhir;$a++){
    $hours = floor($a / 3600);
    $minutes = floor(($a / 60) % 60);
    $seconds = $a % 60;
    if($a == $indi1){
        $kecepatan = $kecepatan + 1;
    }elseif($a >= $indi2){
        $kecepatan = $kecepatan + 1;
    }else{
        $kecepatan = $kecepatan;
    }
    echo $hours." : ";
    echo $minutes." : ";
    echo $seconds." | Kecepatan : ".$kecepatan."m <br>";
}


?>