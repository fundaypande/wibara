@extends('layouts.admin')

@section('css')

  <!-- penambahan CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
   integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
   crossorigin=""/>

@endsection

@section('content')



    <div class="row justify-content-center">

            <div style="padding-left: 20px; padding-right: 20px" class="card">
                <div class="card-header">


                  <br>



                  <div class="" style="margin-top: 20px">
                      <!-- untuk batas kosong -->
                  </div>


                  <h3>Pemetaan IKM di Buleleng</h3>


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


                        <div id="mapid"></div>




                      </div>
                    </div>


                </div>
            </div>

    </div>


      <script src="{{ asset('js/rupiah.js') }}"></script>


      <!-- Make sure you put this AFTER Leaflet's CSS -->
      <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
       integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
       crossorigin="">
     </script>

    <script type="text/javascript">
    var table;
    $(document).ready(function() {

      var planes = [
        ["7C6B07",-8.195288, 115.167622],
        ["7C6B07",-8.122698, 115.185899],
      ];

      var data = [
        {!! json_encode($profil) !!}
      ];

      var nama = [
        {!! json_encode($nama) !!}
      ];

      console.log(nama);


      console.log(planes);

      console.log(nama[0][1]);



      //MAP JS
      var mymap = L.map('mapid').setView([-8.1845948, 115.187649], 11.38);

      L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiZnVuZGF5cGFuZGUiLCJhIjoiY2pyd3gzOTF6MGczOTN5bmNlMnRqaXFqeSJ9.jaVlZ0Z02cIPDO2KVoTnSw', {
          attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
          maxZoom: 25,
          id: 'mapbox.streets',
          accessToken: 'pk.eyJ1IjoiZnVuZGF5cGFuZGUiLCJhIjoiY2pyd3gzOTF6MGczOTN5bmNlMnRqaXFqeSJ9.jaVlZ0Z02cIPDO2KVoTnSw'
      }).addTo(mymap);

      console.log(data[0].length);
      for (var i = 0; i < data[0].length; i++) {
        marker = new L.marker(data[0][i],data[0][i])
          .bindPopup(nama[0][i])
          .addTo(mymap);
        // console.log(data[0][i]);
        // console.log(i);
      }

  });

    </script>

@endsection
