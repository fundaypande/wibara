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
                  <h2>Judgement Matrix</h2>
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
                          // dd($matrikA);
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


                           <!-- START Tambahkan tabel normalisasi  -->

                           <h3 style="margin-left: 20px">Normalization Process</h3>


                           <div class="panel-body" style="overflow-x:auto;">
                           <h4>Normalization Process of Parahyangan</h4>
                           <?php
                             $aneka = ['Accountability','Nationalism','Public Ethics','Quality Commitment', 'Anti-Corruption'];
                             $standar = ['Antecedents Standard','Transaction Standard','Outcomes Standard'];
                            ?>
                           <table id="" width="100%" class="table table-striped table-bordered table-hover">
                             <thead>
                               <tr>
                                 <th>ANEKA Aspect</th>
                                 <th>Antecedents Standard </th>
                                 <th>Transaction Standard</th>
                                 <th>Outcomes Standard</th>
                               </tr>
                             </thead>
                             <tbody>
                               <?php for ($i=0; $i < 5; $i++) {
                                ?>
                                 <tr>
                                   <td>{{$aneka[$i]}}</td>
                                   <?php for ($j=0; $j < 3; $j++) {
                                   ?>
                                     <td>{{ $normA[$i][$j] }}</td>
                                   <?php }  ?>


                                 </tr>
                               <?php } ?>

                             </tbody>
                           </table>
                         </div>


                         <div class="panel-body" style="overflow-x:auto;">
                         <h4>Normalization Process of Pawongan</h4>
                         <?php
                           $aneka = ['Accountability','Nationalism','Public Ethics','Quality Commitment', 'Anti-Corruption'];
                           $standar = ['Antecedents Standard','Transaction Standard','Outcomes Standard'];
                          ?>
                         <table id="" width="100%" class="table table-striped table-bordered table-hover">
                           <thead>
                             <tr>
                               <th>ANEKA Aspect</th>
                               <th>Antecedents Standard </th>
                               <th>Transaction Standard</th>
                               <th>Outcomes Standard</th>
                             </tr>
                           </thead>
                           <tbody>
                             <?php for ($i=0; $i < 5; $i++) {
                              ?>
                               <tr>
                                 <td>{{$aneka[$i]}}</td>
                                 <?php for ($j=0; $j < 3; $j++) {
                                 ?>
                                   <td>{{ $normB[$i][$j] }}</td>
                                 <?php }  ?>


                               </tr>
                             <?php } ?>

                           </tbody>
                         </table>
                       </div>


                       <div class="panel-body" style="overflow-x:auto;">
                       <h4>Normalization Process of Palemahan</h4>
                       <?php
                         $aneka = ['Accountability','Nationalism','Public Ethics','Quality Commitment', 'Anti-Corruption'];
                         $standar = ['Antecedents Standard','Transaction Standard','Outcomes Standard'];
                        ?>
                       <table id="" width="100%" class="table table-striped table-bordered table-hover">
                         <thead>
                           <tr>
                             <th>ANEKA Aspect</th>
                             <th>Antecedents Standard </th>
                             <th>Transaction Standard</th>
                             <th>Outcomes Standard</th>
                           </tr>
                         </thead>
                         <tbody>
                           <?php for ($i=0; $i < 5; $i++) {
                            ?>
                             <tr>
                               <td>{{$aneka[$i]}}</td>
                               <?php for ($j=0; $j < 3; $j++) {
                               ?>
                                 <td>{{ $normC[$i][$j] }}</td>
                               <?php }  ?>


                             </tr>
                           <?php } ?>

                         </tbody>
                       </table>
                     </div>




                         <!-- END tampilkan normalisasi -->



                           <h3 style="margin-left: 20px">Recommendation</h3>

                          <!-- menampilkan data -->
                          <div class="panel-body" style="overflow-x:auto;">
                            <h4>List of Priority Indicators on Parahyangan Aspects</h4>
                            <?php
                              $aneka = ['Accountability','Nationalism','Public Ethics','Quality Commitment', 'Anti-Corruption'];
                              $standar = ['Antecedents Standard','Transaction Standard','Outcomes Standard'];
                             ?>
                            <table id="thkA" width="100%" class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>ANEKA Aspect</th>
                                  <th>Indicators</th>
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
                                    <td>{{$indicatorA[$i]}}</td>
                                    <?php for ($j=0; $j < 3; $j++) {
                                    ?>
                                      <td>{{ $matrikA[$i][$j] }}</td>
                                    <?php }  ?>

                                    <td style="color:blue"><b>{{$perkalianA[$i][0]}}</b></td>

                                  </tr>
                                <?php } ?>
                                <!-- <tr>
                                  <b><td style="color:blue">Max Value</td></b>
                                @foreach($maxA as $key => $makA)
                                  <b><td style="color:blue">{{$makA}}</td></b>
                                @endforeach
                                  <b><td style="color:blue">-</td></b>
                                </tr> -->

                              </tbody>
                            </table>
                          </div>


                          <div class="panel-body" style="overflow-x:auto;">
                            <h4>List of Priority Indicators on Pawongan Aspects</h4>
                            <?php
                              $aneka = ['Accountability','Nationalism','Public Ethics','Quality Commitment', 'Anti-Corruption'];
                              $standar = ['Antecedents Standard','Transaction Standard','Outcomes Standard'];
                             ?>
                            <table id="thkB" width="100%" class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>ANEKA Aspect</th>
                                  <th>Indicators</th>
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
                                    <td>{{$indicatorB[$i]}}</td>
                                    <?php for ($j=0; $j < 3; $j++) {
                                    ?>
                                      <td>{{ $matrikB[$i][$j] }}</td>

                                    <?php }  ?>

                                    <td style="color:blue"><b>{{$perkalianB[$i][0]}}</b></td>

                                  </tr>
                                <?php } ?>
                                <!-- <tr>
                                  <b><td style="color:blue">Max Value</td></b>
                                @foreach($maxB as $key => $makB)
                                  <b><td style="color:blue">{{$makB}}</td></b>
                                @endforeach
                                </tr> -->
                              </tbody>
                            </table>
                          </div>


                          <div class="panel-body" style="overflow-x:auto;">
                            <h4>List of Priority Indicators on Palemahan Aspects</h4>
                            <?php
                              $aneka = ['Accountability','Nationalism','Public Ethics','Quality Commitment', 'Anti-Corruption'];
                              $standar = ['Antecedents Standard','Transaction Standard','Outcomes Standard'];
                             ?>
                            <table id="thkC" width="100%" class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>ANEKA Aspect</th>
                                  <th>Indicators</th>
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
                                    <td>{{$indicatorC[$i]}}</td>
                                    <?php for ($j=0; $j < 3; $j++) {
                                    ?>
                                      <td>{{ $matrikC[$i][$j] }}</td>

                                    <?php }  ?>

                                    <td style="color:blue"><b>{{$perkalianC[$i][0]}}</b></td>

                                  </tr>
                                <?php } ?>
                                <!-- <tr>
                                  <b><td style="color:blue">Max Value</td></b>
                                @foreach($maxC as $key => $makC)
                                  <b><td style="color:blue">{{$makC}}</td></b>
                                @endforeach
                                </tr> -->
                              </tbody>
                            </table>
                          </div>



                          <!-- mencari nilai perangkingan -->
                          <?php
                            //agar data perkalian matrik menjadi 1 baris array
                            for ($i=0; $i < 5; $i++) {
                              $rangkingA[] = $perkalianA[$i][0];
                              $rangkingB[] = $perkalianB[$i][0];
                              $rangkingC[] = $perkalianC[$i][0];
                            }

                            // dd($rangkingA);
                            //mencari nilai minimal perangkingan dan indexks nilai minimalnya
                            $idMinA = array_keys(($rangkingA), min($rangkingA));
                            $dataMinA = min($rangkingA);

                            $idMinB = array_keys(($rangkingB), min($rangkingB));
                            $dataMinB = min($rangkingB);

                            $idMinC = array_keys(($rangkingC), min($rangkingC));
                            $dataMinC = min($rangkingC);

                            //indeks minimal yang didapat diatas digunakan untuk mencari nomor butirnya
                            $finalA[0] = $butirA[$idMinA[0]];
                            $finalB[0] = $butirB[$idMinB[0]];
                            $finalC[0] = $butirC[$idMinC[0]];

                            $finalA[1] = $dataMinA;
                            $finalB[1] = $dataMinB;
                            $finalC[1] = $dataMinC;
                          ?>

                          <h3 style="margin-left: 20px">Decision</h3>

                        <form method="post" data-toggle="validator" action="/form/{{$form -> id}}/decision" id="theForm">
                          {{ csrf_field() }} {{ method_field('POST') }}
                          <div class="row" style="padding: 0px 30px 10px 30px">
                            <div class="col-md-6">
                              <label for="butirA">Priority Indicator on Parahyangan Aspect</label>
                              <input type="text" name="butirA" value="{{$indicatorA[$idMinA[0]]}}" class="form-control" id="" required placeholder="" readonly>
                              <br>
                              <label for="butirB">Priority Indicator on Pawongan Aspect</label>
                              <input type="text" name="butirB" value="{{$indicatorB[$idMinB[0]]}}" class="form-control" id="butirB" required placeholder="" readonly>
                                <br>
                              <label for="butirC">Priority Indicator on Palemahan Aspect</label>
                              <input type="text" name="butirC" value="{{$indicatorC[$idMinC[0]]}}" class="form-control" id="butirC" required placeholder="" readonly>
                            </div>

                            <div class="col-md-6">
                              <label for="valueA">Value</label>
                              <input type="text" name="valueA" value="{{$finalA[1]}}" class="form-control" id="valueA" required placeholder="" readonly>
                                <br>
                              <label for="valueB">Value</label>
                              <input type="text" name="valueB" value="{{$finalB[1]}}" class="form-control" id="valueB" required placeholder="" readonly>
                                <br>
                              <label for="valueC">Value</label>
                              <input type="text" name="valueC" value="{{$finalC[1]}}" class="form-control" id="valueC" required placeholder="" readonly>
                            </div>
                          </div>


                          <!-- <button style="margin: 10px 30px 10px 30px" type="submit" class="btn btn-info btn-fill" id="simpan">Make Decision</button> -->
                        </form>




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


      $('#thkA').DataTable({
          order: [[ 5, 'asc' ]],
      });
      $('#thkB').DataTable({
          order: [[ 5, 'asc' ]],
      });
      $('#thkC').DataTable({
          order: [[ 5, 'asc' ]],
      });


    });










    </script>

@endsection
