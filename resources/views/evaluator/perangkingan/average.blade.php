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
                  <h2>Description Matrix</h2>
                  <h3>C. Outcomes</h3>
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
                                  <th>Average</th>
                                </tr>
                              </thead>
                              <tbody>

                              </tbody>
                            </table>
                          </div>


                        </div>

                        <!-- <h3 style="margin-left: 20px">Out Comes</h3> -->

                        <?php
                          $thk = ['Parahyangan','Pawongan','Palemahan'];

                          ?>

                        <!-- menampilkan data minimal  -->
                        <div class="panel panel-default">
                          <h4 style="padding: 20px 0px 0px 20px;">Accountability</h4>
                          <div class="panel-body" style="overflow-x:auto;">
                            <table id="staf-table" width="100%" class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>ID ANEKA</th>
                                  <th>Tri Hita Karana Aspect</th>
                                  <!-- <th>ANEKA Indicators</th> -->
                                  <th>Min Values</th>

                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  for ($i=0; $i < 3; $i++) {
                                 ?>
                                 <tr>
                                   <td>{{ $arayMin[$i][0] }}</td>
                                   <td>{{ $thk[$i] }}</td>
                                   <!-- <td>{{ $butir[6] -> butir }}</td> -->
                                   <td>{{ $arayMin[$i][1] }}</td>
                                 </tr>

                                <?php } ?>
                              </tbody>
                            </table>
                          </div>


                        </div>

                        <!-- menampilkan data minimal  -->
                        <div class="panel panel-default">
                          <h4 style="padding: 20px 0px 0px 20px;">Nationalism</h4>
                          <div class="panel-body" style="overflow-x:auto;">
                            <table id="staf-table" width="100%" class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>ID ANEKA</th>
                                  <th>Tri Hita Karana Aspect</th>
                                  <!-- <th>ANEKA Indicators</th> -->
                                  <th>Min Values</th>

                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $j = 0;
                                  for ($i=3; $i < 6; $i++) {

                                 ?>
                                 <tr>
                                   <td>{{ $arayMin[$i][0] }}</td>
                                   <td>{{ $thk[$j] }}</td>
                                   <!-- <td>{{ $butir[6] -> butir }}</td> -->
                                   <td>{{ $arayMin[$i][1] }}</td>
                                 </tr>

                                <?php $j++; } ?>
                              </tbody>
                            </table>
                          </div>


                        </div>

                        <!-- menampilkan data minimal  -->
                        <div class="panel panel-default">
                          <h4 style="padding: 20px 0px 0px 20px;">Public Ethics</h4>
                          <div class="panel-body" style="overflow-x:auto;">
                            <table id="staf-table" width="100%" class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>ID ANEKA</th>
                                  <th>Tri Hita Karana Aspect</th>
                                  <!-- <th>ANEKA Indicators</th> -->
                                  <th>Min Values</th>

                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $j = 0;
                                  for ($i=6; $i < 9; $i++) {

                                 ?>
                                 <tr>
                                   <td>{{ $arayMin[$i][0] }}</td>
                                   <td>{{ $thk[$j] }}</td>
                                   <!-- <td>{{ $butir[6] -> butir }}</td> -->
                                   <td>{{ $arayMin[$i][1] }}</td>
                                 </tr>

                                <?php $j++; } ?>
                              </tbody>
                            </table>
                          </div>


                        </div>

                        <!-- menampilkan data minimal  -->
                        <div class="panel panel-default">
                          <h4 style="padding: 20px 0px 0px 20px;">Quality Commitment</h4>
                          <div class="panel-body" style="overflow-x:auto;">
                            <table id="staf-table" width="100%" class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>ID ANEKA</th>
                                  <th>Tri Hita Karana Aspect</th>
                                  <!-- <th>ANEKA Indicators</th> -->
                                  <th>Min Values</th>

                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $j = 0;
                                  for ($i=9; $i < 12; $i++) {

                                 ?>
                                 <tr>
                                   <td>{{ $arayMin[$i][0] }}</td>
                                   <td>{{ $thk[$j] }}</td>
                                   <!-- <td>{{ $butir[6] -> butir }}</td> -->
                                   <td>{{ $arayMin[$i][1] }}</td>
                                 </tr>

                                <?php $j++; } ?>
                              </tbody>
                            </table>
                          </div>


                        </div>

                        <!-- menampilkan data minimal  -->
                        <div class="panel panel-default">
                          <h4 style="padding: 20px 0px 0px 20px;">Anti-Corruption</h4>
                          <div class="panel-body" style="overflow-x:auto;">
                            <table id="staf-table" width="100%" class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th>ID ANEKA</th>
                                  <th>Tri Hita Karana Aspect</th>
                                  <!-- <th>ANEKA Indicators</th> -->
                                  <th>Min Values</th>

                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $j = 0;
                                  for ($i=12; $i < 15; $i++) {

                                 ?>
                                 <tr>
                                   <td>{{ $arayMin[$i][0] }}</td>
                                   <td>{{ $thk[$j] }}</td>
                                   <!-- <td>{{ $butir[6] -> butir }}</td> -->
                                   <td>{{ $arayMin[$i][1] }}</td>
                                 </tr>

                                <?php $j++; } ?>
                              </tbody>
                            </table>
                          </div>


                        </div>

                        <form method="post" data-toggle="validator" action="/form/{{$form -> id}}/update-outcome" id="theForm">
                          {{ csrf_field() }} {{ method_field('POST') }}
                          <?php for ($i=0; $i < count($arayMin); $i++) {
                          ?>

                          <input type="hidden" name="id{{$i}}" value="{{$arayMin[$i][0]}}">
                          <input type="hidden" name="min{{$i}}" value="{{$arayMin[$i][1]}}">


                          <?php }  ?>

                          <button type="submit" class="btn btn-info btn-fill" id="simpan">Next To Judgement Matrix</button>
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
        ajax: "/api/average/"+idForm,
        columns: [
          {data: 'id', name: 'id'},
          {data: 'thk', name: 'thk'},
          {data: 'aneka', name: 'aneka'},
          {data: 'aspek', name: 'aspek'},
          {data: 'butir', name: 'butir'},
          {data: 'average', name: 'average'},
        ]
      });


    });










    </script>

@endsection
