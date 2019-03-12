@extends('layouts.admin')

@section('css')

<style>
  input, button, submit { border:none; }
</style>

@endsection

@section('content')

    <div class="row justify-content-center">

            <div style="padding-left: 20px; padding-right: 20px" class="card">
                <div class="card-header">
                  <h3>Create Form</h3>

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

                      <form method="post" data-toggle="validator" action="/form/store" id="theForm">
                          {{ csrf_field() }} {{ method_field('POST') }}
                        <div class="col-sm-2">
                          <button style="width: 100%;" type="submit">
                            <div class="produk-card">
                              <div class="produk-images">
                                <div class="produksi-tumb" style="background-image: url({!! asset('images/add.png') !!})"></div>
                              </div>
                              <div class="produk-caption">
                                <p>Create New Form</p>
                              </div>
                            </div>
                          </button>
                        </div>
                      </form>

                        @foreach($form as $key => $data)
                          <div class="col-sm-2">
                            <a href="/form/{{$data -> id}}">
                              <div class="produk-card">
                                <div class="produk-images">
                                  <div class="produksi-tumb" style="background-image: url({!! asset('images/patern/'.$key.'.png') !!})"></div>
                                </div>
                                <div class="produk-caption">
                                  <p>Form ID {{$data -> id}}</p>
                                </div>
                              </div>
                            </a>
                          </div>

                        @endforeach


                      </div>
                    </div>


                </div>
            </div>

    </div>


    <script type="text/javascript">

    </script>

@endsection
