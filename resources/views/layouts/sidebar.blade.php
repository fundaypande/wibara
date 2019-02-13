<li class="active">
    <a title="Landing Page" href="/home" aria-expanded="false"><span style="color: #8d9498" class="fa fa-home icon-wrap" aria-hidden="true"></span> <span class="mini-click-non">Beranda</span></a>
</li>
@if(Auth::user() -> role == '3')
  <li>
      <a class="has-arrow" href="/kelola-ikm" aria-expanded="false"><span style="color: #8d9498" class="fa fa-user icon-wrap" aria-hidden="true"></span> <span class="mini-click-non">Data IKM</span></a>
  </li>
  <li>
      <a class="has-arrow" href="/komoditi" aria-expanded="false"><span style="color: #8d9498" class="fa fa-shopping-bag icon-wrap" aria-hidden="true"></span> <span class="mini-click-non">Komoditi</span></a>
  </li>
  <li>
      <a class="has-arrow" href="/kriteria" aria-expanded="false"><span style="color: #8d9498" class="fa fa-filter icon-wrap" aria-hidden="true"></span> <span class="mini-click-non">Kriteria</span></a>
  </li>
  <li>
      <a class="has-arrow" href="/kriteria-ahp" aria-expanded="false"><span style="color: #8d9498" class="fa fa-crosshairs icon-wrap" aria-hidden="true"></span> <span class="mini-click-non">Pembobotan</span></a>
  </li>
  <li>
      <a class="has-arrow" href="/perangkingan" aria-expanded="false"><span style="color: #8d9498" class="fa fa-list-ol icon-wrap" aria-hidden="true"></span> <span class="mini-click-non">Perangkingan</span></a>
  </li>
  <li>
      <a class="has-arrow" href="/penerima" aria-expanded="false"><span style="color: #8d9498" class="fa fa-users icon-wrap" aria-hidden="true"></span> <span class="mini-click-non">Penerima</span></a>
  </li>
  <li>
      <a class="has-arrow" href="/pemetaan" aria-expanded="false"><span style="color: #8d9498" class="fa fa-users icon-wrap" aria-hidden="true"></span> <span class="mini-click-non">Pemetaan IKM</span></a>
  </li>
  <li>
      <a class="has-arrow" href="/kelola-staf" aria-expanded="false"><span style="color: #8d9498" class="fa fa-university icon-wrap" aria-hidden="true"></span> <span class="mini-click-non">Kelola Staf</span></a>
  </li>
@endif

@if(Auth::user() -> role == '1')
<!-- <li>
    <a class="has-arrow" href="/profil" aria-expanded="false"><span style="color: #8d9498" class="fa fa-user icon-wrap"></span> <span class="mini-click-non">Profile IKM</span></a>
</li>
<li>
    <a class="has-arrow" href="/produksi" aria-expanded="false"><span style="color: #8d9498" class="fa fa-shopping-basket icon-wrap"></span> <span class="mini-click-non">Produksi</span></a>
</li>
<li>
    <a class="has-arrow" href="/peralatan" aria-expanded="false"><span style="color: #8d9498" class="fa fa-suitcase icon-wrap"></span> <span class="mini-click-non">Peralatan</span></a>
</li>
<li>
    <a class="has-arrow" href="/bahan" aria-expanded="false"><span style="color: #8d9498" class="fa fa-flask icon-wrap"></span> <span class="mini-click-non">Bahan Baku</span></a>
</li> -->
<li>
    <a class="has-arrow" href="{{ url('/evaluasi') }}" aria-expanded="false"><span style="color: #8d9498" class=" fa fa-bar-chart icon-wrap"></span> <span class="mini-click-non">Evaluasi</span></a>
</li>
@endif

@if(Auth::user() -> role == '2')
<li>
    <a class="has-arrow" href="/kelola-ikm" aria-expanded="false"><span style="color: #8d9498" class="fa fa-users icon-wrap"></span> <span class="mini-click-non">Kelola Profil IKM</span></a>
</li>
<!-- <li>
    <a class="has-arrow" href="/validasi" aria-expanded="false"><span style="color: #8d9498" class="fa fa-check-circle icon-wrap"></span> <span class="mini-click-non">Validasi IKM</span></a>
</li> -->
@endif

<script type="text/javascript">
    var currentURL = $(location).attr("href"); //get all url
    var base_url = window.location.origin; //get base url ('http://localhost.com')

    currentURL = currentURL.replace(base_url, '');
    $("li").find('a[href="'+ currentURL +'"]').parent().css("background-color","#f5f8fa");

</script>
