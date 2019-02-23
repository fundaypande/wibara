@extends('layouts.admin')

@section('css')

  <!-- penambahan CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
   integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
   crossorigin=""/>

@endsection

@section('content')

<div id="modal-form" class="modal fade" role="dialog" tabindex="1" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modal-title">Tambah Bahan Baku IKM</h4>
      </div>
      <div class="modal-body">

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

                  <br>

                  <a href="{{ url('/kelola-ikm') }}">Kelola IKM</a> <i style="" class="fa fa-angle-double-right" aria-hidden="true"></i> <a href="#">{{ $user -> name }}</a>

                  <div class="" style="margin-top: 20px">
                      <!-- untuk batas kosong -->
                  </div>

                  <h3>Kelola Data Profil IKM {{ $user -> name }}</h3>
                  <input type="hidden" name="idUser" id="idUser" value="{{ $user -> id }}">

                </div>

                @if(count($errors) > 0)
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors-> all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
                @endif

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

                    <p>Data Profil IKM</p>
                    <br>

                    <!-- table show daftar user yang dapat mengakses sistem -->
                    <div class="row">
                      <div class="com-md-12">
                        <div class="panel panel-default">

                          <div class="panel-heading">
                            <h5>Informasi Data Profil IKM

                            </h5>
                          </div>

                          <div class="panel-body" style="overflow-x:auto;">


                            <!-- Start Form -->
                            @foreach($profil as $prof)


                            <form action="/profilikm/{{ $prof-> id }}/{{ $user->id }}" method="POST">
                              {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">

                            <div class="forn-group">
                              <label for="komoditi">Komoditi</label>
                              <select id="komoditi" name="komoditi" class="form-control">
                                <option value='{{ $prof -> komoditi_id }}'>{{ $prof -> nama }}</option>
                                <!-- diisi oleh ajax -->
                              </select>
                            </div>
                            <br>


                            <div class="form-group">
                              <label for="nama_usaha">Nama Usaha</label>
                              <input type="text" name="nama_usaha" value="{{ $prof -> nama_usaha }}" class="form-control" id="nama_usaha" required placeholder="">
                            </div>
                            <div class="form-group">
                              <label for="badan_hukum">Badan Hukum</label>
                              <input min="1" type="text" name="badan_hukum" value="{{ $prof -> badan_hukum }}" class="form-control" id="badan_hukum" required placeholder="">
                            </div>
                            <div class="form-group">
                              <label for="izin_usaha">Izin Usaha</label>
                              <input type="text" name="izin_usaha" value="{{ $prof -> izin_usaha }}" class="form-control" id="izin_usaha" placeholder="" required>
                            </div>
                            <div class="form-group">
                              <label for="merk_produk">Merk Produk</label>
                              <input type="text" name="merk_produk" value="{{ $prof -> merk_produk }}" class="form-control" id="merk_produk" placeholder="" required>
                            </div>
                            <div class="form-group">
                              <label for="alamat">Alamat</label>
                              <textarea name="alamat" class="form-control" id="alamat" rows="2" required>{{ $prof -> alamat }}</textarea>
                            </div>
                            <div class="form-group">
                              <label for="telpon">Telepon</label>
                              <input type="tel" pattern="^\d{12}$" name="telpon" value="{{ $prof -> telpon }}" class="form-control" id="telpon" placeholder="" required>
                            </div>
                            <div class="form-group">
                              <label for="jenis_produk">Jenis Produk</label>
                              <input type="text" name="jenis_produk" value="{{ $prof -> jenis_produk }}" class="form-control" id="jenis_produk" placeholder="" required>
                            </div>

                            <div class="form-group">
                              <label for="tempat_pemasaran">Lokasi Pemasaran</label>
                              <input type="text" name="tempat_pemasaran" value="{{ $prof -> tempat_pemasaran }}" class="form-control" id="tempat_pemasaran" placeholder="" required>
                            </div>
                            <div class="form-group">
                              <label for="permasalahan">Permasalahan Pada Usaha Yang Dihadapi Saat Ini</label>
                              <textarea name="permasalahan" class="form-control" id="permasalahan" rows="2" required>{{ $prof -> permasalahan }}</textarea>
                            </div>
                            <div class="form-group">
                              <label for="jenis_bimtek">Bantuan Yang Pernah Diterima</label>

                              <input type="text" name="jenis_bimtek" value="{{ $prof -> jenis_bimtek }}" class="form-control" id="jenis_bimtek" placeholder="" required>

                            </div>

                            @endforeach

                            <div class="form-group">
                              <label for="lat">Latitude</label>
                              <input type="text" name="lat" value="{{ $profil[0] -> lat }}" class="form-control" id="lat" required placeholder="">
                            </div>

                            <div class="form-group">
                              <label for="lng">Longitude</label>
                              <input type="text" name="lng" value="{{ $profil[0] -> lng }}" class="form-control" id="lng" required placeholder="">
                            </div>

                            <a href="https://google.com/maps" target="_blank">Google Maps</a>

                            <div id="mapid"></div>
                            <br>


                            <div class="form-group">
                              <label for="jarak">Jarak Dari Dinas Ke Lokasi IKM (Tahan dan geser marker pada peta)</label>
                              <input type="text" name="jarak" value="{{ $profil[0] -> jarak }}" class="form-control" id="jarak" placeholder="Kilometer" required>
                            </div>


                            <br>

                            <button type="submit" class="btn btn-info btn-fill">Simpan Data</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </form>


                            <!-- END FORM -->

                          </div>


                        </div>
                      </div>
                    </div>


                </div>
            </div>

    </div>

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
     integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
     crossorigin="">
   </script>

    <script src="{{ asset('js/rupiah.js') }}"></script>
    <script type="text/javascript">


    // mengambil data jenis bimtek dari API
    $.ajax({

      url: "{{ url('/api/bimtek/all') }}",
      type: "GET",
      contentType: "application/json;charset=utf-8",
      dataType: "json",

      success: function (data) {
          console.log(data.length);
          console.log(data);
          var count = data.length;
          for (var i = 0; i < count; i++) {
            // $("#tahun option[value='"+ data[i].tahun +"']").attr("disabled", true);
            $('#jenis_bimtek').append('<option >'+data[i].nama+'</option>');

          }

          // $("#tahun option[value='"+ data -> tahun +"']").attr("disabled", true);

      },
      error: function (errormessage) {
          alert(errormessage.responseText);
      }
    });

    var table;
    $(document).ready(function() {

      // MAPS JS
      var mymap = L.map('mapid').setView([-8.1845948, 115.187649], 11.38);

      L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiZnVuZGF5cGFuZGUiLCJhIjoiY2pyd3gzOTF6MGczOTN5bmNlMnRqaXFqeSJ9.jaVlZ0Z02cIPDO2KVoTnSw', {
          attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
          maxZoom: 18,
          id: 'mapbox.streets',
          accessToken: 'pk.eyJ1IjoiZnVuZGF5cGFuZGUiLCJhIjoiY2pyd3gzOTF6MGczOTN5bmNlMnRqaXFqeSJ9.jaVlZ0Z02cIPDO2KVoTnSw'
      }).addTo(mymap);


      // mymap.on('click',
    	// function(e){
    	// 	var coord = e.latlng.toString().split(',');
    	// 	var lat = coord[0].split('(');
    	// 	var lng = coord[1].split(')');
    	// 	alert("You clicked the map at LAT: " + lat[1] + " and LONG: " + lng[0]);
    	// 	L.marker(e.latlng).addTo(mymap);
    	// });

      //mengambil data koordinat dari database yang telah tersimpan

      var lngData = $('#lng').val();
      var latData = $('#lat').val();
      console.log(lngData + '-' + latData);
      var markerData = [latData, lngData];
      var koordinatDef = [-8.195288, 115.167622];
      var koordinat = null;

      if(lngData == 0) koordinat = koordinatDef; else koordinat = markerData;

      console.log('Ini adalah data koordinat default :' + koordinatDef);
      console.log('Ini adalah data koordinat database :' + markerData);

      console.log('koordinat hasil :' + koordinat);

      var myMarker = L.marker(koordinat, {title: "MyPoint", alt: "The Big I", draggable: true})
  		.addTo(mymap)
  		.on('dragend', function() {
  			var coord = String(myMarker.getLatLng()).split(',');
  			console.log(coord);
  			var lat = coord[0].split('(');
  			console.log(lat);
  			var lng = coord[1].split(')');
  			console.log(lng);
  			myMarker.bindPopup("Moved to: " + lat[1] + ", " + lng[0] + ".");

        // set hidden input lat lng
        $('#lat').val(lat[1]);
        $('#lng').val(lng[0]);

        // set jarak input
        var distance = getDistance([lat[1], lng[0]], [-8.115213, 115.085471])/1000;
        var hasil = distance.toFixed(4);
        $('#jarak').val(hasil);

  		});


      // Fungsi menghitung jarak
      function getDistance(origin, destination) {
        // return distance in meters
        var lon1 = toRadian(origin[1]),
            lat1 = toRadian(origin[0]),
            lon2 = toRadian(destination[1]),
            lat2 = toRadian(destination[0]);

        var deltaLat = lat2 - lat1;
        var deltaLon = lon2 - lon1;

        var a = Math.pow(Math.sin(deltaLat/2), 2) + Math.cos(lat1) * Math.cos(lat2) * Math.pow(Math.sin(deltaLon/2), 2);
        var c = 2 * Math.asin(Math.sqrt(a));
        var EARTH_RADIUS = 6371;
        return c * EARTH_RADIUS * 1000;
        }

        function toRadian(degree) {
            return degree*Math.PI/180;
        }




      // END MAPS JS


      var idUser = $( "#idUser" ).val();

      justNum($('#jumlah'));
      justNum($('#harga'));

      $.ajax({

        url: "{{ url('/api/komoditi/staf') }}",
        type: "GET",
        contentType: "application/json;charset=utf-8",
        dataType: "json",

        success: function (data) {
            console.log(data.length);
            var count = data.length;
            for (var i = 0; i < data.length; i++) {
              // $("#tahun option[value='"+ data[i].tahun +"']").attr("disabled", true);
              $('#komoditi').append('<option value='+ data[i].id+'>'+data[i].nama+'</option>');

            }

            // $("#tahun option[value='"+ data -> tahun +"']").attr("disabled", true);

        },
        error: function (errormessage) {
            alert(errormessage.responseText);
        }
      });


      table = $('#staf-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('/api/profilikm') }}" + '/' + idUser,
        columns: [
          {data: 'id', name: 'id'},
          {data: 'nama_usaha', name: 'nama_usaha'},
          {data: 'badan_hukum', name: 'badan_hukum'},
          {data: 'izin_usaha', name: 'izin_usaha'},
          {data: 'merk_produk', name: 'merk_produk'},
          {data: 'alamat', name: 'alamat'},
          {data: 'telpon', name: 'telpon'},
          {data: 'jenis_produk', name: 'jenis_produk'},
          {data: 'tempat_pemasaran', name: 'tempat_pemasaran'},
          {data: 'permasalahan', name: 'permasalahan'},
          {data: 'jenis_bimtek', name: 'jenis_bimtek'},
          {data: 'tahun', name: 'tahun'},
          {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
      });


    });

    function deleteData(id){
      var csrf_token = $('meta[name="crsf_token"]').attr('content');
      Swal({
        title: 'Hapus Data?',
        text: "Apakah anda yakin ingin menghapus data ini",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "{{ url('bahan') }}" + '/' + id,
            type: "POST",
            data: {'_method': 'DELETE', '_token': csrf_token},
            success: function(data) {
              table.ajax.reload();
              console.log(data);
              Swal({
                position: 'top-end',
                type: 'success',
                title: 'Data berhasil dihapus',
                showConfirmButton: false,
                timer: 1500
              })
            },
            error: function(){
              Swal({
                position: 'top-end',
                type: 'error',
                title: 'Data berhasil dihapus',
                showConfirmButton: false,
                timer: 1500
              })
            }
          });
        }
      });
    }


    function editData(id) {
      save_method = 'edit';
      $('input[name=_method]').val('PATCH');
      urlAction = "{{ url('bahan') }}";
      $('#modal-title').text('Edit Bahan Baku IKM');
      console.log(id);
      // $('#modal-form')[0].reset();
      console.log(urlAction);
      $.ajax({
        url: "{{ url('bahan') }}/" + id + "/edit",
        type: "GET",
        dataType: "JSON",
        success: function(data) {

          $('#modal-form').modal('show');


          // edit action pada form menjadi format URL patch di web.php
          $("#modal-form").find("form").attr("action", urlAction + '/' + id);

          $('#id').val(data.id);
          $('#jenis_bahan').val(data.jenis_bahan);
          $('#tahun').val(data.tahun);
          $('#satuan').val(data.satuan);
          $('#jumlah').val(data.jumlah);
          $('#harga').val(data.harga);
          $('#asal').val(data.asal);

          $("#tahun > [value=" + data.tahun + "]").attr("selected", "true");

        },
        error: function() {
          Swal({
            position: 'top-end',
            type: 'error',
            title: 'Terjadi kesalahan',
            showConfirmButton: false,
            timer: 1500
          })
        },
      });
    }

    $(function(){
      $('#modal-form form').validator().on('submit', function (e) {
        e.preventDefault();
        var data = $('form').serialize();
        console.log("Submit dipencet");
        var form_action = $("#modal-form").find("form").attr("action");
        var jenis_alat = $("#modal-form").find("input[name='jenis_alat']").val();
        var csrf_token = $('meta[name="crsf_token"]').attr('content');
        console.log(jenis_alat);
        console.log(form_action);
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: form_action,
          type: "POST",
          dataType: "JSON",
          data: data,
          success: function(data) {
            table.ajax.reload();
            $(".modal").modal('hide');
            Swal({
              position: 'top-end',
              type: 'success',
              title: 'Selamat data berhasi disimpan',
              showConfirmButton: false,
              timer: 1500
            });
          },
          error: function(jqXhr, json, errorThrown){// this are default for ajax errors
            var errors = jqXhr.responseJSON;
            var errorsHtml = '';
            $.each(errors['errors'], function (index, value) {
                errorsHtml += '<ul class="list-group"><li class="list-group-item alert alert-danger">' + value + '</li></ul>';
            });
            //I use SweetAlert2 for this
            swal({
                title: "Error " + jqXhr.status + ': ' + errorThrown,// this will output "Error 422: Unprocessable Entity"
                html: errorsHtml,
                width: 'auto',
                confirmButtonText: 'Try again',
                cancelButtonText: 'Cancel',
                confirmButtonClass: 'btn',
                cancelButtonClass: 'cancel-class',
                showCancelButton: true,
                closeOnConfirm: true,
                closeOnCancel: true,
                type: 'error'
            }, function(isConfirm) {
                if (isConfirm) {
                     $('#openModal').click();//this is when the form is in a modal
                }
            });

          } //error close
        });
      });
    });

    function addForm(id) {
      save_method = "add";
      $('input[name=_method]').val('POST');
      $('#modal-form').modal('show');
      $('#theForm')[0].reset();
      $('.modal-title').text('Tambah Bahan Baku IKM');
      console.log('Tampilkan Form ADD');
      $("#modal-form").find("form").attr("action", "{{ url('bahan') }}/" + id);
    }







    </script>

@endsection
