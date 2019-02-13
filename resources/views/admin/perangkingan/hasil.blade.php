@extends('layouts.admin')

@section('content')


<div id="modal-form" class="modal fade" role="dialog" tabindex="1" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modal-title">Apakah anda yakin ingin memilih IKM ini?</h4>
      </div>
      <div class="modal-body">
        <form method="post" data-toggle="validator" action="{{ url('/perangkingan/pilih') }}" id="theForm">
          {{ csrf_field() }} {{ method_field('POST') }}
        <div class="form-group">
          <input type="hidden" name="tahun" value="{{ $tahun }}" class="form-control" id="tahun" required placeholder="">
          <input type="hidden" name="user_id" value="" class="form-control" id="iduser" required placeholder="">
          <input type="hidden" name="komoditi_id" value="" class="form-control" id="idkomoditi" required placeholder="">
        </div>


        <button type="submit" class="btn btn-info btn-fill" id="simpan">Ya, Simpan Data</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
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

                        // dd($data);
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
                          } else if($kriteria[$i] -> keterangan == 'cost'){
                            $arrayMaxMin[$i] = $arrayMin[$i];
                          }
                        }

                        // dd($arrayMin);

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


                      $matrikNormBenefitCost = roundArray($matrikNormBenefitCost);

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
                                // $bobotAlternatif[$i][$j] = $matrikNormBenefitCost[$j][$i];
                            }

                            //menampilkan nilai bobot
                            print('</tr>');
                        }

                       ?>

                     </table>


                     <h3>Hasil Perangkingan IKM</h3>
                     <!-- tampilkan bobobt -->
                     <?php


                      $bobot = null;
                      for ($i=0; $i < $jumlahKriteria ; $i++) {
                        $bobotKriteria[$i][0] = $kriteria[$i] -> bobot;
                        // echo $bobotKriteria[$i][0];
                        // echo "<br />";
                      }
                      // dd($matrikNormBenefitCost);
                      $hasilPerangkingan = multiply($matrikNormBenefitCost, $bobotKriteria);

                      // $hasilPerangkingan = multiply($array, $array);
                      // dd($hasilPerangkingan);
                      ?>


                      <table id="hasil" width="100%" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>Nama IKM</th>
                          <th>Rangking</th>
                          <th>Acton</th>
                        </tr>

                      </thead>


                      <?php
                      //menampilkan matrik data alternative dalam tabel
                      $s = 0;
                      $j = 0;
                      $jumlahPenerima = $penerima->count();


                        // dd($penerima[0] -> user_id);

                        for($i=0;$i<$jumlahIkm;$i++) {
                            print('<tr>');

                            if($ikm[$s]->status == '0'){
                              $ikmStatus = 'Pilih';
                            } else {
                              $ikmStatus = 'Terpilih';
                            }

                            ?>
                            <th> <?php echo $ikm[$s]->name; ?> </th>

                            <?php
                            print("<td>{$hasilPerangkingan[$i][0]}</td>");
                                // $bobotAlternatif[$i][$j] = $matrikNormBenefitCost[$j][$i];


                            //menampilkan id dari IKM


                              print("<td> <a onclick='modal($ikm[$s])' class='btn btn-primary'>$ikmStatus</a>   </td>");
                              print("</tr>");


                            $s++;
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

    var table;

    $(document).ready(function() {

        table = $('#hasil').DataTable({
          order: [[ 1, 'desc' ]],
        });




    } );

    function modal(id) {
      $('#modal-form').modal('show');
      $('#iduser').val(id.user_id);
      $('#idkomoditi').val(id.komoditi_id);
      console.log(id.user_id);
    }


    $(function(){
      $('#modal-form form').validator().on('submit', function (e) {
        e.preventDefault();
        var data = $('form').serialize();
        console.log("Submit dipencet");
        var form_action = $("#modal-form").find("form").attr("action");
        var csrf_token = $('meta[name="crsf_token"]').attr('content');
        console.log(form_action);
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: form_action,
          type: "POST",
          dataType: "JSON",
          data: data,
          success: function(data) {
            // table.ajax.reload();
            $(".modal").modal('hide');
            Swal({
              position: 'top-end',
              type: 'success',
              title: 'Selamat data berhasi disimpan',
              showConfirmButton: false,
              timer: 1500
            });
            location.reload();
          },
          error: function(jqXhr, json, errorThrown){// this are default for ajax errors
            var errors = jqXhr.responseJSON;
            var errorsHtml = '';
            $.each(errors['errors'], function (index, value) {
                errorsHtml += '<ul class="list-group"><li class="list-group-item alert alert-danger">' + value + '</li></ul>';
            });
            //I use SweetAlert2 for this
            swal({
                title: "Error " + jqXhr.status + ': ' + errorThrown,// this will output "Error 422: Unprocessable Entity"
                html: errorsHtml,
                width: 'auto',
                confirmButtonText: 'Try again',
                cancelButtonText: 'Cancel',
                confirmButtonClass: 'btn',
                cancelButtonClass: 'cancel-class',
                showCancelButton: true,
                closeOnConfirm: true,
                closeOnCancel: true,
                type: 'error'
            }, function(isConfirm) {
                if (isConfirm) {
                     $('#openModal').click();//this is when the form is in a modal
                }
            });

          } //error close
        });
      });
    });





    </script>

@endsection
