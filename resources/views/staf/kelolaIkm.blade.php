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
        <form method="post" data-toggle="validator" action="/profil/store">
          {{ csrf_field() }} {{ method_field('POST') }}
        <input type="hidden" name="id" id="id" value="" method="patch">
        <div class="form-group">
          <label for="nama">Nama Usaha</label>
          <input type="text" name="nama" value="" class="form-control" id="nama" required placeholder="">
        </div>
        <div class="form-group">
          <label for="lamaBerdiri">Lama Berdirinya Usaha</label>
          <input min="1" type="text" name="lamaBerdiri" value="" class="form-control" id="lamaBerdiri" required placeholder="4 tahun">
        </div>
        <div class="form-group">
          <label for="merk">Merk Produk</label>
          <input type="text" name="merk" value="" class="form-control" id="merk" placeholder="" required>
        </div>
        <div class="form-group">
          <label for="alamat">Alamat</label>
          <textarea name="alamat" class="form-control" id="alamat" rows="2" required></textarea>
        </div>
        <div class="form-group">
          <label for="telepon">Telepon</label>
          <input type="tel" pattern="^\d{12}$" name="telepon" value="" class="form-control" id="telepon" placeholder="" required>
        </div>
        <div class="form-group">
          <label for="jenisProduk">Jenis Produk</label>
          <input type="text" name="jenisProduk" value="" class="form-control" id="jenisProduk" placeholder="" required>
        </div>
        <div class="form-group">
          <label for="rerataProduksi">Rata-rata Produksi Perbulan</label>
          <input type="text" name="rerataProduksi" value="" class="form-control" id="rerataProduksi" placeholder="pcs" required>
        </div>
        <div class="form-group">
          <label for="rerataHarga">Rata-rata Harga Produk</label>
          <input type="text" name="rerataHarga" value="" class="form-control" id="rerataHarga" placeholder="Rp." required>
        </div>
        <div class="form-group">
          <label for="rerataPenjualan">Rata-rata Hasil Penjualan Pertahun</label>
          <input type="text" name="rerataPenjualan" value="" class="form-control" id="rerataPenjualan" placeholder="Rp." required>
        </div>
        <div class="form-group">
          <label for="tempatPemasaran">Lokasi Pemasaran</label>
          <input type="text" name="tempatPemasaran" value="" class="form-control" id="tempatPemasaran" placeholder="" required>
        </div>
        <div class="form-group">
          <label for="totalPeralatan">Total Peralatan atau Mesin Yang Dimiliki</label>
          <input type="text" name="totalPeralatan" value="" class="form-control" id="totalPeralatan" placeholder="" required>
        </div>
        <div class="form-group">
          <label for="totalBahanBaku">Rata-rata Total Harga Kebutuhan Bahan Baku Pertahun</label>
          <input type="text" name="totalBahanBaku" value="" class="form-control" id="totalBahanBaku" placeholder="Rp." required>
        </div>
        <div class="form-group">
          <label for="totalPekerja">Total Pekerja</label>
          <input type="text" name="totalPekerja" value="" class="form-control" id="totalPekerja" placeholder="Orang" required>
        </div>
        <div class="form-group">
          <label for="jenisBimtek">Jenis Bimtek Yang Diminati</label>
          <input type="text" name="jenisBimtek" value="" class="form-control" id="jenisBimtek" placeholder="">
        </div>
        <div class="form-group">
          <label for="permasalahan">Permasalahan Pada Usaha Yang Dihadapi Saat Ini</label>
          <textarea name="permasalahan" class="form-control" id="permasalahan" rows="2"></textarea>
        </div>
        <div class="form-group">
          <label for="jarak">Jarak Dari IKM Ke Dinas Perdagangan dan Perindustrian</label>
          <input type="text" name="jarak" value="" class="form-control" id="jarak" placeholder="Kilometer" required>
        </div>

        <button type="submit" class="btn btn-info btn-fill">Simpan Profil</button>
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
                  <h3>Kelola Profil IKM</h3>

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

                    <p>Daftar profil IKM yang telah terdaftar dan tervalidasi termasuk yang belum tervalidasi oleh staf</p>
                    <br>

                    <!-- table show daftar user yang dapat mengakses sistem -->
                    <div class="row">
                      <div class="com-md-12">
                        <div class="panel panel-default">

                          <div class="panel-heading">
                            <h5>Daftar Profil IKM
                              <a style="color:white" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-form">Tambah Profil IKM </a>
                            </h5>
                          </div>

                          <div class="panel-body" style="overflow-x:auto;">
                            <table id="staf-table" width="100%" class="table table-striped table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th width="50">ID</th>
                                  <th>Nama Usaha</th>
                                  <th>Merk Produk</th>
                                  <th>Alamat</th>
                                  <th>Jenis Produk</th>
                                  <th>Telepon</th>
                                  <th>Status</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>

                              </tbody>
                            </table>
                          </div>


                        </div>
                      </div>
                    </div>


                </div>
            </div>

    </div>


    <script type="text/javascript">
    var table;
    $(document).ready(function() {
      table = $('#staf-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('api.kelolaIkm') }}",
        columns: [
          {data: 'id', name: 'id'},
          {data: 'nama_usaha', name: 'nama_usaha'},
          {data: 'merk_produk', name: 'merk_produk'},
          {data: 'alamat', name: 'alamat'},
          {data: 'jenis_produk', name: 'jenis_produk'},
          {data: 'telpon', name: 'telpon'},
          {data: 'status', name: 'status'},
          {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
      });

    });

    function deleteData(id){
      var popup = confirm("Apakah anda yakin ingin menghapus data ini?");
      var csrf_token = $('meta[name="crsf_token"]').attr('content');
      if(popup == true){
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url : "{{ url('profil') }}" + '/' + id,
          type: "POST",
          data: {'_method': 'DELETE', '_token': csrf_token},
          success: function(data) {
            table.ajax.reload();
            console.log(data);
            alert("Data berhasil di hapus");
          },
          error: function(){
            alert("Gagal Menghapus! Terjadi kesalahan");
          }
        });
      }
    }

    function store() {

    }


    function editData(id) {
      save_method = 'edit';
      $('input[name=_method]').val('PATCH');
      urlAction = "{{ url('profil') }}";
      $('#modal-title').text('Edit Profil IKM');
      console.log(id);
      // $('#modal-form')[0].reset();
      console.log(urlAction);
      $.ajax({
        url: "{{ url('profil') }}/" + id + "/edit",
        type: "GET",
        dataType: "JSON",
        success: function(data) {

          $('#modal-form').modal('show');


          // edit action pada form menjadi format URL patch di web.php
          $("#modal-form").find("form").attr("action", urlAction + '/' + id);

          $('#id').val(data.id);
          $('#nama').val(data.nama_usaha);
          $('#lamaBerdiri').val(data.lama_berdiri);
          $('#merk').val(data.merk_produk);
          $('#alamat').val(data.alamat);
          $('#telepon').val(data.telpon);
          $('#jenisProduk').val(data.jenis_produk);
          $('#rerataProduksi').val(data.rerata_produksi);
          $('#rerataHarga').val(data.rerata_harga);
          $('#rerataPenjualan').val(data.rerata_penjualan);
          $('#tempatPemasaran').val(data.tempat_pemasaran);
          $('#totalPeralatan').val(data.total_peralatan);
          $('#totalBahanBaku').val(data.total_bahan_baku);
          $('#totalPekerja').val(data.total_pekerja);
          $('#jenisBimtek').val(data.jenis_bimtek);
          $('#permasalahan').val(data.permasalahan);
          $('#jarak').val(data.jarak);

        },
        error: function() {
          alert("Tidak ada data");
        },
      });
    }

    $(function(){
      $('#modal-form form').validator().on('submit', function (e) {
        e.preventDefault();
        var data = $('form').serialize();
        console.log("Submit dipencet");
        var form_action = $("#modal-form").find("form").attr("action");
        var nama = $("#modal-form").find("input[name='nama']").val();
        var csrf_token = $('meta[name="crsf_token"]').attr('content');
        console.log(nama);
        console.log(form_action);
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: form_action,
          type: "PATCH",
          dataType: "JSON",
          data: data,
          success: function(data) {
            table.ajax.reload();
            $(".modal").modal('hide');
            alert("Berhasil Edit Data");
          },
          error: function() {
            alert("Tidak ada data -" + nama + " - " + form_action);
          },
        });
      });
    });







    </script>

@endsection
