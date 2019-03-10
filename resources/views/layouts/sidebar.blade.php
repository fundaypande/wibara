<li class="active">
    <a title="Landing Page" href="/home" aria-expanded="false"><span style="color: #8d9498" class="fa fa-home icon-wrap" aria-hidden="true"></span> <span class="mini-click-non">Home</span></a>
</li>
@if(Auth::user() -> role == '0')
  <li>
      <a class="has-arrow" href="/indicators" aria-expanded="false"><span style="color: #8d9498" class="fa fa-users icon-wrap" aria-hidden="true"></span> <span class="mini-click-non">Indicators</span></a>
  </li>
  <li>
      <a class="has-arrow" href="/users" aria-expanded="false"><span style="color: #8d9498" class="fa fa-users icon-wrap" aria-hidden="true"></span> <span class="mini-click-non">Users</span></a>
  </li>
@endif

@if(Auth::user() -> role == '1')
<li>
    <a class="has-arrow" href="{{ url('/weight') }}" aria-expanded="false"><span style="color: #8d9498" class=" fa fa-bar-chart icon-wrap"></span> <span class="mini-click-non">Weight</span></a>
</li>
<li>
    <a class="has-arrow" href="{{ url('/form') }}" aria-expanded="false"><span style="color: #8d9498" class=" fa fa-bar-chart icon-wrap"></span> <span class="mini-click-non">Form</span></a>
</li>
@endif


<script type="text/javascript">
    var currentURL = $(location).attr("href"); //get all url
    var base_url = window.location.origin; //get base url ('http://localhost.com')

    currentURL = currentURL.replace(base_url, '');
    $("li").find('a[href="'+ currentURL +'"]').parent().css("background-color","#f5f8fa");

</script>
