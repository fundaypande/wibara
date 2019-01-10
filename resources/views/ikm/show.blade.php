@extends('layouts.admin')

@section('content')

<style type="text/css" scoped>
  .tdIkm{
    font-weight: 500;
    width: 20%;
  }
  .tableIkm{
    font-size: 16px;
    width: 100%;
  }
  .tableIkm tr{
    height: 60px;
  }
  .tableIkm td:first{
    font-weight: 400;
  }
</style>

<div id="modal-form" class="modal fade" role="dialog" tabindex="1" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modal-title">Tambah Peralatan IKM</h4>
      </div>
      <div class="modal-body">

        <!-- Table Data -->
        <div class="panel-body" style="overflow-x:auto;">
          <!-- <table id="staf-table" width="100%" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th width="50">ID</th>
                <th>Jenis Bahan</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Harga</th>
                <th>Asal</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table> -->
        </div>

      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- end modal content -->

    <div class="row justify-content-center">

            <div style="padding-left: 20px; padding-right: 20px" class="card">
                <div class="card-header">
                  <h3>Profil IKM</h3>

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

                    <p>Daftar profil IKM</p>
                    <br>

                    <!-- table show daftar user yang dapat mengakses sistem -->

                      <?php
                        // --> Pengecekan jika yang input profil IKM adalah staf
                        // --> Maka tampilkan seadanya
                        $nama = null;
                        $email = null;
                        $notif = null;
                        $bahan = null;
                        $userId = null;
                        if($profils -> user_id){
                          // dd('User ID ADA');
                          if($profils -> user -> photo == null){
                            $url = 'user.png';
                          } else {
                            $url = $profils -> user -> photo;
                          }

                          $nama = $profils -> user -> name;
                          $email= $profils -> user -> email;
                          $bahan = $bahanBaku;
                          $userId = $profils -> user_id;

                        } else {
                          //jika user_id null maka data diinput oleh staf
                          // dd('User ID TIDAK ADA');
                          $url = 'user.png';
                          $notif= 'Data diinput oleh staf';
                        }

                      ?>


                    <div class="col-md-12">
                      <div class="col-md-3">
                        <center>
                        <div class="container" >
                          <div class="image company-header-avatar" style="background-image: url({!! asset('images/' . $url) !!}); width:200px; height:200px"></div>
                          <!-- <img src="{!! asset('images/' . $url) !!}" alt="Avatar" class="image profile-pic" width="100%"> -->
                        </div>

                        </center>
                        <br>
                        <div class="alert alert-primary">
            					    <b><i>{{$notif}}</i></b>
            					  </div>
                        <table>
                          <tr>
                            <td style="width: 100px"><i>Nama Pemilik</i></td>
                            <td><i>{{ $nama }}</i></td>
                          </tr>
                          <tr>
                            <td><i>Email</i></td>
                            <td><i>{{ $email }}</i></td>
                          </tr>
                        </table>
                        <br>
                        <!-- <br>
                        <button onclick="showBahan({{ $userId }})" style="width:65%; margin-bottom: 10px" type="submit" class="btn btn-info">Data Bahan Baku</button>

                        <button style="width:65%; margin-bottom: 10px" type="submit" class="btn btn-info">Data Jenis Peralatan</button>

                        <button style="width:65%" type="submit" class="btn btn-info">Data Nilai Produksi</button> -->
                      </div>
                      <div class="col-md-9">
                        <table class="tableIkm">

                          <tr>
                            <td class="tdIkm"><b>Nama Usaha</b></td>
                            <td>{{ $profils -> nama_usaha  }}</td>
                          </tr>
                          <tr>
                            <td class="tdIkm"><b>Alamat</b></td>
                            <td>{{ $profils -> alamat  }}</td>
                          </tr>
                          <tr>
                            <td class="tdIkm"><b>Merk Produk</b></td>
                            <td>{{ $profils -> merk_produk  }}</td>
                          </tr>
                          <tr>
                            <td class="tdIkm"><b>Telepon</b></td>
                            <td>{{ $profils -> telpon  }}</td>
                          </tr>
                          <tr>
                            <td class="tdIkm"><b>Jenis Produk Yang Dihasilkan</b></td>
                            <td>{{ $profils -> jenis_produk  }}</td>
                          </tr>

                          <tr>
                            <td class="tdIkm"><b>Jumlah Produksi Rata-rata</b></td>
                            <td>{{ $profils -> rerata_produksi  }}</td>
                          </tr>
                          <tr>
                            <td class="tdIkm"><b>Harga Rata-rata Produk</b></td>
                            <td>{{ $profils -> rerata_harga  }}</td>
                          </tr>
                          <tr>
                            <td class="tdIkm"><b>Rata-rata Nilai Penjualan</b></td>
                            <td>{{ $profils -> rerata_penjualan  }}</td>
                          </tr>
                          <tr>
                            <td class="tdIkm"><b>Tempat Pemasaran</b></td>
                            <td>{{ $profils -> tempat_pemasaran  }}</td>
                          </tr>
                          <tr>
                            <td class="tdIkm"><b>Total Peralatan dan Mesin Yang Dimiliki</b></td>
                            <td>{{ $profils -> total_peralatan  }}</td>
                          </tr>
                          <tr>
                            <td class="tdIkm"><b>Rata-rata Bahan Baku Yang Digunakan Pertahun</b></td>
                            <td>{{ $profils -> total_bahan_baku  }}</td>
                          </tr>
                          <tr>
                            <td class="tdIkm"><b>Jumlah Tenaga Kerja</b></td>
                            <td>{{ $profils -> total_pekerja  }}</td>
                          </tr>
                          <tr>
                            <td class="tdIkm"><b>Jarak Dari Dinas Ke Lokasi IKM</b></td>
                            <td>{{ $profils -> jarak  }} KM</td>
                          </tr>
                          <tr>
                            <td class="tdIkm"><b>Permasalahan Pada Usaha Yang Dihadapi</b></td>
                            <td>{{ $profils -> permasalahan  }}</td>
                          </tr>
                          <tr>
                            <td class="tdIkm"><b>Jenis Bimtek Yang Diminati</b></td>
                            <td>{{ $profils -> jenis_bimtek  }}</td>
                          </tr>
                        </table>
                      </div>

                    </div>

                    <div id="penting" class="">
                      <input type="hidden" name="id" id="id" value="{{ $userId }}" method="patch">
                    </div>

                    <div name="{{ $userId }}" class="panel-body" style="overflow-x:auto;">
                      <h3>Data Bahan Baku Produksi IKM</h3>
                      <table id="staf-table" width="100%" class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            <th width="50">ID</th>
                            <th>Jenis Bahan</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Harga</th>
                            <th>Asal</th>
                            <!-- <th>Action</th> -->
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>

                      <hr>
                      <br>

                      <h3>Data Peralatan Yang Dimiliki</h3>
                      <table id="table-peralatan" width="100%" class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            <th width="50">ID</th>
                            <th>Jenis Alat</th>
                            <th>Tahun Produksi</th>
                            <th>Spesifikasi</th>
                            <th>Kapasitas</th>
                            <th>Jumlah</th>
                            <th>Buatan</th>
                            <th>Harga</th>
                            <th>Asal</th>
                            <!-- <th>Action</th> -->
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>

                      <hr>
                      <br>



                      <h3>Data Hasil Produksi</h3>
                      <table id="table-produksi" width="100%" class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            <th width="50">ID</th>
                            <th>Jenis Produksi</th>
                            <th>Jumlah</th>
                            <th>rerataHarga</th>
                            <th>Nilai Penjualan</th>
                            <th>Tujuan Pemasaran</th>
                            <th>Deskripsi Produk</th>
                            <th>Photo</th>
                            <!-- <th>Action</th> -->
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    </div>


                </div>
            </div>

    </div>


    <script type="text/javascript">
    var table;

    $(document).ready(function() {
      var idUser = $("#penting").find("input[name='id']").val();
      console.log(idUser);

      url = '/api/bahan/'+idUser;
      console.log(url);
      table = $('#staf-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: url,
        columns: [
          {data: 'id', name: 'id'},
          {data: 'jenis_bahan', name: 'jenis_alat'},
          {data: 'jumlah', name: 'tahun'},
          {data: 'satuan', name: 'spesifikasi'},
          {data: 'harga', name: 'kapasitas'},
          {data: 'asal', name: 'jumlah'},
          // {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
      });


      url = '/api/peralatan/'+idUser;
      console.log(url);
      table = $('#table-peralatan').DataTable({
        processing: true,
        serverSide: true,
        ajax: url,
        columns: [
          {data: 'id', name: 'id'},
          {data: 'jenis_alat', name: 'jenis_alat'},
          {data: 'tahun', name: 'tahun'},
          {data: 'ket', name: 'spesifikasi'},
          {data: 'kapasitas', name: 'kapasitas'},
          {data: 'jumlah', name: 'jumlah'},
          {data: 'buatan', name: 'buatan'},
          {data: 'harga', name: 'harga'},
          {data: 'asal', name: 'asal'},
          // {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
      });


      url = '/api/produksi/'+idUser;
      console.log(url);
      table = $('#table-produksi').DataTable({
        processing: true,
        serverSide: true,
        ajax: url,
        columns: [
          {data: 'id', name: 'id'},
          {data: 'jenis_produksi', name: 'jenis_produksi'},
          {data: 'jumlah', name: 'jumlah'},
          {data: 'harga', name: 'harga'},
          {data: 'nilai_penjualan', name: 'nilai_penjualan'},
          {data: 'tujuan', name: 'tujuan'},
          {data: 'ket', name: 'deskripsi'},
          {data: 'photos', name: 'photos', orderable: false, searchable: false,
            render: function( data, type, full, meta ) {
                      return '<img src="' + data + '" height="50px" style="height: 50px;"/>';
                  }
          },
          // {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
      });



    });




    </script>

@endsection
