@extends('layouts.admin')

@section('css')
  <link rel="stylesheet" href="{!! asset('css/highcharts.scss') !!}">
@endsection

@section('content')



    <div class="row justify-content-center">

            <div style="padding-left: 20px; padding-right: 20px" class="card">
                <div class="card-header">
                  <h3>Evaluasi Penerima Bantuan Dari {{ $user -> name }}</h3>
                  <input type="hidden" name="idUser" id="idUser" value="">

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

                    <p>Evaluasi Pelaku IKM</p>
                    <br>

                    <!-- table show daftar user yang dapat mengakses sistem -->
                    <div class="row">
                      <div class="com-md-12">


                          <?php
                          // dd($series);
                            //menampilkan data kriteria
                            print('<div class="col-md-6">');
                            print('<h4> Sebelum Menerima Bantuan</h4>');
                            for ($i=0; $i < $dataKriteria->count() ; $i++) {
                            $read = 'text';




                              ?>
                              @if($dataKriteria[$i] -> nama == 'jarak' || $dataKriteria[$i] -> nama == 'Jarak'|| $dataKriteria[$i] -> nama == 'Lama Berdirinya Usaha (Tahun)')
                                <?php
                                  $read = 'hidden';
                                 ?>
                              @else
                                {{ $read = null }}
                              @endif
                                <div class="form-group">
                                  <label for="jenis_bahan">{{ $dataKriteria[$i] -> nama }}</label>
                                  <input type="{{ $read }}" name="jenis_bahan" value="{{ $dataKriteria[$i] -> nilai }}" class="form-control" id="jenis_bahan" readonly required placeholder="">
                                </div>


                              <?php


                            }
                            print('</div>');



                            print('<div class="col-md-6">');
                            print('<h4> Setelah Menerima Bantuan</h4>');
                            for ($i=0; $i < $dataEvaluasi->count() ; $i++) {
                              $read = 'text';


                              ?>

                              @if($dataKriteria[$i] -> nama == 'jarak' || $dataKriteria[$i] -> nama == 'Jarak' || $dataKriteria[$i] -> nama == 'Lama Berdirinya Usaha (Tahun)')
                                <?php
                                  $read = 'hidden';
                                 ?>
                              @else
                                {{ $read = null }}
                              @endif

                                <div class="form-group">
                                  <label for="jenis_bahan">{{ $dataEvaluasi[$i] -> nama }}</label>
                                  <input type="{{ $read }}" name="jenis_bahan" value="{{ $dataEvaluasi[$i] -> nilai }}" class="form-control" id="jenis_bahan" readonly required placeholder="">
                                </div>


                              <?php


                            }
                            print('</div>');


                           ?>



                      </div>

                      <div class="col-md-12">
                        <div class="row">

                          <!-- col MD 6 -->
                          <div class="col-md-6">
                            <div class="panel panel-default">
                    					<div class="panel-body">
                    						<div id="grafik-0"></div>
                    					</div>
                    				</div>
                          </div>
                          <!-- end md 6 -->

                          <!-- col MD 6 -->
                          <div class="col-md-6">
                            <div class="panel panel-default">
                    					<div class="panel-body">
                    						<div id="grafik-1"></div>
                    					</div>
                    				</div>
                          </div>
                          <!-- end md 6 -->

                        </div>

                        <div class="col-md-12">
                          <div class="row">

                            <!-- col MD 6 -->
                            <div class="col-md-6">
                              <div class="panel panel-default">
                      					<div class="panel-body">
                      						<div id="grafik-2"></div>
                      					</div>
                      				</div>
                            </div>
                            <!-- end md 6 -->

                            <!-- col MD 6 -->
                            <div class="col-md-6">
                              <div class="panel panel-default">
                      					<div class="panel-body">
                      						<div id="grafik-3"></div>
                      					</div>
                      				</div>
                            </div>
                            <!-- end md 6 -->

                          </div>

                          <div class="col-md-12">
                            <div class="row">

                              <!-- col MD 6 -->
                              <div class="col-md-6">
                                <div class="panel panel-default">
                        					<div class="panel-body">
                        						<div id="grafik-4"></div>
                        					</div>
                        				</div>
                              </div>
                              <!-- end md 6 -->

                              <!-- col MD 6 -->
                              <div class="col-md-6">
                                <div class="panel panel-default">
                        					<div class="panel-body">
                        						<div id="grafik-5"></div>
                        					</div>
                        				</div>
                              </div>
                              <!-- end md 6 -->

                            </div>

                			</div>

                    </div>


                </div>
            </div>

    </div>

    <script src="{!! asset('js/highcharts.js') !!}"></script>

    <script type="text/javascript">



    $(function(){
			Highcharts.chart('grafik-0', {
			    chart: {
			        type: 'column'
			    },
			    title: {
			        text: 'Perbandingan Nilai Kriteria Produksi Perbulan'
			    },
			    subtitle: {
			        text: 'Per Kriteria'
			    },
			    xAxis: {
			        categories: {!! json_encode($category) !!},
			        crosshair: true
			    },
			    yAxis: {
			        min: 0,
			        title: {
			            text: 'Jumlah'
			        }
			    },
			    tooltip: {
			        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
			        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
			            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
			        footerFormat: '</table>',
			        shared: true,
			        useHTML: true
			    },
			    plotOptions: {
			        column: {
			            pointPadding: 0.2,
			            borderWidth: 0
			        }
			    },
			    series: {!! json_encode($series0) !!}
			});

      Highcharts.chart('grafik-1', {
			    chart: {
			        type: 'column'
			    },
			    title: {
			        text: 'Perbandingan Nilai Kriteria Rerata Harga'
			    },
			    subtitle: {
			        text: 'Per Kriteria'
			    },
			    xAxis: {
			        categories: {!! json_encode($category) !!},
			        crosshair: true
			    },
			    yAxis: {
			        min: 0,
			        title: {
			            text: 'Jumlah'
			        }
			    },
			    tooltip: {
			        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
			        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
			            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
			        footerFormat: '</table>',
			        shared: true,
			        useHTML: true
			    },
			    plotOptions: {
			        column: {
			            pointPadding: 0.2,
			            borderWidth: 0
			        }
			    },
			    series: {!! json_encode($series1) !!}
			});

      Highcharts.chart('grafik-2', {
          chart: {
              type: 'column'
          },
          title: {
              text: 'Perbandingan Nilai Kriteria Jumlah Peralatan'
          },
          subtitle: {
              text: 'Per Kriteria'
          },
          xAxis: {
              categories: {!! json_encode($category) !!},
              crosshair: true
          },
          yAxis: {
              min: 0,
              title: {
                  text: 'Jumlah'
              }
          },
          tooltip: {
              headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
              pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                  '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
              footerFormat: '</table>',
              shared: true,
              useHTML: true
          },
          plotOptions: {
              column: {
                  pointPadding: 0.2,
                  borderWidth: 0
              }
          },
          series: {!! json_encode($series2) !!}
      });

      Highcharts.chart('grafik-3', {
          chart: {
              type: 'column'
          },
          title: {
              text: 'Perbandingan Nilai Kriteria Jumlah Pegawai'
          },
          subtitle: {
              text: 'Per Kriteria'
          },
          xAxis: {
              categories: {!! json_encode($category) !!},
              crosshair: true
          },
          yAxis: {
              min: 0,
              title: {
                  text: 'Jumlah'
              }
          },
          tooltip: {
              headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
              pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                  '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
              footerFormat: '</table>',
              shared: true,
              useHTML: true
          },
          plotOptions: {
              column: {
                  pointPadding: 0.2,
                  borderWidth: 0
              }
          },
          series: {!! json_encode($series3) !!}
      });

      Highcharts.chart('grafik-4', {
          chart: {
              type: 'column'
          },
          title: {
              text: 'Perbandingan Nilai Kriteria Nilai Penjualan'
          },
          subtitle: {
              text: 'Per Kriteria'
          },
          xAxis: {
              categories: {!! json_encode($category) !!},
              crosshair: true
          },
          yAxis: {
              min: 0,
              title: {
                  text: 'Jumlah'
              }
          },
          tooltip: {
              headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
              pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                  '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
              footerFormat: '</table>',
              shared: true,
              useHTML: true
          },
          plotOptions: {
              column: {
                  pointPadding: 0.2,
                  borderWidth: 0
              }
          },
          series: {!! json_encode($series4) !!}
      });

      Highcharts.chart('grafik-5', {
          chart: {
              type: 'column'
          },
          title: {
              text: 'Perbandingan Nilai Kriteria Bahan Baku'
          },
          subtitle: {
              text: 'Per Kriteria'
          },
          xAxis: {
              categories: {!! json_encode($category) !!},
              crosshair: true
          },
          yAxis: {
              min: 0,
              title: {
                  text: 'Jumlah'
              }
          },
          tooltip: {
              headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
              pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                  '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
              footerFormat: '</table>',
              shared: true,
              useHTML: true
          },
          plotOptions: {
              column: {
                  pointPadding: 0.2,
                  borderWidth: 0
              }
          },
          series: {!! json_encode($series5) !!}
      });
		})







    </script>

@endsection
