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
        <form method="post" data-toggle="validator" action="" id="theForm" enctype="multipart/form-data">
          {{ csrf_field() }} {{ method_field('POST') }}
        <input type="hidden" name="id" id="id" value="" method="patch">

        <center>
          <div class="container" id="divGambar">
            <img id="gambarProduk" src="" alt="Gambar Produk" style="height:400px">
          </div>
        </center>

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
          <div id="par" style="background-color: #eee; border-radius: 3px; padding: 5px">

          </div>
        </div>

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

                  @if($idUser)
                    <p>Kelola Produksi IKM User Milik {{ $idUser -> name }}</p>
                    <input type="hidden" name="idUser" id="idUser" value="{{ $idUser -> id }}">
                    <input type="hidden" name="roleUser" id="roleUser" value="{{ Auth::user() -> role }}">
                  @endif
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
                              <a href="{{ url('/add-produksi/').'/'.$idUser -> id }}" style="color:white" class="btn btn-primary pull-right">Tambah Produksi </a>
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
                                  <th>Tahun</th>
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
      var idUser = $( "#idUser" ).val();
      var roleUser = $( "#roleUser" ).val();

      //** jika url slash nya kosong maka kosong
      if(!idUser){
        urlUser = "{{ url('api/produksi') }}";
      } else {
        //jika role IKM tidak boleh mengakses ini:
        if(roleUser == '1'){
          urlUser = "{{ url('api/produksi') }}";
          alert('Maaf anda tidak boleh mengakses profil IKM orang lain');
        } else {
          urlUser = "{{ url('api/produksi') }}" + '/' + idUser
        }

      }
      table = $('#staf-table').DataTable({
        order: [[ 0, 'desc' ]],
        processing: true,
        serverSide: true,
        ajax: urlUser,
        columns: [
          {data: 'id', name: 'id'},
          {data: 'jenis_produksi', name: 'jenis_produksi'},
          {data: 'jumlah', name: 'jumlah'},
          {data: 'harga', name: 'harga'},
          {data: 'nilai_penjualan', name: 'nilai_penjualan'},
          {data: 'tujuan', name: 'tujuan'},
          {data: 'ket', name: 'deskripsi'},
          {data: 'tahun', name: 'tahun'},
          {data: 'photos', name: 'photos', orderable: false, searchable: false,
            render: function( data, type, full, meta ) {
                      return '<img src="' + data + '" height="50px" style="height: 50px;"/>';
                  }
          },
          {data: 'action', name: 'action', orderable: false, searchable: false},
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
            url : "{{ url('produksi') }}" + '/' + id,
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

    function store() {

    }


    function showData(id){
      save_method = 'edit';
      $('input[name=_method]').val('PATCH');
      urlAction = "{{ url('produksi') }}";
      $('#modal-title').text('Edit Profil IKM');
      console.log(id);
      // $('#modal-form')[0].reset();
      console.log(urlAction);
      $.ajax({
        url: "{{ url('produksi') }}/" + id + "/show",
        type: "GET",
        dataType: "JSON",
        success: function(data) {

          $('#modal-form').modal('show');


          // edit action pada form menjadi format URL patch di web.php
          $("#modal-form").find("form").attr("action", urlAction + '/' + id);

          $('#id').val(data.id);
          $('#jenis_produksi').val(data.jenis_produksi);
          $('#jumlah').val(data.jumlah);
          $('#merk_produk').val(data.merk_produk);
          $('#harga').val(data.harga);
          $('#nilai_penjualan').val(data.nilai_penjualan);
          $('#tujuan').val(data.tujuan);
          $('#deskripsi').hide();

          $('#gambarProduk').attr("src","images/produksi/" + data.photo);

          console.log('/images/produksi/'+ data.photo);

          data = data.deskripsi;

          $("#theForm input").prop("disabled", true);
          $("#theForm textarea").prop("disabled", true);
          $("#simpan").hide();
          $("#par").text(data);

        },
        error: function() {
          alert("Tidak ada data");
        },
      });
    }







    </script>

@endsection
