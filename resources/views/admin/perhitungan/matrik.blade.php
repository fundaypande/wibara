@extends('layouts.admin')

@section('content')


    <!-- Modal content-->
<?php
  //Data Konstanta ordo matrik
  $konstanta = 1;
  switch ($kriteria -> count()) {
	case 1:
		$konstanta = 0.00;
		break;
	case 2:
		$konstanta = 0.00;
		break;
	case 3:
		$konstanta = 0.58;
		break;
	case 4:
		$konstanta = 0.90;
		break;
	case 5:
		$konstanta = 1.12;
		break;
	case 6:
		$konstanta = 1.24;
		break;
  case 7:
		$konstanta = 1.32;
		break;
  case 8:
    $konstanta = 1.41;
    break;
  case 9:
    $konstanta = 1.45;
    break;
  case 10:
    $konstanta = 1.49;
    break;
  case 11:
    $konstanta = 1.51;
    break;
  case 12:
    $konstanta = 1.54;
    break;
  case 13:
    $konstanta = 1.56;
    break;
  case 14:
    $konstanta = 1.57;
    break;
  case 15:
    $konstanta = 1.59;
    break;

	default:
		  $konstanta = 1;
		break;
}

 ?>

<!-- end modal content -->

    <div class="row justify-content-center">

            <div style="padding-left: 20px; padding-right: 20px" class="card">
                <div class="card-header">
                  <h3>Bobot Matrik Perbandingan AHP</h3>

                </div>

                <div class="card-body">

                  @if(count($errors) > 0)
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors-> all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                  @endif


                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(session('warning'))
          					  <div class="alert alert-warning ">
          					    {{session('warning')}}
          					  </div>
          					@endif

          					@if(session('notif'))
          					  <div class="alert alert-primary">
          					    {{session('notif')}}
          					  </div>
          					@endif

                    <p>Daftar kriteria yang akan digunakan acuan dalam pemilihan IKM</p>
                    <br>

                    <!-- table show daftar user yang dapat mengakses sistem -->

                  <!-- Menampilkan dalam tabel -->
                  <table id="staf-table" width="100%" class="table table-striped table-bordered table-hover">
                  <thead>
                      <tr>
                				<th>Kriteria</th>
                				@foreach($kriteria as $krit)
                          <th>{{ $krit -> nama }}</th>
                        @endforeach
                      </tr>
                    </thead>


                    <?php
                    $i = 0;
                    $j = 0;
                    $s = 0;
                    $jumlahKriteria = $kriteria->count();

                    $matrik = roundArray($matrik);

                      for($baris=$i;$baris<$jumlahKriteria;$baris++) {
                          print('<tr>');
                          ?>
                          <th> <?php echo $kriteria[$s]->nama; $s++; ?> </th>

                          <?php
                          for($kolom=$j;$kolom<$jumlahKriteria;$kolom++) {
                              print("<td>{$matrik[$kolom][$baris]}</td>");
                          }
                          print('</tr>');
                      }


                    ?>
                    <tr>
                      <th>Jumlah</th>

                      <?php
                        // mencari jumlah masing2 vertikal
                          $r=$kriteria -> count();
                          $iLuar = 0;
                          $sumKolom = null;
                          for ($kolom=0;$kolom<$r;$kolom++){
                            $sum = 0;
                            for ($baris=0;$baris<$r;$baris++){
                              $sum = $sum + $matrik[$kolom][$baris];
                            }
                            $sumKolom[$kolom] = $sum;
                          }

                          // Menampilkan sum kolom pada table
                          for ($i=0; $i < $jumlahKriteria ; $i++) {
                            print("<td class='countTable'>{$sumKolom[$i]}</td>");
                          }

                          //normalisasi matrik
                          $normMatrik = null;
                          for ($kolom=0;$kolom<$r;$kolom++){
                            for ($baris=0;$baris<$r;$baris++){
                              $normMatrik[$kolom][$baris] = $matrik[$kolom][$baris] / $sumKolom[$kolom];
                            }
                          }

                          $normMatrik = roundArray($normMatrik);

                          // dd($normMatrik);
                       ?>
                    </tr>


                  </table>


                  <h3>Tabel Matrik Ternormalisasi</h3>
                  <table id="staf-table" width="100%" class="table table-striped table-bordered table-hover">
                  <thead>
                      <tr>
                				<th>Kriteria</th>
                				@foreach($kriteria as $krit)
                          <th>{{ $krit -> nama }}</th>
                        @endforeach
                        <th>Bobot</th>
                      </tr>
                    </thead>

                    <?php
                    // ** MENCARI BOBOT MASING2 KRITERIA

                    // menjumlahkan ke baris masing2 matrik ternormalisasi
                    // mencari jumlah masing2 horizontal
                      $r=$kriteria -> count();
                      $iLuar = 0;
                      $sumHorizontal = null;
                      for ($kolom=0;$kolom<$r;$kolom++){
                        $sum = 0;
                        for ($baris=0;$baris<$r;$baris++){
                          $sum = $sum + $normMatrik[$baris][$kolom];
                        }
                        $sumHorizontal[$kolom] = $sum/$r;
                      }

                      // dd($sumHorizontal);
                      //$sumHorizontal adalah nilai BOBOT



                    $i = 0;
                    $j = 0;
                    $s = 0;
                    // $jumlahKriteria = $kriteria->count();
                    //menampilkan matrik Ternormalisasi dalam tabel
                      for($baris=$i;$baris<$jumlahKriteria;$baris++) {
                          print('<tr>');
                          ?>
                          <th> <?php echo $kriteria[$s]->nama; $s++; ?> </th>

                          <?php
                          for($kolom=$j;$kolom<$jumlahKriteria;$kolom++) {
                              print("<td>{$normMatrik[$kolom][$baris]}</td>");
                          }
                          //menampilkan nilai bobot
                          print("<td class='countTable'>{$sumHorizontal[$baris]}</td>");
                          print('</tr>');
                      }
                    ?>


                    <?php
                    // ** MENGHITUNG EIGENT
                    $arrayJumlah = null;
                    $eigen = 0;
                    for($i=0;$i<$jumlahKriteria;$i++) {
                        $arrayJumlah[$i] = $sumKolom[$i] * $sumHorizontal[$i];
                    }

                    for($i=0;$i<$jumlahKriteria;$i++) {
                        $eigen = $eigen + $arrayJumlah[$i];
                    }
                    // echo "NILAI EIGEN:".$eigen;

                    // dd($arrayJumlah);

                    //Mencari nilai CI
                    $ci = ($eigen - $jumlahKriteria)/($jumlahKriteria-1);
                    $cr = $ci/$konstanta;

                    if($cr > 0.1){
                      echo '<script language="javascript">';
                        echo "alert('Data Tidak Konsisten Silahkan Ulangi Menginput Data Perbandingan')";
                      echo '</script>';

                      header("Location: /kriteria-ahp?message=success");
                      exit;
                    }

                     ?>

                   </table>

                     <div class="alert alert-primary">
                       Nilai Egian Maksimum = {{$eigen}}
                       <br>
                       Nilai CI = {{$ci}}
                       <br>
                       Nilai CR = {{$cr}}
                     </div>
                </div>

                <form method="post" data-toggle="validator" action="{{ url('/bobot/perbandingan/simpan') }}" id="theForm">
                  {{ csrf_field() }} {{ method_field('POST') }}

                  <?php
                    for ($i=0; $i < $jumlahKriteria ; $i++) {
                      ?>

                      <div class="form-group">
                        <label for="nama">{{ $kriteria[$i] -> nama }}</label>
                        <input type="text" name="{{ $kriteria[$i] -> id }}" value="{{ $sumHorizontal[$i] }}" class="form-control" id="nama" required placeholder="" readonly>
                      </div>

                      <?php
                    }
                   ?>

                   <button type="submit" class="btn btn-info btn-fill" id="simpan">Simpan Bobot</button>

                </form>

            </div>

    </div>




      <script src="{{ asset('js/rupiah.js') }}"></script>

    <script type="text/javascript">










    </script>

@endsection
