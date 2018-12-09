<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Email Register</title>
  </head>
  <body>
    <h1>Konfirmasi Email</h1>
    <a href="http://localhost:8000/verify/{{$users->token}}/{{$users->id}}">Verifikasi Email </a>
  </body>
</html>
