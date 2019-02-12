@extends('layouts.admin')

@section('content')



    <div class="row justify-content-center">

            <div style="padding-left: 20px; padding-right: 20px" class="card">
                <div class="card-header">
                  <h3>Proses Perangkingan</h3>

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

                    <p>Silahkan pilih nama komoditi serta tahun yang akan diseleksi</p>
                    <br>

                    <!-- table show daftar user yang dapat mengakses sistem -->
                    <div class="row">
                      <div class="col-md-12">


                        <!-- content is here -->


                        <!-- Mengecek apakah pembobotan telah dilakukan -->
                        @if($kriteria[0] -> bobot == 0)
                        <div class="alert alert-warning ">
                          Anda belum melakukan pembobotan masing-masing kriteria, silahkan lakukan pembobotan sebelum melakukan perangkingan
                          <a style="color:white" href="{{ url('/kriteria-ahp') }}" class="btn btn-primary">Pembobotan</a>
                        </div>
                        @else
                        <!-- Tampilkan dropdown komoditi dan tahun -->

                        <form method="post" data-toggle="validator" action="{{ url('/perangkingan/hasil/') }}" id="theForm">
                          {{ csrf_field() }} {{ method_field('POST') }}

                          <div class="col-md-4">
                            <!-- Untuk dropdown komoditi -->
                            <label for="komoditi">Komoditi</label>
                            <select id="komoditi" name="komoditi" class="form-control">
                              <!-- <option value=""> Pilih Komoditi</option> -->
                            </select>
                          </div>

                          <div class="col-md-4">
                            <!-- Untuk Tahun -->
                            <label for="tahun">Tahun</label>
                            <select id="tahun" name="tahun" class="form-control">
                              <!-- <option value=""> Pilih Tahun</option> -->
                            </select>
                          </div>

                          <div class="col-md-4">
                            <!-- Untuk TOmbol -->
                            <label for="submit" style="color:white">Submit</label>
                            <br>
                            <button type="submit" class="btn btn-info btn-fill">Tampilkan Data</button>
                          </div>

                        </form>



                        @endif

                        <!-- end of content -->


                      </div>
                    </div>


                </div>
            </div>

    </div>


    <script type="text/javascript">

    $(document).ready(function() {


    $.ajax({

      url: "{{ url('/api/komoditi/admin') }}",
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",

      success: function (data) {
          console.log(data.length);
          console.log(data);
          var count = data.length;
          for (var i = 0; i < count; i++) {
            // $("#tahun option[value='"+ data[i].tahun +"']").attr("disabled", true);
            $('#komoditi').append('<option value='+ data[i].id+'>'+data[i].nama+'</option>');

          }

          // $("#tahun option[value='"+ data -> tahun +"']").attr("disabled", true);

      },
      error: function (errormessage) {
          alert(errormessage.responseText);
      }
    });


    $.ajax({

      url: "{{ url('/api/tahun/ready') }}",
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",

      success: function (data) {
          console.log(data.length);
          console.log(data);
          var count = data.length;
          for (var i = 0; i < count; i++) {
            // $("#tahun option[value='"+ data[i].tahun +"']").attr("disabled", true);
            $('#tahun').append('<option value='+ data[i].tahun+'>'+data[i].tahun+'</option>');

          }

          // $("#tahun option[value='"+ data -> tahun +"']").attr("disabled", true);

      },
      error: function (errormessage) {
          alert(errormessage.responseText);
      }
    });



  });



    </script>

@endsection
