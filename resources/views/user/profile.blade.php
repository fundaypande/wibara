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
          <label for="nama">Photo</label>
          <input type="file" name="gambar" class="form-control">
        </div>

        <button type="submit" class="btn btn-info btn-fill">Save Profile</button>
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
                  <h3>Change Profile</h3>

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
                    <div class="image user-avatar" style="background-image: url({!! asset('images/' . $url) !!})"></div>
                    <!-- <img src="{!! asset('images/' . $url) !!}" alt="Avatar" class="image profile-pic" width="100%"> -->
                    <div class="middle">
                      <a id="change-pic" onclick="addForm()" class="btn btn-info btn-fill">Change Photo</a>
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
                                    <label>Name</label>
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

    function addForm() {
      save_method = "add";
      $('input[name=_method]').val('PUT');
      $('#modal-form').modal('show');
      $('#theForm')[0].reset();
      $('.modal-title').text('Change Photo Profile');
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
