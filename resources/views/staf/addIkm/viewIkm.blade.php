@extends('layouts.admin')

@section('content')

<div id="modal-form" class="modal fade" role="dialog" tabindex="1" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Data</h4>
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
          <label for="name">Nama Pemilik IKM:</label>
          <input type="name" class="form-control" id="name" name="name">
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
                  <h3>Kelola IKM</h3>

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

                    <p>Daftar ikm yang dapat mengakses sistem untuk melakukan evaluasi</p>
                    <br>

                    <!-- table show daftar user yang dapat mengakses sistem -->
                    <div class="row">
                      <div class="com-md-12">
                        <div class="panel panel-default">

                          <div class="panel-heading">
                            <h4>Daftar IKM
                              <a href="/add-ikm" class="btn btn-primary pull-right"> Tambah Pengguna IKM</a>
                            </h4>
                          </div>

                          <div class="panel-body" style="overflow-x:auto;">
                            <table id="staf-table" width="100%" class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th width="50">ID</th>
                                  <th>Nama</th>
                                  <th>Email</th>
                                  <th>Data IKM</th>
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
        order: [[ 0, 'desc' ]],
        processing: true,
        serverSide: true,
        ajax: "{{ route('api.ikm') }}",
        columns: [
          {data: 'id', name: 'id'},
          {data: 'name', name: 'name'},
          {data: 'email', name: 'email'},
          {data: 'ikm', name: 'ikm', orderable: false, searchable: false,
            render: function( data, type, row ) {
                      return '<a href="{{ url('profilikm') }}/'+ data +'" class="btn btn-info btn-xs"><i class="fa fa-eye"></i>Profil</a> <a href="{{ url('produksi') }}/'+ data +'" class="btn btn-info btn-xs"><i class="fa fa-eye"></i>Kriteria</a> <a href="{{ url('produksi') }}/'+ data +'" class="btn btn-info btn-xs"><i class="fa fa-eye"></i>Produksi</a> <a href="{{ url('bahan') }}/'+ data +'" class="btn btn-info btn-xs"><i class="fa fa-eye"></i>Bahan Baku</a> <a href="{{ url('peralatan') }}/'+ data +'" class="btn btn-info btn-xs"><i class="fa fa-eye"></i>Peralatan</a>';
                  }
          },
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
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "{{ url('kelola-ikm') }}" + '/' + id,
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
      urlAction = "{{ url('kelola-ikm') }}";
      // $('#modal-form')[0].reset();
      $.ajax({
        url: "{{ url('kelola-ikm') }}/" + id + "/edit",
        type: "GET",
        dataType: "JSON",
        success: function(data) {

          $('#modal-form').modal('show');
          $('#modal-title').modal('Edit Role');

          // edit action pada form menjadi format URL patch di web.php
          $("#modal-form").find("form").attr("action", urlAction + '/' + id);

          $('#id').val(data.id);
          $('#email').val(data.email);
          $('#name').val(data.name);

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

        var csrf_token = $('meta[name="crsf_token"]').attr('content');
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
            Swal({
              position: 'top-end',
              type: 'success',
              title: 'Data berhasil diedit',
              showConfirmButton: false,
              timer: 1500
            });
          },
          error: function() {
            alert("Tidak ada data - - " + form_action);
          },
        });
      });
    });







    </script>

@endsection
