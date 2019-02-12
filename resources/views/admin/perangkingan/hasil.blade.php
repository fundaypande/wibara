@extends('layouts.admin')

@section('content')


    <div class="row justify-content-center">

            <div style="padding-left: 20px; padding-right: 20px" class="card">
                <div class="card-header">
                  <h3>Hasil Proses Perangkingan</h3>

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

                    <p>Berikut merupakan hasil perangkingan</p>
                    <br>

                    <!-- table show daftar user yang dapat mengakses sistem -->
                    <div class="row">
                      <div class="col-md-12">


                        <!-- content is here -->
                        <table id="staf-table" width="100%" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                      				<th>-</th>
                      				@foreach($kriteria as $krit)
                                <th>{{ $krit -> nama }}</th>
                              @endforeach
                              <!-- <th>Jarak</th> -->
                            </tr>
                            <tr>
                      				<th>-</th>
                      				@foreach($kriteria as $krit)
                                <th>{{ $krit -> keterangan }}</th>
                              @endforeach
                              <!-- <th>cost</th> -->
                            </tr>
                        </thead>

                        <?php


                        $jumlahIkm = count($data);
                        // dd($jumlahIkm);
                        $jumlahKriteria = $kriteria->count();

                        // Membuat matrik baru vertikal dengan metode max
                        // $r=$data -> count();


                        // Inisialiasi array min max benefit and cost
                        $arrayMax = maxVertikal($data, $jumlahIkm, $jumlahKriteria);

                        $arrayMin = minVertikal($data, $jumlahIkm, $jumlahKriteria);
                        $arrayMaxMin = null;
                        for ($i=0; $i < $jumlahKriteria ; $i++) {
                          if($kriteria[$i] -> keterangan == 'benefit'){
                            $arrayMaxMin[$i] = $arrayMax[$i];
                          } else {
                            $arrayMaxMin[$i] = $arrayMin[$i];
                          }
                        }

                        // dd($arrayMaxMin);

                        $i = 0;
                        $j = 0;
                        $s = 0;
                        // $jumlahKriteria = $kriteria->count();
                        //menampilkan matrik data alternative dalam tabel
                          for($baris=$i;$baris<$jumlahIkm;$baris++) {
                              print('<tr>');
                              ?>
                              <th> <?php echo $ikm[$s]->name; $s++; ?> </th>

                              <?php
                              for($kolom=$j;$kolom<$jumlahKriteria;$kolom++) {
                                  print("<td>{$data[$baris][$kolom]}</td>");
                              }

                              //menampilkan nilai bobot
                              print('</tr>');
                          }




                        ?>

                        <tr>
                          <th>Max/Min</th>

                          <?php
                            for ($i=0; $i < $jumlahKriteria ; $i++) {
                              print("<td class='countTable'>{$arrayMaxMin[$i]}</td>");
                            }
                            // dd($data);
                           ?>

                        </tr>









                      </table>
                      <!-- end tabel data kriteria -->

                      <h3>Tabel Normalisasi Matrik Dengan Metode Benefit And Cost</h3>

                      <?php
                      //normalisasi matrik dengan metode benefit and cost
                      //normalisasi matrik
                      $matrikNormBenefitCost = null;
                      for ($i=0;$i<$jumlahKriteria;$i++){
                        for ($j=0;$j<$jumlahIkm;$j++){
                          if($kriteria[$i] -> keterangan == 'benefit'){
                            $matrikNormBenefitCost[$j][$i] = $data[$j][$i] / $arrayMaxMin[$i];
                          } else {
                            $matrikNormBenefitCost[$j][$i] = $arrayMaxMin[$i] / $data[$j][$i];
                          }
                        }
                      }

                        // dd($matrikNormBenefitCost);
                      ?>

                      <table id="staf-table" width="100%" class="table table-striped table-bordered table-hover">
                      <thead>
                          <tr>
                            <th>-</th>
                            @foreach($kriteria as $krit)
                              <th>{{ $krit -> nama }}</th>
                            @endforeach
                            <!-- <th>Jarak</th> -->
                          </tr>
                          <tr>
                            <th>-</th>
                            @foreach($kriteria as $krit)
                              <th>{{ $krit -> keterangan }}</th>
                            @endforeach
                            <!-- <th>cost</th> -->
                          </tr>
                      </thead>

                      <?php
                      //menampilkan matrik data alternative dalam tabel
                      $s = 0;
                        for($i=0;$i<$jumlahIkm;$i++) {
                            print('<tr>');
                            ?>
                            <th> <?php echo $ikm[$s]->name; $s++; ?> </th>

                            <?php
                            for($j=0;$j<$jumlahKriteria;$j++) {
                                print("<td>{$matrikNormBenefitCost[$i][$j]}</td>");
                            }

                            //menampilkan nilai bobot
                            print('</tr>');
                        }

                       ?>

                     </table>






                        <!-- end of content -->


                      </div>
                    </div>


                </div>
            </div>

    </div>


    <script type="text/javascript">

    $(document).ready(function() {






    });



    </script>

@endsection
