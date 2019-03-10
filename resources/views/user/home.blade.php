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
                  <h3>Selamat Datang {{ Auth::user()->name }}</h3>

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

                    <?php
                      if(Auth::user() -> role == 1){
                        $role = "IKM";
                      } else if(Auth::user() -> role == 2) {
                        $role = "Staf";
                      } else $role = "Admin";

                     ?>

                    <p>Anda login sebagai {{ $role }}</p>
                    <p>Pengguna tipe {{ $role }} dapat melakukan beberapa aksi diantaranya:</p>





                    <!-- Staf -->
                    @if(Auth::user() -> role == 2)
                      <ul style="list-style: outside; margin-left:25px">
                        <li>Mengelola Profil IKM termasuk diantaranya menambahkan, mengedit dan menghapus Profil IKM</li>
                        <li>Melakukan validasi terhadap profil IKM yang diinputkan oleh pengguna IKM</li>
                      </ul>


                    @endif

                    <!-- Admin -->
                    @if(Auth::user() -> role == 3)
                      <ul style="list-style: outside; margin-left:25px">
                        <li>Mengelola pengguna yang dapat mengakses sistem serta menentukan role atau batasan yang dimiliki oleh setiap pengguna yang dapat mengakses sistem</li>
                        <li>Menginput data perbandingan metode AHP</li>
                        <li>Menentukan calon bakal IKM yang akan menerima bantuan Bimtek</li>
                      </ul>


                    @endif


                </div>
            </div>

    </div>


    <script type="text/javascript">




    </script>

@endsection
