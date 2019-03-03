<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dinas Perdagangan dan Perindustrian Kabupaten Buleleng</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="shortcut icon" href="{!! asset('images/buleleng-kecil.png') !!}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS {!! asset('css/sweetalert2.css') !!} -->
    <link rel="stylesheet" href="{!! asset('css/bootstrap.min.css') !!}">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{!! asset('css/pande.css') !!}">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="{!! asset('css/swiper.min.css') !!}">

    <!-- Styles -->
    <link rel="stylesheet" href="{!! asset('style.css') !!}" >
    <script src="{!! asset('js/custom.js') !!}"></script>
</head>
<body>
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v3.2&appId=639432712764394&autoLogAppEvents=1';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>

    <header class="site-header">
        <div class="nav-bar">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
                        <div class="site-branding d-flex align-items-center">
                           <a class="d-block" href="{{ url('/') }}" rel="home"><img class="d-block" src="{!! asset('images/buleleng-kecil.png') !!}" alt="logo"></a>
                        </div><!-- .site-branding -->

                        <nav class="site-navigation d-flex justify-content-end align-items-center">
                            <ul class="d-flex flex-column flex-lg-row justify-content-lg-end align-items-center">
                                <!-- <li class="current-menu-item"><a href="/">Beranda</a></li> -->
                                <li><a href="/">Beranda</a></li>
                                <li><a href="/produk">Produk IKM</a></li>
                                <li><a href="/tentang">Tentang Kami</a></li>

                                @if (Route::has('login'))
                                        @auth
                                            <li><a href="{{ url('/home') }}">{{ Auth::user()->name }}</a></li>
                                        @else
                                            <li><a href="{{ route('login') }}">Login</a></li>

                                            <!-- @if (Route::has('register'))
                                                <li><a href="{{ route('register') }}">Register</a></li>
                                            @endif -->
                                        @endauth
                                    </div>
                                @endif

                            </ul>
                        </nav><!-- .site-navigation -->

                        <div class="hamburger-menu d-lg-none">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div><!-- .hamburger-menu -->
                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .nav-bar -->


        <script type="text/javascript">
          $(document).ready(function() {
            var currentURL = $(location).attr("href"); //get all url
            var base_url = window.location.origin; //get base url ('http://localhost.com')
            alert(base_url);
            currentURL = currentURL.replace(base_url, '');
            $("li").find('a[href="'+ currentURL +'"]').parent().css("color","#f5f8fa");
          });
        </script>
