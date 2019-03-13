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

                        <?php
                          $aneka = ['Accountability','Nationalism','Public Ethics','Quality Commitment', 'Anti-Corruption'];
                          $standar = ['Antecedents Standard','Transaction Standard','Outcomes Standard'];
                         ?>

                     <form method="post" data-toggle="validator" action="{{ url('/weight/process/') }}/{{Auth::user() -> id}}" id="theForm">
                      {{ csrf_field() }} {{ method_field('POST') }}

                        <h4>Parahyangan</h4>

                        <div class="panel-body" style="overflow-x:auto;">
                          <table class="table table-striped">
                            <tr>
                              <th>-</th>
                              @foreach($standar as $key => $data)
                                <th><b>{{ $data }}</b></th>
                              @endforeach
                            </tr>

                            @foreach($aneka as $keyAneka => $data)
                              <tr>
                                <th>{{$data}}</th>
                                @foreach($standar as $keyStandar => $data)
                                <th>
                                  <select id="komoditi" name="a{{$keyAneka}}{{$keyStandar}}" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                  </select>
                                </th>
                                @endforeach
                              </tr>
                            @endforeach

                          </table>
                        </div>


                        <h4>Pawongan</h4>

                        <div class="panel-body" style="overflow-x:auto;">
                          <table class="table table-striped">
                            <tr>
                              <th>-</th>
                              @foreach($standar as $key => $data)
                                <th><b>{{ $data }}</b></th>
                              @endforeach
                            </tr>

                            @foreach($aneka as $keyAneka => $data)
                              <tr>
                                <th>{{$data}}</th>
                                @foreach($standar as $keyStandar => $data)
                                <th>
                                  <select id="komoditi" name="b{{$keyAneka}}{{$keyStandar}}" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                  </select>
                                </th>
                                @endforeach
                              </tr>
                            @endforeach

                          </table>
                        </div>

                        <h4>Palemahan</h4>

                        <div class="panel-body" style="overflow-x:auto;">
                          <table class="table table-striped">
                            <tr>
                              <th>-</th>
                              @foreach($standar as $key => $data)
                                <th><b>{{ $data }}</b></th>
                              @endforeach
                            </tr>

                            @foreach($aneka as $keyAneka => $data)
                              <tr>
                                <th>{{$data}}</th>
                                @foreach($standar as $keyStandar => $data)
                                <th>
                                  <select id="komoditi" name="c{{$keyAneka}}{{$keyStandar}}" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                  </select>
                                </th>
                                @endforeach
                              </tr>
                            @endforeach

                          </table>
                        </div>

                        <button style="float: right; width: 200px;" type="submit" class="btn btn-info btn-fill">Submit</button>

                      </form>

                      </div>
                    </div>


                </div>
            </div>

    </div>


    <script type="text/javascript">










    </script>

@endsection
