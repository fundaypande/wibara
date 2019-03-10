@extends('layouts.admin')

@section('content')

<!-- Modal content-->


<!-- end modal content -->

    <div class="row justify-content-center">

            <div style="padding-left: 20px; padding-right: 20px" class="card">
                <div class="card-header">
                  <h3>Input of Weight</h3>

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

                        <input action="action" style="margin-left: 20px;margin-bottom: 20px;" onclick="window.history.go(-1); return false;" type="button" value="Reinput Weight" class="btn btn-primary"/>

                      <form method="post" data-toggle="validator" action="{{ url('/weight/save') }}" id="theForm">
                       {{ csrf_field() }} {{ method_field('POST') }}

                        <div class="col-md-4">
                          <h4>Parahyangan</h4>

                          @foreach($averageA as $keyA => $dataA)
                            <input type="text" class="form-control" id="email" name="{{$keyA}}" value="{{$dataA}}" readonly>
                          @endforeach
                        </div>

                        <div class="col-md-4">
                          <h4>Pawongan</h4>
                          <?php $i = 5; ?>
                          @foreach($averageB as $keyB => $dataB)

                            <input type="text" class="form-control" id="email" name="{{$i}}" value="{{$dataB}}" readonly>
                            <?php $i++; ?>
                          @endforeach
                        </div>

                        <div class="col-md-4">
                          <h4>Palemahan</h4>
                          <?php $j = 10; ?>
                          @foreach($averageC as $keyC => $dataC)
                            <input type="text" class="form-control" id="email" name="{{$j}}" value="{{$dataC}}" readonly>
                            <?php $j++; ?>
                          @endforeach
                        </div>

                        <button style="float: right; width: 200px;     margin-top: 20px;" type="submit" class="btn btn-info btn-fill">Save</button>

                      </form>


                      </div>
                    </div>


                </div>
            </div>

    </div>


    <script type="text/javascript">










    </script>

@endsection
