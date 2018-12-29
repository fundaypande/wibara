@extends('layouts.admin')

@section('content')

<style type="text/css" scoped>
  .tdIkm{
    font-weight: 500;
    width: 20%;
  }
  .tableIkm{
    font-size: 16px;
    width: 100%;
  }
  .tableIkm tr{
    height: 60px;
  }
  .tableIkm td:first{
    font-weight: 400;
  }
</style>

<div id="modal-form" class="modal fade" role="dialog" tabindex="1" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modal-title">Tambah Peralatan IKM</h4>
      </div>
      <div class="modal-body">
        <form method="post" data-toggle="validator" action="/profil/store" id="theForm">
          {{ csrf_field() }} {{ method_field('POST') }}
        <input type="hidden" name="id" id="id" value="" method="patch">
        <div class="form-group">
          <label for="jenis_alat">Jenis Alat</label>
          <input type="text" name="jenis_alat" value="" class="form-control" id="jenis_alat" required placeholder="">
        </div>
        <div class="form-group">
          <label for="tahun">Tahun Produksi</label>
          <input min="1" type="text" name="tahun" value="" class="form-control" id="tahun"  placeholder="">
        </div>
        <div class="form-group">
          <label for="spesifikasi">Spesifikasi</label>
          <textarea name="spesifikasi" class="form-control" id="spesifikasi" rows="2" ></textarea>
          <div id="par" style="background-color: #eee; border-radius: 3px; padding: 5px">

          </div>
        </div>
        <div class="form-group">
          <label for="kapasitas">Kapasitas</label>
          <input type="text" name="kapasitas" value="" class="form-control" id="kapasitas" placeholder="" >
        </div>
        <div class="form-group">
          <label for="jumlah">Jumlah</label>
          <input type="text" name="jumlah" value="" class="form-control" id="jumlah" placeholder="" >
        </div>
        <div class="form-group">
          <label for="buatan">Buatan</label>
          <input type="text" name="buatan" value="" class="form-control" id="buatan" placeholder="" >
        </div>
        <div class="form-group">
          <label for="harga">Harga</label>
          <input type="text" name="harga" value="" class="form-control" id="harga" placeholder="" >
        </div>
        <div class="form-group">
          <label for="asal">Asal</label>
          <input type="text" name="asal" value="" class="form-control" id="asal" placeholder="" >
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
                  <h3>Profil IKM</h3>

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

                    <p>Daftar profil IKM</p>
                    <br>

                    <!-- table show daftar user yang dapat mengakses sistem -->

                      <?php
                      if($users -> user -> photo == null){
                        $url = 'user.png';
                      } else {
                        $url = $users -> user -> photo;
                      }
                      ?>


                    <div class="col-md-12">
                      <div class="col-md-3">
                        <center>
                        <div class="container" >
                          <div class="image company-header-avatar" style="background-image: url({!! asset('images/' . $url) !!}); width:200px; height:200px"></div>
                          <!-- <img src="{!! asset('images/' . $url) !!}" alt="Avatar" class="image profile-pic" width="100%"> -->
                        </div>

                        </center>
                        <br>
                        <table>
                          <tr>
                            <td style="width: 100px"><i>Nama Pemilik</i></td>
                            <td><i>{{ $users -> user -> name }}</i></td>
                          </tr>
                          <tr>
                            <td><i>Email</i></td>
                            <td><i>{{ $users -> user -> email }}</i></td>
                          </tr>
                        </table>
                      </div>
                      <div class="col-md-9">
                        <table class="tableIkm">

                          <tr>
                            <td class="tdIkm"><b>Nama Usaha</b></td>
                            <td>{{ $users -> nama_usaha  }}</td>
                          </tr>
                          <tr>
                            <td class="tdIkm"><b>Alamat</b></td>
                            <td>{{ $users -> alamat  }}</td>
                          </tr>
                          <tr>
                            <td class="tdIkm"><b>Merk Produk</b></td>
                            <td>{{ $users -> merk_produk  }}</td>
                          </tr>
                          <tr>
                            <td class="tdIkm"><b>Telepon</b></td>
                            <td>{{ $users -> telpon  }}</td>
                          </tr>
                          <tr>
                            <td class="tdIkm"><b>Jenis Produk Yang Dihasilkan</b></td>
                            <td>{{ $users -> jenis_produk  }}</td>
                          </tr>

                          <tr>
                            <td class="tdIkm"><b>Jumlah Produksi Rata-rata</b></td>
                            <td>{{ $users -> rerata_produksi  }}</td>
                          </tr>
                          <tr>
                            <td class="tdIkm"><b>Harga Rata-rata Produk</b></td>
                            <td>{{ $users -> rerata_harga  }}</td>
                          </tr>
                          <tr>
                            <td class="tdIkm"><b>Rata-rata Nilai Penjualan</b></td>
                            <td>{{ $users -> rerata_penjualan  }}</td>
                          </tr>
                          <tr>
                            <td class="tdIkm"><b>Tempat Pemasaran</b></td>
                            <td>{{ $users -> tempat_pemasaran  }}</td>
                          </tr>
                          <tr>
                            <td class="tdIkm"><b>Total Peralatan dan Mesin Yang Dimiliki</b></td>
                            <td>{{ $users -> total_peralatan  }}</td>
                          </tr>
                          <tr>
                            <td class="tdIkm"><b>Rata-rata Bahan Baku Yang Digunakan Pertahun</b></td>
                            <td>{{ $users -> total_bahan_baku  }}</td>
                          </tr>
                          <tr>
                            <td class="tdIkm"><b>Jumlah Tenaga Kerja</b></td>
                            <td>{{ $users -> total_pekerja  }}</td>
                          </tr>
                          <tr>
                            <td class="tdIkm"><b>Jarak Dari Dinas Ke Lokasi IKM</b></td>
                            <td>{{ $users -> jarak  }} KM</td>
                          </tr>
                          <tr>
                            <td class="tdIkm"><b>Permasalahan Pada Usaha Yang Dihadapi</b></td>
                            <td>{{ $users -> permasalahan  }}</td>
                          </tr>
                          <tr>
                            <td class="tdIkm"><b>Jenis Bimtek Yang Diminati</b></td>
                            <td>{{ $users -> jenis_bimtek  }}</td>
                          </tr>
                        </table>
                      </div>

                    </div>




                </div>
            </div>

    </div>


    <script type="text/javascript">
    var table;
    $(document).ready(function() {
      table = $('#staf-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('api.peralatan') }}",
        columns: [
          {data: 'id', name: 'id'},
          {data: 'jenis_alat', name: 'jenis_alat'},
          {data: 'tahun', name: 'tahun'},
          {data: 'ket', name: 'spesifikasi'},
          {data: 'kapasitas', name: 'kapasitas'},
          {data: 'jumlah', name: 'jumlah'},
          {data: 'buatan', name: 'buatan'},
          {data: 'harga', name: 'harga'},
          {data: 'asal', name: 'asal'},
          {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
      });


    });

    function deleteData(id){
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
            url : "{{ url('peralatan') }}" + '/' + id,
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
      urlAction = "{{ url('peralatan') }}";
      $('#modal-title').text('Edit Peralatan IKM');
      console.log(id);
      // $('#modal-form')[0].reset();
      console.log(urlAction);
      $.ajax({
        url: "{{ url('peralatan') }}/" + id + "/edit",
        type: "GET",
        dataType: "JSON",
        success: function(data) {

          $('#modal-form').modal('show');


          // edit action pada form menjadi format URL patch di web.php
          $("#modal-form").find("form").attr("action", urlAction + '/' + id);

          $('#id').val(data.id);
          $('#jenis_alat').val(data.jenis_alat);
          $('#tahun').val(data.tahun);
          $('#spesifikasi').val(data.spesifikasi);
          $('#kapasitas').val(data.kapasitas);
          $('#jumlah').val(data.jumlah);
          $('#buatan').val(data.buatan);
          $('#harga').val(data.harga);
          $('#asal').val(data.asal);

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

    function addForm() {
      save_method = "add";
      $('input[name=_method]').val('POST');
      $('#modal-form').modal('show');
      $('#theForm')[0].reset();
      $('.modal-title').text('Tambah Peralatan IKM');
      console.log('Tampilkan Form ADD');
      $("#modal-form").find("form").attr("action", "{{ route('ikm.addPeralatan') }}");
    }

    function showData(id) {
      save_method = 'edit';
      $('input[name=_method]').val('PATCH');
      urlAction = "{{ url('peralatan') }}";
      $('#modal-title').text('Peralatan IKM');
      console.log(id);
      // $('#modal-form')[0].reset();
      console.log(urlAction);
      $.ajax({
        url: "{{ url('peralatan') }}/" + id + "/edit",
        type: "GET",
        dataType: "JSON",
        success: function(data) {

          $('#modal-form').modal('show');


          // edit action pada form menjadi format URL patch di web.php
          $("#modal-form").find("form").attr("action", urlAction + '/' + id);

          $('#id').val(data.id);
          $('#jenis_alat').val(data.jenis_alat);
          $('#tahun').val(data.tahun);
          $('#spesifikasi').hide();
          $('#kapasitas').val(data.kapasitas);
          $('#jumlah').val(data.jumlah);
          $('#buatan').val(data.buatan);
          $('#harga').val(data.harga);
          $('#asal').val(data.asal);

          data = data.spesifikasi;

          $("#theForm input").prop("disabled", true);
          $("#theForm textarea").prop("disabled", true);
          $("#simpan").hide();
          $("#par").text(data);


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









    </script>

@endsection
