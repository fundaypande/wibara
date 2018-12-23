@extends('layouts.admin')

@section('content')

<div id="modal-form" class="modal fade" role="dialog" tabindex="1" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Status Validasi</h4>
      </div>
      <div class="modal-body">
        <form method="post" data-toggle="validator">
          {{ csrf_field() }} {{ method_field('POST') }}
        <input type="hidden" name="id" id="id" value="">
        <div class="form-group">
          <label for="namaUsaha">Nama Usaha:</label>
          <input type="namaUsaha" class="form-control" id="namaUsaha" disabled>
        </div>
        <div class="form-group">
          <label for="role">Status</label>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="radio" id="radioAdmin" value="1">
            <label class="form-check-label" for="exampleRadios1">
              Validasi
            </label>
          </div>
        </div>
        <br>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- end modal content -->

    <div class="row justify-content-center">

            <div style="padding-left: 20px; padding-right: 20px" class="card">
                <div class="card-header">
                  <h3>Validasi Profil IKM</h3>

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

                    <p>Daftar staf yang dapat mengakses sistem</p>
                    <br>

                    <!-- table show daftar user yang dapat mengakses sistem -->
                    <div class="row">
                      <div class="com-md-12">
                        <div class="panel panel-default">

                          <div class="panel-heading">
                            <h5>Daftar Profil IKM Yang Belum Tervalidasi
                              <!-- <a href="/add-staf" class="btn btn-primary pull-right">Tambah Pengguna</a> -->
                            </h4>
                          </div>

                          <div class="panel-body" style="overflow-x:auto;">
                            <table id="staf-table" width="100%" class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th width="50">ID</th>
                                  <th>Nama Usaha</th>
                                  <th>Merk Produk</th>
                                  <th>Alamat</th>
                                  <th>Jenis Produk</th>
                                  <th>Telepon</th>
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
        ajax: "{{ route('api.valid') }}",
        columns: [
          {data: 'id', name: 'id'},
          {data: 'nama_usaha', name: 'nama_usaha'},
          {data: 'merk_produk', name: 'merk_produk'},
          {data: 'alamat', name: 'alamat'},
          {data: 'jenis_produk', name: 'jenis_produk'},
          {data: 'telpon', name: 'telpon'},
          {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
      });

    });

    // function deleteData(id){
    //   var popup = confirm("Apakah anda yakin ingin menghapus data ini?");
    //   var csrf_token = $('meta[name="crsf_token"]').attr('content');
    //   if(popup == true){
    //     $.ajax({
    //       headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //       },
    //       url : "{{ url('kelola-staf') }}" + '/' + id,
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

    function editData(id) {
      save_method = 'edit';
      $('input[name=_method]').val('PATCH');
      urlAction = "{{ url('validasi') }}";
      // $('#modal-form')[0].reset();
      $.ajax({
        url: "{{ url('validasi') }}/" + id + "/edit",
        type: "GET",
        dataType: "JSON",
        success: function(data) {

          $('#modal-form').modal('show');
          $('#modal-title').modal('Edit Role');

          // edit action pada form menjadi format URL patch di web.php
          $("#modal-form").find("form").attr("action", urlAction + '/' + id);

          $('#id').val(data.id);
          $('#namaUsaha').val(data.nama_usaha);
          if(data.status == 0) $('#radioAdmin').prop('checked', false);

        },
        error: function() {
          alert("Tidak ada data");
        },
      });
    }


    //melakukan pengeditan data setelah submit ditekan
    $(function(){
      $('#modal-form form').validator().on('submit', function (e) {
        e.preventDefault();
        var data = $('form').serialize();
        console.log("Submit dipencet");
        var form_action = $("#modal-form").find("form").attr("action");
        var status = $("#modal-form").find("input[name='radio']").val();
        var csrf_token = $('meta[name="crsf_token"]').attr('content');
        console.log(status);
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: form_action,
          type: "PATCH",
          dataType: "JSON",
          data: data,
          success: function(data) {
            table.ajax.reload();
            $(".modal").modal('hide');
            alert("Berhasil Edit Data");
          },
          error: function() {
            alert("Tidak ada data -" + status + " - " + form_action);
          },
        });
      });
    });







    </script>

@endsection
