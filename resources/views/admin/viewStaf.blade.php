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
            <input class="form-check-input" type="radio" name="radio" id="radioAdmin" value="0">
            <label class="form-check-label" for="exampleRadios1">
              Admin
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="radio" id="radioStaf" value="1">
            <label class="form-check-label" for="exampleRadios2">
              Evaluator
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
                  <h3>User Management</h3>

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

                    <p>List of Users Who Can Access The Sistem</p>
                    <br>

                    <!-- table show daftar user yang dapat mengakses sistem -->
                    <div class="row">
                      <div class="com-md-12">
                        <div class="panel panel-default">

                          <div class="panel-heading">
                            <h4>List Users
                              <a href="/add-staf" style="color: white;" class="btn btn-primary pull-right"> Add User </a>
                            </h4>
                          </div>

                          <div class="panel-body" style="overflow-x:auto;">
                            <table id="staf-table" width="100%" class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th width="50">ID</th>
                                  <th>Name</th>
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
        order: [[ 0, 'desc' ]],
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
      var csrf_token = $('meta[name="crsf_token"]').attr('content');
      Swal({
        title: 'Delete Data?',
        text: "Are You Sure To Delete This Data",
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
            url : "{{ url('kelola-staf') }}" + '/' + id,
            type: "POST",
            data: {'_method': 'DELETE', '_token': csrf_token},
            success: function(data) {
              table.ajax.reload();
              console.log(data);
              Swal({
                position: 'top-end',
                type: 'success',
                title: 'Data deleted',
                showConfirmButton: false,
                timer: 1500
              })
            },
            error: function(){
              Swal({
                position: 'top-end',
                type: 'error',
                title: 'Cannot delete this data',
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
          if(data.role == 0) $('#radioAdmin').prop('checked', true); else $('#radioStaf').prop('checked', true);

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
            Swal({
              position: 'top-end',
              type: 'success',
              title: 'Data edited',
              showConfirmButton: false,
              timer: 1500
            })
          },
          error: function() {
            Swal({
              position: 'top-end',
              type: 'error',
              title: 'Cannot delete this data',
              showConfirmButton: false,
              timer: 1500
            })
          },
        });
      });
    });







    </script>

@endsection
