<li class="active">
    <a title="Landing Page" href="events.html" aria-expanded="false"><span style="color: #8d9498" class="fa fa-home icon-wrap" aria-hidden="true"></span> <span class="mini-click-non">Beranda</span></a>
</li>
@if(Auth::user() -> role == '3')
  <li>
      <a class="has-arrow aktif" href="/home" aria-expanded="false"><span style="color: #8d9498" class="fa fa-university icon-wrap" aria-hidden="true"></span> <span class="mini-click-non">Admin</span></a>
  </li>
  <li>
      <a class="has-arrow" href="/kelola-staf" aria-expanded="false"><span style="color: #8d9498" class="fa fa-university icon-wrap" aria-hidden="true"></span> <span class="mini-click-non">Kelola Staf</span></a>
  </li>
@endif
<li>
    <a class="has-arrow" href="all-students.html" aria-expanded="false"><span style="color: #8d9498" class="fa fa-bar-chart icon-wrap"></span> <span class="mini-click-non">Staf</span></a>
</li>
<li>
    <a class="has-arrow" href="all-courses.html" aria-expanded="false"><span style="color: #8d9498" class=" fa fa-calendar-times-o icon-wrap"></span> <span class="mini-click-non">Users</span></a>
</li>
<li>
    <a class="has-arrow" href="all-courses.html" aria-expanded="false"><span style="color: #8d9498" class=" fa fa-envelope-open icon-wrap"></span> <span class="mini-click-non">Library</span></a>
</li>
<li>
    <a class="has-arrow" href="all-courses.html" aria-expanded="false"><span style="color: #8d9498" class="  icon-wrap"></span> <span class="mini-click-non">Departments</span></a>
</li>
<li>
    <a class="has-arrow" href="mailbox.html" aria-expanded="false"><span class="  educate-message icon-wrap"></span> <span class="mini-click-non">Mailbox</span></a>
</li>
<li>
    <a class="has-arrow" href="mailbox.html" aria-expanded="false"><span class="  educate-interface icon-wrap"></span> <span class="mini-click-non">Interface</span></a>
</li>
<li>
    <a class="has-arrow" href="mailbox.html" aria-expanded="false"><span class="  educate-charts icon-wrap"></span> <span class="mini-click-non">Charts</span></a>
</li>

<script type="text/javascript">
  var currentURL = $(location).attr("href"); //get all url
  var base_url = window.location.origin; //get base url ('http://localhost.com')

  currentURL = currentURL.replace(base_url, '');
  $("li").find('a[href="'+ currentURL +'"]').parent().addClass('active');

</script>
