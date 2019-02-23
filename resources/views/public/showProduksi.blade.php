@extends('layoutPublic.public')

@section('content')

<style>
  input {
    outline: none;
  }
</style>


<div class="swiper-container hero-slider" style="    max-height: 500px;">
                <div class="swiper-slide hero-content-wrap" style="background-color: #f0f5f9">
                    <div class="hero-content-overlay position-absolute w-100 h-100">
                        <div class="container h-100">
                            <div class="row h-100">
                                <div class="col-12 col-lg-6 d-flex flex-column justify-content-center align-items-start">
                                    <header class="entry-header" style="    margin-top: -100px;">
                                        <h1>Cari Produk IKM</h1>
                                    </header><!-- .entry-header -->

                                    <form method="post" style="width: 100%;" action="/produk/search">
                                      {{ csrf_field() }}
                                      <input style="outline: none;" type="text" class="produk-search" name="cari" placeholder="Search">
                                      <footer class="entry-footer d-flex flex-wrap align-items-center mt-4">
                                          <button type="submit" class="button gradient-bg">Temukan</button>
                                      </footer>
                                    </form>

                                    <!-- .entry-footer -->
                                </div><!-- .col -->
                            </div><!-- .row -->
                        </div><!-- .container -->
                    </div><!-- .hero-content-overlay -->
                </div><!-- .hero-content-wrap -->

        </div><!-- .hero-slider -->
    </header><!-- .site-header -->



<div class="container">
  @if ($cari)
  <div class="alert alert-primary" style="margin-top: 20px">
    <p>Hasil Pencarian "{{ $cari }}"</p>
  </div>
  @endif

  <div class="row">
    <h2 style="margin-top: 30px">Produk IKM Buleleng</h2>
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
