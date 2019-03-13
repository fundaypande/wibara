@extends('layouts.admin')

@section('content')

<div id="modal-form" class="modal fade" role="dialog" tabindex="1" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modal-title">Tambah Peralatan IKM</h4>
      </div>
      <div class="modal-body">
        <form method="post" data-toggle="validator" action="" id="theForm">
          {{ csrf_field() }} {{ method_field('POST') }}
        <div class="form-group">
          <label for="nama">Nama Komoditi</label>
          <input type="text" name="nama" value="" class="form-control" id="nama" required placeholder="">
        </div>


        <div class="form-group">
          <label for="spesifikasi">Spesifikasi</label>
          <textarea name="keterangan" class="form-control" id="keterangan" rows="2" ></textarea>
        </div>


        <button type="submit" class="btn btn-info btn-fill" id="simpan">Simpan Data</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </form>
      </div>
      <div class="modal-footer">

      </div>
    </div>

  </div>
</div>

<!-- end modal content -->

    <div class="row justify-content-center">

            <div style="padding-left: 20px; padding-right: 20px" class="card">
                <div class="card-header">
                  <h3>Judgement</h3>
                  <input type="hidden" name="" value="{{$form -> id}}" id="idForm">

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


                    <!-- table show daftar user yang dapat mengakses sistem -->
                    <div class="row">
                      <div class="com-md-12">
                        <div class="panel panel-default">

                          <div class="panel-body" style="overflow-x:auto;">
                            <table id="staf-table" width="100%" class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th width="50">ID</th>
                                  <th>Tri Hita Karana Aspects</th>
                                  <th>ANEKA Components</th>
                                  <th>ANEKA Aspects</th>
                                  <th>ANEKA Indicators</th>
                                  <th>Value</th>

                                </tr>
                              </thead>
                              <tbody>

                              </tbody>
                            </table>
                          </div>

                          <?php
                            //normalisasi matrik
                            $normA = roundArray(normalisasiMatrik($matrikA, $maxA, 5, 3));
                            $normB = roundArray(normalisasiMatrik($matrikB, $maxB, 5, 3));
                            $normC = roundArray(normalisasiMatrik($matrikC, $maxC, 5, 3));


                            //memecah nilai bobot menjadi 3 bagian thk
                            $x = 0;
                            for ($i=0; $i < 5; $i++) {
                              // code...
                              $bobotA[$i] = $nilaiBobot[$x];
                              $x++;
                            }
                            $x = 5;
                            for ($i=0; $i < 5; $i++) {
                              // code...
                              $bobotB[$i] = $nilaiBobot[$x];
                              $x++;
                            }
                            $x = 10;
                            for ($i=0; $i < 5; $i++) {
                              // code...
                              $bobotC[$i] = $nilaiBobot[$x];
                              $x++;
                            }

                            // dd($bobotA);

                            $perkalianA = roundArray(multiply($normA, $bobotA));
                            $perkalianB = roundArray(multiply($normB, $bobotB));
                            $perkalianC = roundArray(multiply($normC, $bobotC));

                            // dd($perkalianA);
                           ?>

                           <h4>Normalization</h4>

                          <!-- menampilkan data -->
                          <div class="panel-body" style="overflow-x:auto;">
                            <h4>Parahyangan</h4>
                            <?php
                              $aneka = ['Accountability','Nationalism','Public Ethics','Quality Commitment', 'Anti-Corruption'];
                              $standar = ['Antecedents Standard','Transaction Standard','Outcomes Standard'];
                             ?>
                            <table id="staf-table" width="100%" class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>ANEKA Aspect</th>
                                  <th>Antecedents Standard </th>
                                  <th>Transaction Standard</th>
                                  <th>Outcomes Standard</th>
                                  <th style="color:blue"><b>Ranking Process (V)</b></th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php for ($i=0; $i < 5; $i++) {
                                 ?>
                                  <tr>
                                    <td>{{$aneka[$i]}}</td>
                                    <?php for ($j=0; $j < 3; $j++) {
                                    ?>
                                      <td>{{ $matrikA[$i][$j] }}</td>
                                    <?php }  ?>

                                    <td style="color:blue"><b>{{$perkalianA[$i][0]}}</b></td>

                                  </tr>
                                <?php } ?>
                                <tr>
                                  <b><td style="color:blue">Max Value</td></b>
                                @foreach($maxA as $key => $makA)
                                  <b><td style="color:blue">{{$makA}}</td></b>
                                @endforeach
                                </tr>

                              </tbody>
                            </table>
                          </div>


                          <div class="panel-body" style="overflow-x:auto;">
                            <h4>Pawongan</h4>
                            <?php
                              $aneka = ['Accountability','Nationalism','Public Ethics','Quality Commitment', 'Anti-Corruption'];
                              $standar = ['Antecedents Standard','Transaction Standard','Outcomes Standard'];
                             ?>
                            <table id="staf-table" width="100%" class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>ANEKA Aspect</th>
                                  <th>Antecedents Standard </th>
                                  <th>Transaction Standard</th>
                                  <th>Outcomes Standard</th>
                                  <th style="color:blue"><b>Ranking Process (V)</b></th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php for ($i=0; $i < 5; $i++) {
                                 ?>
                                  <tr>
                                    <td>{{$aneka[$i]}}</td>
                                    <?php for ($j=0; $j < 3; $j++) {
                                    ?>
                                      <td>{{ $matrikB[$i][$j] }}</td>

                                    <?php }  ?>

                                    <td style="color:blue"><b>{{$perkalianB[$i][0]}}</b></td>

                                  </tr>
                                <?php } ?>
                                <tr>
                                  <b><td style="color:blue">Max Value</td></b>
                                @foreach($maxB as $key => $makB)
                                  <b><td style="color:blue">{{$makB}}</td></b>
                                @endforeach
                                </tr>
                              </tbody>
                            </table>
                          </div>


                          <div class="panel-body" style="overflow-x:auto;">
                            <h4>Palemahan</h4>
                            <?php
                              $aneka = ['Accountability','Nationalism','Public Ethics','Quality Commitment', 'Anti-Corruption'];
                              $standar = ['Antecedents Standard','Transaction Standard','Outcomes Standard'];
                             ?>
                            <table id="staf-table" width="100%" class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>ANEKA Aspect</th>
                                  <th>Antecedents Standard </th>
                                  <th>Transaction Standard</th>
                                  <th>Outcomes Standard</th>
                                  <th style="color:blue"><b>Ranking Process (V)</b></th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php for ($i=0; $i < 5; $i++) {
                                 ?>
                                  <tr>
                                    <td>{{$aneka[$i]}}</td>
                                    <?php for ($j=0; $j < 3; $j++) {
                                    ?>
                                      <td>{{ $matrikC[$i][$j] }}</td>

                                    <?php }  ?>

                                    <td style="color:blue"><b>{{$perkalianC[$i][0]}}</b></td>

                                  </tr>
                                <?php } ?>
                                <tr>
                                  <b><td style="color:blue">Max Value</td></b>
                                @foreach($maxC as $key => $makC)
                                  <b><td style="color:blue">{{$makC}}</td></b>
                                @endforeach
                                </tr>
                              </tbody>
                            </table>
                          </div>










                      </div>
                    </div>


                </div>
            </div>

    </div>


    <script type="text/javascript">
    var table;
    $(document).ready(function() {

      var idForm = $('#idForm').val();

      table = $('#staf-table').DataTable({
        order: [[ 2, 'asc' ]],
        processing: true,
        serverSide: true,
        ajax: "/api/outcome/"+idForm,
        columns: [
          {data: 'id', name: 'id'},
          {data: 'thk', name: 'thk'},
          {data: 'aneka', name: 'aneka'},
          {data: 'aspek', name: 'aspek'},
          {data: 'butir', name: 'butir'},
          {data: 'value', name: 'value'},
        ]
      });


    });










    </script>

@endsection
