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
        <form enctype="multipart/form-data" method="post" data-toggle="validator" action="/user/pic/{{ Auth::user()->id }}" id="theForm">
          {{ csrf_field() }} {{ method_field('POST') }}
        <input type="hidden" name="id" id="id" value="" method="patch">
        <div class="form-group">
          <label for="nama">Gambar</label>
          <input type="file" name="gambar" class="form-control">
        </div>

        <button type="submit" class="btn btn-info btn-fill">Simpan Profil</button>
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
                  <h3>Kelola Profil User</h3>

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

                    <p></p>
                    <br>
                    <div class="row">
                    <div class="col-md-3">
                    <?php
                    if($users -> photo == null){
                    $url = 'user.png';
                    } else {
                      $url = $users -> photo;
                    }
                    ?>



                  <div class="container" >
                    <div class="image company-header-avatar" style="background-image: url({!! asset('images/' . $url) !!})"></div>
                    <!-- <img src="{!! asset('images/' . $url) !!}" alt="Avatar" class="image profile-pic" width="100%"> -->
                    <div class="middle">
                      <a id="change-pic" onclick="addForm()" class="btn btn-info btn-fill">Ubah Gambar</a>
                    </div>
                  </div>


                    <!-- <div id="change-pic">
                    <form action="profile/pic/{{ $users -> id }}" enctype="multipart/form-data" method="POST">
                      <div class="print-img" style="display:none">
                        <img src="" style="height:300px;width:500px">
                      </div>
                      {{ csrf_field() }}
                      <input type="hidden" name="_method" value="PUT">
                    	<div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                      </div>
                    <input type="file" name="gambar" class="form-control">
                    <div class="form-group">
                        <button style="width: 100%; margin-top:5px;" class="btn btn-success upload-image" type="submit">Ubah Gambar</button>
                      </div>
                    </form>
                    </div> -->
                  </div>
                  <div class="col-md-9">
                    <form action="{{ URL('user/edit/'. $users -> id )}}" method="POST">
                      {{ csrf_field() }}
                      <input type="hidden" name="_method" value="PUT">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input disabled name="email" id-login="{{ Auth::user()->id }}" data-id="{{ $users -> id }}" id="email" type="text" value="{{ $users -> email }}" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input id="name" name="name" type="text" value="{{ $users -> name }}" class="form-control" >
                                </div>
                            </div>
                        </div>

                        <button style="display : none" id="btn-edit" type="submit" class="btn btn-info btn-fill pull-right">Edit Profile</button>
                        <div class="clearfix"></div>
                    </form>
                  </div>
                </div>



                </div>
            </div>

    </div>


    <script type="text/javascript">
    // var table;
    // $(document).ready(function() {
    //   table = $('#staf-table').DataTable({
    //     processing: true,
    //     serverSide: true,
    //     ajax: "{{ route('api.kelolaIkm') }}",
    //     columns: [
    //       {data: 'id', name: 'id'},
    //       {data: 'nama_usaha', name: 'nama_usaha'},
    //       {data: 'merk_produk', name: 'merk_produk'},
    //       {data: 'alamat', name: 'alamat'},
    //       {data: 'jenis_produk', name: 'jenis_produk'},
    //       {data: 'telpon', name: 'telpon'},
    //       {data: 'status', name: 'status'},
    //       {data: 'action', name: 'action', orderable: false, searchable: false}
    //     ]
    //   });
    //
    // });
    //
    // function deleteData(id){
    //   var popup = confirm("Apakah anda yakin ingin menghapus data ini?");
    //   var csrf_token = $('meta[name="crsf_token"]').attr('content');
    //   if(popup == true){
    //     $.ajax({
    //       headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //       },
    //       url : "{{ url('profil') }}" + '/' + id,
    //       type: "POST",
    //       data: {'_method': 'DELETE', '_token': csrf_token},
    //       success: function(data) {
    //         table.ajax.reload();
    //         console.log(data);
    //         alert("Data berhasil di hapus");
    //       },
    //       error: function(){
    //         alert("Gagal Menghapus! Terjadi kesalahan");
    //       }
    //     });
    //   }
    // }
    //
    // function store() {
    //
    // }
    //
    //
    // function editData(id) {
    //   save_method = 'edit';
    //   $('input[name=_method]').val('PATCH');
    //   urlAction = "{{ url('profil') }}";
    //   $('#modal-title').text('Edit Profil IKM');
    //   console.log(id);
    //   // $('#modal-form')[0].reset();
    //   console.log(urlAction);
    //   $.ajax({
    //     url: "{{ url('profil') }}/" + id + "/edit",
    //     type: "GET",
    //     dataType: "JSON",
    //     success: function(data) {
    //
    //       $('#modal-form').modal('show');
    //
    //
    //       // edit action pada form menjadi format URL patch di web.php
    //       $("#modal-form").find("form").attr("action", urlAction + '/' + id);
    //
    //       $('#id').val(data.id);
    //       $('#nama').val(data.nama_usaha);
    //       $('#lamaBerdiri').val(data.lama_berdiri);
    //       $('#merk').val(data.merk_produk);
    //       $('#alamat').val(data.alamat);
    //       $('#telepon').val(data.telpon);
    //       $('#jenisProduk').val(data.jenis_produk);
    //       $('#rerataProduksi').val(data.rerata_produksi);
    //       $('#rerataHarga').val(data.rerata_harga);
    //       $('#rerataPenjualan').val(data.rerata_penjualan);
    //       $('#tempatPemasaran').val(data.tempat_pemasaran);
    //       $('#totalPeralatan').val(data.total_peralatan);
    //       $('#totalBahanBaku').val(data.total_bahan_baku);
    //       $('#totalPekerja').val(data.total_pekerja);
    //       $('#jenisBimtek').val(data.jenis_bimtek);
    //       $('#permasalahan').val(data.permasalahan);
    //       $('#jarak').val(data.jarak);
    //
    //     },
    //     error: function() {
    //       alert("Tidak ada data");
    //     },
    //   });
    // }

    // $(function(){
    //   $('#modal-form form').validator().on('submit', function (e) {
    //     e.preventDefault();
    //     var data = $('form').serialize();
    //     console.log("Submit dipencet");
    //     var form_action = $("#modal-form").find("form").attr("action");
    //     var nama = $("#modal-form").find("input[name='nama']").val();
    //     var csrf_token = $('meta[name="crsf_token"]').attr('content');
    //     console.log(nama);
    //     console.log(form_action);
    //     $.ajax({
    //       headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //       },
    //       url: form_action,
    //       type: "POST",
    //       dataType: "JSON",
    //       data: data,
    //       success: function(data) {
    //         table.ajax.reload();
    //         $(".modal").modal('hide');
    //         alert("Berhasil");
    //       },
    //       error: function() {
    //         alert("Tidak ada data -" + nama + " - " + form_action);
    //       },
    //     });
    //   });
    // });

    function addForm() {
      save_method = "add";
      $('input[name=_method]').val('PUT');
      $('#modal-form').modal('show');
      $('#theForm')[0].reset();
      $('.modal-title').text('Ubah Foto Profil');
      console.log('Tampilkan Form ADD');
      // $("#modal-form").find("form").attr("action", "{{ url('/user/pic/{id}') }}");
    }


    var idUser = $('#email').attr('data-id');
    var idUserLogin = $('#email').attr('id-login');
    console.log(idUserLogin);
    //user yang login dapat mengedit profile
    //tapi tidak profile orang lain
    if(idUser == idUserLogin){
      $('#btn-edit').show();
      console.log('HIDE BROOO');
      $('#email').prop('disabled', 'true');
    } else {
      $('#email').prop('disabled', 'true');
      $('#email').prop('disabled', 'true');
      $('#name').prop('disabled', 'true');
      $('#change-pic').hide();
    }




    </script>

@endsection
