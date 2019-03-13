<?php

  function maxVertikal($data, $baris, $kolom)
  {
    $nilaiMax = null;
    for ($i=0;$i<$kolom;$i++){
      $maxi = 0;
      for ($j=0;$j<$baris;$j++){
        if($data[$j][$i] > $maxi){
          $maxi = $data[$j][$i];
        } else {
          $maxi = $maxi;
        }
      }
      $nilaiMax[$i] = $maxi;
    }
    // dd($nilaiMax);
    return $nilaiMax;
  }

  function minVertikal($data, $baris, $kolom)
  {
    $nilaiMin = null;

    for ($i=0;$i<$kolom;$i++){
      $mini = $data[0][$i];
      for ($j=0;$j<$baris;$j++){
        if($data[$j][$i] < $mini){
          $mini = $data[$j][$i];
        } else {
          $mini = $mini;
        }
      }
      $nilaiMin[$i] = $mini;
    }
    // dd($nilaiMin);
    return $nilaiMin;
  }

  function normalisasiMatrik($matrik, $pembagi, $baris, $kolom)
  {
    $normMatrik = null;
    for ($i=0;$i<$baris;$i++){
      for ($j=0;$j<$kolom;$j++){
        $normMatrik[$i][$j] = $matrik[$i][$j] / $pembagi[$j];
      }
    }

    return $normMatrik;
  }

  //multiply() untuk mengalikan matriks
  function multiply($a, $b){
    	$r=count($a);
    	$c=count($b[0]);
      // $p=count($);
      // dd(count($b[0]));
    	for ($i=0; $i < $r; $i++){
    			for($j=0; $j < $c; $j++){
    					$result[$i][$j] = 0;
    					for($k=0; $k < 3; $k++){
    							$result[$i][$j] += $a[$i][$k] * $b[$i];
    					}
    			}
    	}
    	return $result;
    }



  function roundArray($a){
		$r=count($a);
		for ($kolom=0;$kolom<$r;$kolom++){
      for ($i=0; $i < count($a[0]); $i++) {
        $c[$kolom][$i] = round($a[$kolom][$i], 4);
      }
		}
		return $c;
	}

  function minArray($data)
  {
    $mini = $data[0];
    $index = 0;
    for ($j=0;$j<count($data);$j++){
      if($data[$j] < $mini){
        $index = $j;
        $mini = $data[$j];
      } else {
        $mini = $mini;
        $index = $index;
      }
    }
    return $index;
  }

 //ANEKA project
 function rerata($data)
 {
   for ($i=0; $i < count($data); $i++) {
     $hasil = 0;
     for ($j=0; $j < count($data[0]); $j++) {
       $hasil = $hasil + $data[$i][$j];
     }
     $aray[$i] = $hasil;
   }

   for ($k=0; $k < count($aray); $k++) {
     $aray[$k] = $aray[$k]/count($data[0]);
     $roundAray[$k] = round($aray[$k],4);
   }

   $total = 0;
   for ($s=0; $s < count($aray); $s++) {
     $total = $total + $aray[$s];
   }

   return $roundAray;
 }


  function averageBobot($data)
  {
    // dd(count($data[0]));
    for ($i=0; $i < count($data); $i++) {
      $hasil = 0;
      for ($j=0; $j < count($data[0]); $j++) {
        $hasil = $hasil + $data[$i][$j];
      }
      $aray[$i] = $hasil;
    }

    for ($k=0; $k < count($aray); $k++) {
      $aray[$k] = $aray[$k]/count($data[0]);
      $roundAray[$k] = round($aray[$k],4);
    }

    $total = 0;
    for ($s=0; $s < count($aray); $s++) {
      $total = $total + $aray[$s];
    }

    // dd($roundAray);

    for ($n=0; $n < count($aray); $n++) {
      $average[$n] = $aray[$n]/$total;
      $average[$n] = round($average[$n],4);
    }

    return $average;
  }

  function maxVer($data)
  {
    $nilaiMax = null;
    for ($i=0;$i<count($data);$i++){
      $maxi = 0;
      for ($j=0;$j<count($data[0]);$j++){
        if($data[$j][$i] > $maxi){
          $maxi = $data[$j][$i];
        } else {
          $maxi = $maxi;
        }
      }
      $nilaiMax[$i] = $maxi;
    }
    // dd($nilaiMax);
    return $nilaiMax;
  }


  // function akhir($a, $b)
  // {
  //   for ($i=0; $i < count($a); $i++) {
  //     for ($j=0; $j < count($a[0]); $j++) {
  //       $data[$i] = ($b[$i]*$a[$i][$j])+
  //     }
  //   }
  // }



 ?>
