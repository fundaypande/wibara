<!-- Join dengan tabel lain -->
<?php

{!! json_encode($series) !!}

//membuat public function https://www.kerneldev.com/2017/12/05/how-to-add-a-global-function-in-laravel-using-composer/

// join dengan tabel lain
$dataKrit = DataKriteria::join('kriterias', 'kriterias.id', '=', 'data_kriterias.id_kriteria')
            ->select('data_kriterias.*', 'kriterias.nama')
            ->where([
                ['id_user', '=', $idUser],
                ['tahun', '=', $tahun]
              ])
            ->get();


// Menampilkan error dari required controller
@if(count($errors) > 0)
<div class="alert alert-danger">
  <ul>
    @foreach ($errors-> all() as $error)
      <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif


SELECT data_kriterias.*, profilikm.jarak FROM `data_kriterias`
INNER JOIN users ON data_kriterias.id_user=users.id
INNER JOIN profilikm ON profilikm.user_id=users.id
WHERE tahun = '2019'


function maxVertikal($data, $baris, $kolom, $jenis)
{
  $maxi = 0;
  $mini = $data[0][0];
  $nilaiMax = null;
  $nilaiMin = null;
  for ($i=0;$i<$baris;$i++){
    for ($j=0;$j<$kolom;$j++){
      if($maxi < $data[$i][$j]){
        $maxi = $data[$i][$j];
      } else if($mini > $data[$i][$j]) {
        $mini = $data[$i][$j];
      }
    }
    $nilaiMax[$i] = $maxi;
    $nilaiMin[$i] = $mini;
  }
  dd($nilaiMin);
  return $nilaiMax;
}

?>




<!-- edit data profil -->
<?php $i = 0; ?>
@foreach($kriteria as $data)
<?php $data ?>
<!-- cek apakah nama kriteria adalah jarak, jika ia maka isikan nilainya -->
@if($data -> nama == 'jarak' || $data -> nama == 'Jarak')
  <?php
    $read = 'readonly';
   ?>
@else
  {{ $read = null }}
@endif

<?php
//membatasi agar nilai dari kriteria yang belum diisi berinilai 0
$dataNilai = null;
// echo $i;
// echo "<br />";
  if($i > $dataKrit -> count()-1){
    $dataNilai[$i] = 0;
  } else {
    $dataNilai[$i] = $dataKrit[$i] -> nilai;
  }
 ?>

  <div class="form-group">
    <label for="{{ $data -> id }}">{{ $data -> nama }}</label>
    <input type="text" name="{{ $data -> id }}" value="{{ $dataNilai[$i] }}" class="form-control" id="{{ $data -> id }}" required {{$read}}  placeholder="">
    <input type="hidden" name="idData" value="{{ $data -> id }}" class="form-control">
  </div>
  <?php $i++; ?>
@endforeach
