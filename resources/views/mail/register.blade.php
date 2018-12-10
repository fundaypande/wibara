<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Email Register</title>
  </head>
  <body>
    <h1>Konfirmasi Email</h1>
    <p>Untuk melakukan konfirmasi email silahkan klik link yang ada di bawah ini:</p>
    <a style="background-color: #6b9fec; color: #fff; padding: 8px 13px 8px 13px; border-radius: 5px;" href="http://localhost:8000/verify/{{$user->token}}/{{$user->id}}">Verifikasi Email </a>
  </body>
</html>
