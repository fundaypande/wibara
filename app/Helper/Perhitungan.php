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
      $mini = $data[0][0];
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
        $normMatrik[$i][$j] = $matrik[$i][$j] / $pembagi[$i];
      }
    }

    return $normMatrik;
  }

  //multiply() untuk mengalikan matriks
  function multiply($a, $b){
  	$r=count($a);
  	$c=count($b[0]);
  	$p=count($b);
    // dd(count($b[0]));
  	for ($i=0; $i < $r; $i++){
  			for($j=0; $j < $c; $j++){
  					$result[$i][$j] = 0;
  					for($k=0; $k < $p; $k++){
  							$result[$i][$j] += $a[$i][$k] * $b[$k][$j];
  					}
  			}
  	}
  	return $result;
  }

 ?>
