@extends('layouts.admin')

@section('content')

<div id="modal-form" class="modal fade" role="dialog" tabindex="1" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modal-title">Tambah Profil IKM</h4>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data" method="post" data-toggle="validator" action="" id="theForm">
          {{ csrf_field() }} {{ method_field('POST') }}
        <input type="hidden" name="id" id="id" value="" method="patch">
        <div class="form-group">
          <label for="jenis_produksi">Jenis Produksi</label>
          <input type="text" name="jenis_produksi" value="" class="form-control" id="jenis_produksi" required placeholder="">
        </div>
        <div class="form-group">
          <label for="jumlah">Jumlah</label>
          <input min="1" type="text" name="jumlah" value="" class="form-control" id="jumlah" required placeholder="">
        </div>
        <div class="form-group">
          <label for="harga">Harga</label>
          <input type="text" name="harga" value="" class="form-control" id="harga" placeholder="Rp." required>
        </div>
        <div class="form-group">
          <label for="nilai_penjualan">Nilai Penjualan</label>
          <input type="text" name="nilai_penjualan" value="" class="form-control" id="nilai_penjualan" placeholder="Rp." required>
        </div>

        <div class="form-group">
          <label for="tujuan">Tujuan Pemasaran</label>
          <input type="text" name="tujuan" value="" class="form-control" id="tujuan" placeholder="">
        </div>
        <div class="form-group">
          <label for="deskripsi">Deskripsi</label>
          <textarea name="deskripsi" class="form-control" id="deskripsi" rows="2"></textarea>
        </div>
        <div class="form-group">
          <label for="nama">Gambar</label>
          <input type="file" name="gambar" class="form-control">
        </div>

        <button type="submit" class="btn btn-info btn-fill">Simpan Produksi</button>
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
                  <h3>Kelola Produksi</h3>

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

                    <p>Pelaku IKM dapat menginputkan data-data hasil produksinya yang nantinya akan ditampilkan di halaman depan website ini sehingga membantu untuk mempromosikan
                    produk-produk yang dimiliki IKM</p>
                    <br>

                    <!-- table show daftar user yang dapat mengakses sistem -->
                    <div class="row">
                      <div class="com-md-12">
                        <div class="panel panel-default">

                          <div class="panel-heading">
                            <h5>Daftar Profil IKM
                              <a onclick="addForm()" style="color:white" class="btn btn-primary pull-right">Tambah Produksi </a>
                            </h5>
                          </div>

                          <div class="panel-body" style="overflow-x:auto;">
                            <table id="staf-table" width="100%" class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th width="50">ID</th>
                                  <th>Jenis Produksi</th>
                                  <th>Jumlah</th>
                                  <th>rerataHarga</th>
                                  <th>Nilai Penjualan</th>
                                  <th>Tujuan Pemasaran</th>
                                  <th>Deskripsi Produk</th>
                                  <th>Photo</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>

                              </tbody>
                            </table>
                          </div>


                        </div>
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
        ajax: "{{ route('api.produksi') }}",
        columns: [
          {data: 'id', name: 'id'},
          {data: 'jenis_produksi', name: 'jenis_produksi'},
          {data: 'jumlah', name: 'jumlah'},
          {data: 'harga', name: 'harga'},
          {data: 'nilai_penjualan', name: 'nilai_penjualan'},
          {data: 'tujuan', name: 'tujuan'},
          {data: 'deskripsi', name: 'deskripsi'},
          {data: 'photos', name: 'photos', orderable: false, searchable: false,
            render: function( data, type, full, meta ) {
                      return '<img src="' + data + '" height="50"/>';
                  }
          },
          {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
      });

    });

    function deleteData(id){
      var popup = confirm("Apakah anda yakin ingin menghapus data ini?");
      var csrf_token = $('meta[name="crsf_token"]').attr('content');
      if(popup == true){
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url : "{{ url('profil') }}" + '/' + id,
          type: "POST",
          data: {'_method': 'DELETE', '_token': csrf_token},
          success: function(data) {
            table.ajax.reload();
            console.log(data);
            alert("Data berhasil di hapus");
          },
          error: function(){
            alert("Gagal Menghapus! Terjadi kesalahan");
          }
        });
      }
    }

    function store() {

    }


    function editData(id) {
      save_method = 'edit';
      $('input[name=_method]').val('PATCH');
      urlAction = "{{ url('profil') }}";
      $('#modal-title').text('Edit Profil IKM');
      console.log(id);
      // $('#modal-form')[0].reset();
      console.log(urlAction);
      $.ajax({
        url: "{{ url('profil') }}/" + id + "/edit",
        type: "GET",
        dataType: "JSON",
        success: function(data) {

          $('#modal-form').modal('show');


          // edit action pada form menjadi format URL patch di web.php
          $("#modal-form").find("form").attr("action", urlAction + '/' + id);

          $('#id').val(data.id);
          $('#nama').val(data.nama_usaha);
          $('#lamaBerdiri').val(data.lama_berdiri);
          $('#merk').val(data.merk_produk);
          $('#alamat').val(data.alamat);
          $('#telepon').val(data.telpon);
          $('#jenisProduk').val(data.jenis_produk);
          $('#rerataProduksi').val(data.rerata_produksi);
          $('#rerataHarga').val(data.rerata_harga);
          $('#rerataPenjualan').val(data.rerata_penjualan);
          $('#tempatPemasaran').val(data.tempat_pemasaran);
          $('#totalPeralatan').val(data.total_peralatan);
          $('#totalBahanBaku').val(data.total_bahan_baku);
          $('#totalPekerja').val(data.total_pekerja);
          $('#jenisBimtek').val(data.jenis_bimtek);
          $('#permasalahan').val(data.permasalahan);
          $('#jarak').val(data.jarak);

        },
        error: function() {
          alert("Tidak ada data");
        },
      });
    }

    $(function(){
      $('#modal-form form').validator().on('submit', function (e) {
        e.preventDefault();
        var data = $('form').serialize();
        console.log("Submit dipencet");
        var form_action = $("#modal-form").find("form").attr("action");
        var nama = $("#modal-form").find("input[name='jenis_produksi']").val();
        console.log(nama);
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
            alert("Berhasil");
          },
          error: function(jqXhr, json, errorThrown){// this are default for ajax errors
          var errors = jqXhr.responseJSON;
          var errorsHtml = '';
          $.each(errors['errors'], function (index, value) {
              errorsHtml += '<ul class="list-group"><li class="list-group-item alert alert-danger">' + value + '</li></ul>';
              console.log(value);
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
      $('.modal-title').text('Tambah Produksi IKM');
      console.log('Tampilkan Form ADD');
      $("#modal-form").find("form").attr("action", "{{ route('ikm.addProduksi') }}");
    }







    </script>

@endsection
