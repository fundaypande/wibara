@extends('layoutPublic.public')

@section('content')

<div class="swiper-container hero-slider">
                <div class="swiper-slide hero-content-wrap" style="background-image: url('images/hero.jpg')">
                    <div class="hero-content-overlay position-absolute w-100 h-100">
                        <div class="container h-100">
                            <div class="row h-100">
                                <div class="col-12 col-lg-6 d-flex flex-column justify-content-center align-items-start">
                                    <header class="entry-header">
                                        <h1>Dinas<br>Perdagangan dan Perindustrian</h1>
                                    </header><!-- .entry-header -->

                                    <div class="entry-content mt-4">
                                        <p>Sistem Pendukung Keputusan Penentuan Prioritas Pemberian Bantuan Kepada IKM di Dinas Perdagangan dan Perindustrian Kabupaten Buleleng</p>
                                    </div><!-- .entry-content -->

                                    <footer class="entry-footer d-flex flex-wrap align-items-center mt-4">
                                        <a href="#" class="button gradient-bg">Selengkapnya</a>
                                    </footer><!-- .entry-footer -->
                                </div><!-- .col -->
                            </div><!-- .row -->
                        </div><!-- .container -->
                    </div><!-- .hero-content-overlay -->
                </div><!-- .hero-content-wrap -->

            <div class="pagination-wrap position-absolute w-100">
                <div class="swiper-pagination d-flex flex-row flex-md-column"></div>
            </div><!-- .pagination-wrap -->
        </div><!-- .hero-slider -->
    </header><!-- .site-header -->



<div class="container">
  <h2 style="margin-top: 20px">Produk-Produk IKM Buleleng</h2>
  <div class="row">


    <!-- Menampilkan beberapa hasil produksi -->
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
</div>


@endsection
