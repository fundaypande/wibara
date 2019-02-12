@extends('layouts.admin')

@section('content')


    <div class="row justify-content-center">

            <div style="padding-left: 20px; padding-right: 20px" class="card">
                <div class="card-header">


                  <br>

                  <div class="" style="margin-top: 20px">
                      <!-- untuk batas kosong -->
                  </div>


                  <h3>Evaluasi Perkembangan IKM Penerima Bantuan</h3>

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

                    <br>

                    <!-- table show daftar user yang dapat mengakses sistem -->
                    <div class="row">
                      <div class="com-md-12">

                        
                      </div>
                    </div>


                </div>
            </div>

    </div>


      <script src="{{ asset('js/rupiah.js') }}"></script>

    <script type="text/javascript">
    var table;
    $(document).ready(function() {


    });









    </script>

@endsection
