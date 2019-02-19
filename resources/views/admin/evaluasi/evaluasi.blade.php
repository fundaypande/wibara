@extends('layouts.admin')

@section('css')
  <link rel="stylesheet" href="{!! asset('css/highcharts.scss') !!}">
@endsection

@section('content')



    <div class="row justify-content-center">

            <div style="padding-left: 20px; padding-right: 20px" class="card">
                <div class="card-header">
                  <h3>Evaluasi Penerima Bantuan Dari {{ $user -> name }}</h3>
                  <input type="hidden" name="idUser" id="idUser" value="">

                </div>

                <div class="card-body">
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

                    <p>Evaluasi Pelaku IKM</p>
                    <br>

                    <!-- table show daftar user yang dapat mengakses sistem -->
                    <div class="row">
                      <div class="com-md-12">


                          <?php
                          // dd($series);
                            //menampilkan data kriteria
                            print('<div class="col-md-6">');
                            print('<h4> Sebelum Menerima Bantuan</h4>');
                            for ($i=0; $i < $dataKriteria->count() ; $i++) {
                            $read = 'text';




                              ?>
                              @if($dataKriteria[$i] -> nama == 'jarak' || $dataKriteria[$i] -> nama == 'Jarak'|| $dataKriteria[$i] -> nama == 'Lama Berdirinya Usaha (Tahun)')
                                <?php
                                  $read = 'hidden';
                                 ?>
                              @else
                                {{ $read = null }}
                              @endif
                                <div class="form-group">
                                  <label for="jenis_bahan">{{ $dataKriteria[$i] -> nama }}</label>
                                  <input type="{{ $read }}" name="jenis_bahan" value="{{ $dataKriteria[$i] -> nilai }}" class="form-control" id="jenis_bahan" readonly required placeholder="">
                                </div>


                              <?php


                            }
                            print('</div>');



                            print('<div class="col-md-6">');
                            print('<h4> Setelah Menerima Bantuan</h4>');
                            for ($i=0; $i < $dataEvaluasi->count() ; $i++) {
                              $read = 'text';


                              ?>

                              @if($dataKriteria[$i] -> nama == 'jarak' || $dataKriteria[$i] -> nama == 'Jarak' || $dataKriteria[$i] -> nama == 'Lama Berdirinya Usaha (Tahun)')
                                <?php
                                  $read = 'hidden';
                                 ?>
                              @else
                                {{ $read = null }}
                              @endif

                                <div class="form-group">
                                  <label for="jenis_bahan">{{ $dataEvaluasi[$i] -> nama }}</label>
                                  <input type="{{ $read }}" name="jenis_bahan" value="{{ $dataEvaluasi[$i] -> nilai }}" class="form-control" id="jenis_bahan" readonly required placeholder="">
                                </div>


                              <?php


                            }
                            print('</div>');


                           ?>



                      </div>

                      <div class="col-md-12">
                				<div class="panel panel-default">
                					<div class="panel-body">
                						<div id="grafik"></div>
                					</div>
                				</div>
                			</div>

                    </div>


                </div>
            </div>

    </div>

    <script src="{!! asset('js/highcharts.js') !!}"></script>

    <script type="text/javascript">



    $(function(){
			Highcharts.chart('grafik', {
			    chart: {
			        type: 'column'
			    },
			    title: {
			        text: 'Perbandingan Nilai Kriteria'
			    },
			    subtitle: {
			        text: 'Per Kriteria'
			    },
			    xAxis: {
			        categories: {!! json_encode($category) !!},
			        crosshair: true
			    },
			    yAxis: {
			        min: 0,
			        title: {
			            text: 'Jumlah'
			        }
			    },
			    tooltip: {
			        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
			        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
			            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
			        footerFormat: '</table>',
			        shared: true,
			        useHTML: true
			    },
			    plotOptions: {
			        column: {
			            pointPadding: 0.2,
			            borderWidth: 0
			        }
			    },
			    series: {!! json_encode($series) !!}
			});



		})




    var table;
    $(document).ready(function() {

      var idUser = $( "#idUser" ).val();

      justNum($('#jumlah'));
      justNum($('#harga'));


      table = $('#staf-table').DataTable({
        order: [[ 0, 'desc' ]],
        processing: true,
        serverSide: true,
        ajax: "{{ route('api.penerima') }}",
        columns: [
          {data: 'id', name: 'id'},
          {data: 'name', name: 'name'},
          {data: 'tahun', name: 'tahun'},
          {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
      });


    });

    function deleteData(id, userId){
      var csrf_token = $('meta[name="crsf_token"]').attr('content');
      Swal({
        title: 'Hapus Data?',
        text: "Apakah anda yakin ingin menghapus data ini",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "{{ url('penerima') }}" + '/' + id + '/' + userId,
            type: "POST",
            data: {'_method': 'DELETE', '_token': csrf_token},
            success: function(data) {
              table.ajax.reload();
              console.log(data);
              Swal({
                position: 'top-end',
                type: 'success',
                title: 'Data berhasil dihapus',
                showConfirmButton: false,
                timer: 1500
              })
            },
            error: function(){
              Swal({
                position: 'top-end',
                type: 'error',
                title: 'Data berhasil dihapus',
                showConfirmButton: false,
                timer: 1500
              })
            }
          });
        }
      });
    }


    function editData(id) {
      save_method = 'edit';
      $('input[name=_method]').val('PATCH');
      urlAction = "{{ url('bahan') }}";
      $('#modal-title').text('Edit Bahan Baku IKM');
      console.log(id);
      // $('#modal-form')[0].reset();
      console.log(urlAction);
      $.ajax({
        url: "{{ url('bahan') }}/" + id + "/edit",
        type: "GET",
        dataType: "JSON",
        success: function(data) {

          $('#modal-form').modal('show');


          // edit action pada form menjadi format URL patch di web.php
          $("#modal-form").find("form").attr("action", urlAction + '/' + id);

          $('#id').val(data.id);
          $('#jenis_bahan').val(data.jenis_bahan);
          $('#tahun').val(data.tahun);
          $('#satuan').val(data.satuan);
          $('#jumlah').val(data.jumlah);
          $('#harga').val(data.harga);
          $('#asal').val(data.asal);

          $("#tahun > [value=" + data.tahun + "]").attr("selected", "true");

        },
        error: function() {
          Swal({
            position: 'top-end',
            type: 'error',
            title: 'Terjadi kesalahan',
            showConfirmButton: false,
            timer: 1500
          })
        },
      });
    }

    $(function(){
      $('#modal-form form').validator().on('submit', function (e) {
        e.preventDefault();
        var data = $('form').serialize();
        console.log("Submit dipencet");
        var form_action = $("#modal-form").find("form").attr("action");
        var jenis_alat = $("#modal-form").find("input[name='jenis_alat']").val();
        var csrf_token = $('meta[name="crsf_token"]').attr('content');
        console.log(jenis_alat);
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
            table.ajax.reload();
            $(".modal").modal('hide');
            Swal({
              position: 'top-end',
              type: 'success',
              title: 'Selamat data berhasi disimpan',
              showConfirmButton: false,
              timer: 1500
            });
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

    function addForm(id) {
      save_method = "add";
      $('input[name=_method]').val('POST');
      $('#modal-form').modal('show');
      $('#theForm')[0].reset();
      $('.modal-title').text('Tambah Bahan Baku IKM');
      console.log('Tampilkan Form ADD');
      $("#modal-form").find("form").attr("action", "{{ url('bahan') }}/" + id);
    }







    </script>

@endsection
