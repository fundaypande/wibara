@extends('layouts.admin')

@section('content')

<div id="modal-form" class="modal fade" role="dialog" tabindex="1" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Role</h4>
      </div>
      <div class="modal-body">
        <form method="post" data-toggle="validator">
          {{ csrf_field() }} {{ method_field('POST') }}
        <input type="hidden" name="id" id="id" value="">
        <div class="form-group">
          <label for="email">Email address:</label>
          <input type="email" class="form-control" id="email" disabled>
        </div>
        <div class="form-group">
          <label for="role">Role</label>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="radio" id="radioAdmin" value="3">
            <label class="form-check-label" for="exampleRadios1">
              Admin
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="radio" id="radioStaf" value="2">
            <label class="form-check-label" for="exampleRadios2">
              Staf
            </label>
          </div>
        </div>
        <br>

        <button type="submit" class="btn btn-primary">Submit</button>
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
                  <h3>Kelola Profil IKM @if (Auth::user()->profilIkm->status == 1)
                    <i style="color:green; font-size: 24px;" class="fa fa-check-circle" aria-hidden="true"></i>
                  @endif</h3>


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

                    <p>Masukkan data profil IKM anda. Data yang dimasukkan tidak boleh bernilai nol (0) atau kurang dari satu (1) untuk menghindari kesalahan</p>
                    <br>

                    <form action="/profil/{{ Auth::user()->profilIkm->id }}" method="POST">
                      {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                      <label for="nama">Nama Usaha</label>
                      <input type="text" name="nama" value="{{ Auth::user()->profilIkm->nama_usaha }}" class="form-control" id="nama" required placeholder="">
                    </div>
                    <div class="form-group">
                      <label for="lamaBerdiri">Lama Berdirinya Usaha</label>
                      <input min="1" type="number" name="lamaBerdiri" value="{{ Auth::user()->profilIkm->lama_berdiri }}" class="form-control" id="lamaBerdiri" required placeholder="4 tahun">
                    </div>
                    <div class="form-group">
                      <label for="merk">Merk Produk</label>
                      <input type="text" name="merk" value="{{ Auth::user()->profilIkm->merk_produk }}" class="form-control" id="merk" placeholder="" required>
                    </div>
                    <div class="form-group">
                      <label for="alamat">Alamat</label>
                      <textarea name="alamat" class="form-control" id="alamat" rows="2" required>{{ Auth::user()->profilIkm->alamat }}</textarea>
                    </div>
                    <div class="form-group">
                      <label for="telepon">Telepon</label>
                      <input type="tel" pattern="^\d{12}$" name="telepon" value="{{ Auth::user()->profilIkm->telpon }}" class="form-control" id="telepon" placeholder="" required>
                    </div>
                    <div class="form-group">
                      <label for="jenisProduk">Jenis Produk</label>
                      <input type="text" name="jenisProduk" value="{{ Auth::user()->profilIkm->jenis_produk }}" class="form-control" id="jenisProduk" placeholder="" required>
                    </div>
                    <div class="form-group">
                      <label for="rerataProduksi">Rata-rata Produksi Perbulan</label>
                      <input type="text" name="rerataProduksi" value="{{ Auth::user()->profilIkm->rerata_produksi }}" class="form-control" id="rerataProduksi" placeholder="pcs" required>
                    </div>
                    <div class="form-group">
                      <label for="rerataHarga">Rata-rata Harga Produk</label>
                      <input type="text" name="rerataHarga" value="{{ Auth::user()->profilIkm->rerata_harga }}" class="form-control" id="rerataHarga" placeholder="Rp." required>
                    </div>
                    <div class="form-group">
                      <label for="rerataPenjualan">Rata-rata Hasil Penjualan Pertahun</label>
                      <input type="text" name="rerataPenjualan" value="{{ Auth::user()->profilIkm->rerata_penjualan }}" class="form-control" id="rerataPenjualan" placeholder="Rp." required>
                    </div>
                    <div class="form-group">
                      <label for="tempatPemasaran">Lokasi Pemasaran</label>
                      <input type="text" name="tempatPemasaran" value="{{ Auth::user()->profilIkm->tempat_pemasaran }}" class="form-control" id="tempatPemasaran" placeholder="" required>
                    </div>
                    <div class="form-group">
                      <label for="totalPeralatan">Total Peralatan atau Mesin Yang Dimiliki</label>
                      <input type="text" name="totalPeralatan" value="{{ Auth::user()->profilIkm->total_peralatan }}" class="form-control" id="totalPeralatan" placeholder="" required>
                    </div>
                    <div class="form-group">
                      <label for="totalBahanBaku">Rata-rata Total Harga Kebutuhan Bahan Baku Pertahun</label>
                      <input type="text" name="totalBahanBaku" value="{{ Auth::user()->profilIkm->total_bahan_baku }}" class="form-control" id="totalBahanBaku" placeholder="Rp." required>
                    </div>
                    <div class="form-group">
                      <label for="totalPekerja">Total Pekerja</label>
                      <input type="text" name="totalPekerja" value="{{ Auth::user()->profilIkm->total_pekerja }}" class="form-control" id="totalPekerja" placeholder="Orang" required>
                    </div>
                    <div class="form-group">
                      <label for="jenisBimtek">Jenis Bimtek Yang Diminati</label>
                      <input type="text" name="jenisBimtek" value="{{ Auth::user()->profilIkm->jenis_bimtek }}" class="form-control" id="jenisBimtek" placeholder="">
                    </div>
                    <div class="form-group">
                      <label for="permasalahan">Permasalahan Pada Usaha Yang Dihadapi Saat Ini</label>
                      <textarea name="permasalahan" class="form-control" id="permasalahan" rows="2">{{ Auth::user()->profilIkm->permasalahan }}</textarea>
                    </div>
                    <div class="form-group">
                      <label for="jarak">Jarak Dari IKM Ke Dinas Perdagangan dan Perindustrian</label>
                      <input type="text" name="jarak" value="{{ Auth::user()->profilIkm->jarak }}" class="form-control" id="jarak" placeholder="Kilometer" required>
                    </div>

                    <button type="submit" class="btn btn-info btn-fill pull-right">Simpan Profil</button>

                  </form>




                </div>
            </div>

    </div>


<script src="{{ asset('js/rupiah.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    rupiah($('#lamaBerdiri'));
    rupiah($('#rerataProduksi'));
    rupiah($('#rerataHarga'));
    rupiah($('#rerataPenjualan'));
    rupiah($('#totalBahanBaku'));
    rupiah($('#totalPeralatan'));
    rupiah($('#totalPekerja'));
    rupiah($('#jarak'));
  });
</script>

@endsection
