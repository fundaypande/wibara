<!-- Join dengan tabel lain -->
<?php

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

?>
