@extends('layouts.admin')

@section('content')

<div id="modal-form" class="modal fade" role="dialog" tabindex="1" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modal-title">Tambah Bahan Baku IKM</h4>
      </div>
      <div class="modal-body">

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
                  <h3>Kelola Data Profil IKM {{ $user -> name }}</h3>
                  <input type="hidden" name="idUser" id="idUser" value="{{ $user -> id }}">

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

                    <p>Data Profil IKM</p>
                    <br>

                    <!-- table show daftar user yang dapat mengakses sistem -->
                    <div class="row">
                      <div class="com-md-12">
                        <div class="panel panel-default">

                          <div class="panel-heading">
                            <h5>Informasi Data Profil IKM

                            </h5>
                          </div>

                          <div class="panel-body" style="overflow-x:auto;">


                            <!-- Start Form -->
                            @foreach($profil as $prof)


                            <form method="post" data-toggle="validator" action="/profil/store" id="theForm">
                              {{ csrf_field() }} {{ method_field('POST') }}
                            <input type="hidden" name="id" id="id" value="" method="patch">


                            <div class="form-group">
                              <label for="nama_usaha">Nama Usaha</label>
                              <input type="text" name="nama_usaha" value="{{ $prof -> nama_usaha }}" class="form-control" id="nama_usaha" required placeholder="">
                            </div>
                            <div class="form-group">
                              <label for="badan_hukum">Badan Hukum</label>
                              <input min="1" type="text" name="badan_hukum" value="{{ $prof -> badan_hukum }}" class="form-control" id="badan_hukum" required placeholder="">
                            </div>
                            <div class="form-group">
                              <label for="izin_usaha">Izin Usaha</label>
                              <input type="text" name="izin_usaha" value="{{ $prof -> izin_usaha }}" class="form-control" id="izin_usaha" placeholder="" required>
                            </div>
                            <div class="form-group">
                              <label for="merk_produk">Merk Produk</label>
                              <input type="text" name="merk_produk" value="{{ $prof -> merk_produk }}" class="form-control" id="merk_produk" placeholder="" required>
                            </div>
                            <div class="form-group">
                              <label for="alamat">Alamat</label>
                              <textarea name="alamat" class="form-control" id="alamat" rows="2" required>{{ $prof -> alamat }}</textarea>
                            </div>
                            <div class="form-group">
                              <label for="telpon">Telepon</label>
                              <input type="tel" pattern="^\d{12}$" name="telpon" value="{{ $prof -> telpon }}" class="form-control" id="telpon" placeholder="" required>
                            </div>
                            <div class="form-group">
                              <label for="jenis_produk">Jenis Produk</label>
                              <input type="text" name="jenis_produk" value="{{ $prof -> jenis_produk }}" class="form-control" id="jenis_produk" placeholder="" required>
                            </div>

                            <div class="form-group">
                              <label for="tempat_pemasaran">Lokasi Pemasaran</label>
                              <input type="text" name="tempat_pemasaran" value="{{ $prof -> tempat_pemasaran }}" class="form-control" id="tempat_pemasaran" placeholder="" required>
                            </div>
                            <div class="form-group">
                              <label for="permasalahan">Permasalahan Pada Usaha Yang Dihadapi Saat Ini</label>
                              <textarea name="permasalahan" class="form-control" id="permasalahan" rows="2">{{ $prof -> permasalahan }}</textarea>
                            </div>
                            <div class="form-group">
                              <label for="jenis_bimtek">Jenis Bimtek Yang Diminati</label>
                              <input type="text" name="jenis_bimtek" value="{{ $prof -> jenis_bimtek }}" class="form-control" id="jenis_bimtek" placeholder="">
                            </div>

                            @endforeach


                            <button type="submit" class="btn btn-info btn-fill">Simpan Data</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </form>


                            <!-- END FORM -->

                          </div>


                        </div>
                      </div>
                    </div>


                </div>
            </div>

    </div>

    <script src="{{ asset('js/rupiah.js') }}"></script>
    <script type="text/javascript">
    var table;
    $(document).ready(function() {

      var idUser = $( "#idUser" ).val();

      justNum($('#jumlah'));
      justNum($('#harga'));


      table = $('#staf-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('/api/profilIkm') }}" + '/' + idUser,
        columns: [
          {data: 'id', name: 'id'},
          {data: 'nama_usaha', name: 'nama_usaha'},
          {data: 'badan_hukum', name: 'badan_hukum'},
          {data: 'izin_usaha', name: 'izin_usaha'},
          {data: 'merk_produk', name: 'merk_produk'},
          {data: 'alamat', name: 'alamat'},
          {data: 'telpon', name: 'telpon'},
          {data: 'jenis_produk', name: 'jenis_produk'},
          {data: 'tempat_pemasaran', name: 'tempat_pemasaran'},
          {data: 'permasalahan', name: 'permasalahan'},
          {data: 'jenis_bimtek', name: 'jenis_bimtek'},
          {data: 'tahun', name: 'tahun'},
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
            url : "{{ url('bahan') }}" + '/' + id,
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
