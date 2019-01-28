@extends('layoutPublic.public')

@section('content')

<style>
  input {
    outline: none;
  }
</style>

<?php
if($data -> user -> photo == null){
  $url = 'user.png';
} else {
  $url = $data -> user -> photo;
}
?>

<div class="swiper-container hero-slider" style="    max-height: 550px;">
                <div class="swiper-slide hero-content-wrap" style="background-color: #f0f5f9">
                    <div class="hero-content-overlay position-absolute w-100 h-100">
                        <div class="container h-100" style="margin-top: 150px">

                          <header class="entry-header">
                              <h1>{{ $data -> nama_usaha }}</h1>
                          </header><!-- .entry-header -->
                          <!-- Untuk Data Barang -->
                          <div class="container">
                          <div class="row">



                          <div class="col-md-4" style="margin-right: 50px">
                            <header class="entry-header">
                                <div class="company-header-avatar" style="background-image: url({!! asset('images/' . $url) !!})"></div>
                            </header><!-- .entry-header -->


                          </div>
                          <div class="col-md-4" style="margin-top: 20px">
                            <p><b>{{ $data -> nama_usaha }}</p></b>
                            <p><b>Alamat {{ $data -> alamat }}</p></b>
                            <p><b>Telepon {{ $data -> telpon }}</p></b>
                            <p> <b> Total Produk: {{ $produksis -> count() }} </b> </p>
                          </div>
                          </div>
                          </div>




                            <div class="row h-100">
                                <div class="col-12 col-lg-6 d-flex flex-column justify-content-center align-items-start">




                                    <!-- .entry-footer -->
                                </div><!-- .col -->
                            </div><!-- .row -->
                        </div><!-- .container -->
                    </div><!-- .hero-content-overlay -->
                </div><!-- .hero-content-wrap -->

        </div><!-- .hero-slider -->
    </header><!-- .site-header -->



<div class="container">

  <div class="row">
    <h2 style="margin-top: 30px">Produk {{ $data -> nama_usaha }}</h2>
    <br>
    <div class="container">
      <div class="row">

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


        @foreach ($produksis as $produksi)

        <?php
        if($produksi -> photo == null){
          $url = 'user.png';
        } else {
          $url = $produksi -> photo;
        }
        ?>

          <div class="col-sm-3">
            <a href="/produk/{{ $produksi -> id }}">
              <div class="produk-card">
                <div class="produk-images">
                  <div class="produksi-tumb" style="background-image: url({!! asset('images/produksi/' . $url) !!})"></div>
                </div>
                <div class="produk-caption">
                  <p>{{ $produksi -> jenis_produksi }}</p>
                </div>
              </div>
            </a>
          </div>

        @endforeach

      </div>
      <div class="" style="display: flex; align-items: center; justify-content: center; margin-top: 60px;">
        {{ $produksis->links() }}
      </div>




    </div>
  </div>
</div>


@endsection
