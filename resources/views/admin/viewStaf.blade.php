@extends('layouts.admin')

@section('content')

<div id="modal-form" class="modal fade" role="dialog" tabindex="1" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Role</h4>
      </div>
      <div class="modal-body">
        <form method="post" data-toggle="validator">
          {{ csrf_field() }} {{ method_field('POST') }}
        <input type="hidden" name="id" id="id" value="">
        <div class="form-group">
          <label for="email">Email address:</label>
          <input type="email" class="form-control" id="email" disabled>
        </div>
        <div class="form-group">
          <label for="role">Role</label>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="radio" id="radioAdmin" value="3">
            <label class="form-check-label" for="exampleRadios1">
              Admin
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="radio" id="radioStaf" value="2">
            <label class="form-check-label" for="exampleRadios2">
              Staf
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
                  <h3>Kelola Staf</h3>

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
                            <h4>Daftar Pengguna
                              <a href="/add-staf" class="btn btn-primary pull-right"> Tambah Pengguna </a>
                            </h4>
                          </div>

                          <div class="panel-body">
                            <table id="staf-table" width="100%" class="mdl-data-table">
                              <thead>
                                <tr>
                                  <th width="50">ID</th>
                                  <th>Nama</th>
                                  <th>Email</th>
                                  <th>Role</th>
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
        ajax: "{{ route('api.staf') }}",
        columns: [
          {data: 'id', name: 'id'},
          {data: 'name', name: 'name'},
          {data: 'email', name: 'email'},
          {data: 'role', name: 'role'},
          {data: 'action', name: 'action', orderable: false, searchable: false}
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
          url : "{{ url('kelola-staf') }}" + '/' + id,
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

    function editData(id) {
      save_method = 'edit';
      $('input[name=_method]').val('PATCH');
      urlAction = "{{ url('kelola-staf') }}";
      // $('#modal-form')[0].reset();
      $.ajax({
        url: "{{ url('kelola-staf') }}/" + id + "/edit",
        type: "GET",
        dataType: "JSON",
        success: function(data) {

          $('#modal-form').modal('show');
          $('#modal-title').modal('Edit Role');

          // edit action pada form menjadi format URL patch di web.php
          $("#modal-form").find("form").attr("action", urlAction + '/' + id);

          $('#id').val(data.id);
          $('#email').val(data.email);
          if(data.role == 3) $('#radioAdmin').prop('checked', true); else $('#radioStaf').prop('checked', true);

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
        var role = $("#modal-form").find("input[name='radio']").val();
        var csrf_token = $('meta[name="crsf_token"]').attr('content');
        console.log(role);
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
            alert("Tidak ada data -" + role + " - " + form_action);
          },
        });
      });
    });







    </script>

@endsection
