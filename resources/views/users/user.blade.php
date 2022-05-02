<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
</head>
<body>
     
     <form method="POST">
     @csrf
          <label for="nama">Nama: </label>
          <input type="input" name="nama" id="nama" >
          <br>
          <label for="alamat">Alamat: </label>
          <input type="input" name="alamat" id="alamat" >
          <br>
          <label for="noTelp">No Telp: </label>
          <input type="input" name="noTelp" id="noTelp" >
          <br>
          <label for="noHp">No Hp: </label>
          <input type="input" name="noHp" id="noHp" >
          <br>
          <label for="jabatan">Jabatan</label>
          <input type="input" name="jabatan" id="jabatan" >
          <br>
          <label for="namaPerusahaan">Nama Perusahaan</label>
          <input type="input" name="namaPerusahaan" id="namaPerusahaan" >
          <br>
          <label for="alamatPerusahaan">Alamat Perusahaan</label>
          <input type="input" name="alamatPerusahaan" id="alamatPerusahaan" >
          <br>
          <label for="noTelpPerusahaan">No Telp Perusahaan</label>
          <input type="input" name="noTelpPerusahaan" id="noTelpPerusahaan" >
          <br>
          <label for="npwpd">Npwpd</label>
          <input type="input" name="npwpd" id="npwpd" >
          <br>
          <label for="email">Email</label>
          <input type="input" name="email" id="email" >
          <br>
          <label for="password">Password</label>
          <input type="input" name="password" id="password" >
          <br>
          <button type="submit">
               Submit
          </button>
     </form>
</body>
</html>