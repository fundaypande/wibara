@extends('layouts.admin')

@section('content')

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

                    Daftar staf yang dapat mengakses sistem

                    <!-- table show daftar user yang dapat mengakses sistem -->
                    <div class="row">
                      <div class="com-md-12">
                        <div class="panel panel-default">

                          <div class="panel-heading">
                            <h4>Daftar Pengguna
                              <a onClick="#" class="btn btn-primary pull-right"> Tambah Pengguna </a>
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
    $(document).ready(function() {
      $('#staf-table').DataTable({
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



      $
    </script>

@endsection
