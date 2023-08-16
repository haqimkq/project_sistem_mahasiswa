<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- <!DOCTYPE html>
<html lang="en">
<body>
	<div id="container">
		<div>
			<h1>Dashboard Ijazah dan Transkrip</h1>
		</div>
	</div>

</body>
</html> -->






<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- <link rel="stylesheet" href="style.css" /> -->
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        display: block;
        margin-left: auto;
        margin-right: auto;
        /* margin-top: 20px; */
        width: 80%;
        height: auto;
        padding: 50px;
      }

      .judul {
        text-align: center;
        margin: 100px auto 50px auto;
      }
      .table {
        display: flex;
        justify-content: center;
      }
      .table tr td:nth-child(2) {
        padding-left: 50px;
      }
      .table tr td:nth-child(3) {
        padding-left: 10px;
      }

      .nolist {
        /* border: 1px dotted red; */
        list-style: none;
        display: flex;
        gap: 10px;
      }

      .nav-nomor {
        display: flex;
        justify-content: space-between;
      }

      .keterangan {
        text-align: justify;
        margin-top: 30px;
      }

      .ttd {
        height: 200px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-template-rows: auto 1fr;
        grid-gap: 10px;
        text-align: center;
        margin-top: 50px;
      }

      .ttd-2 div:nth-child(2),
      .ttd-3 div:nth-child(2) {
        margin-top: 100px;
      }

      .ttd-1 {
        grid-row: 1/2;
        grid-column: 2/2;
      }
      .ttd-2 {
        grid-row: 2/2;
        grid-column: 1/2;
      }
      .ttd-3 {
        grid-row: 2/2;
        grid-column: 2/2;
      }
    </style>
  </head>
  <body>
    <div class="nav-nomor">
      <ul class="nolist">
        <li>No seri :</li>
        <li>123</li>
      </ul>
      <ul class="nolist">
        <li>No Ijazah :</li>
        <li>321</li>
      </ul>
    </div>

    <div class="judul">
      <h1>Ijazah</h1>
    </div>
    <div class="table">
      <table>
        <tr>
          <td>Memberikan Ijazah Kepada</td>
          <td>:</td>
          <td>Nohara Sinosuke</td>
        </tr>
        <tr>
          <td>Tempat dan Tanggal Lahir</td>
          <td>:</td>
          <td>Bogor, 25 November 1985</td>
        </tr>
        <tr>
          <td>Nomor Taruna</td>
          <td>:</td>
          <td>321</td>
        </tr>
        <tr>
          <td>Program Pendidikan</td>
          <td>:</td>
          <td>DIPLOMA III</td>
        </tr>
        <tr>
          <td>Program Studi</td>
          <td>:</td>
          <td>ILMU KOMPUTER</td>
        </tr>
        <tr>
          <td>Status</td>
          <td>:</td>
          <td>TERAKREDITASI "BAIK SEKALI"</td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td>Berdasarkan Keputusan BAN-PT No.321</td>
        </tr>
      </table>
    </div>
    <div class="keterangan">
      <p>
        Ijazah ini diserahkan berdasarkan Surat Keputusan Direktur Politeknik
        XYZNomor:SK.321 Tahun 2022 setelah yang bersangkutan memenuhi semua
        persyaratan yang telah ditentukan dan kepadanya dilimpahkan segala
        wewenang dan hak yang berhubungan dengan Ijazah yang dimilikinya serta
        berhak menggunakan Gelar Akademik Ahli Madya Komputer (A.Md).
      </p>
    </div>
    <div class="ttd">
      <div class="ttd-1">
        <p>Jakarta, 24 Agustus 2022</p>
      </div>
      <div class="ttd-2">
        <div>
          <p>WAKIL DIREKTUR I</p>
          <p>POLITEKNIK XYZ</p>
        </div>
        <div>
          <p>Nobita Nobi</p>
          <p>NIP.123</p>
        </div>
      </div>
      <div class="ttd-3">
        <div>
          <p>DIREKTUR</p>
          <p>POLITEKNIK XYZ</p>
        </div>
        <div>
          <p>Suneo</p>
          <p>NIP.321</p>
        </div>
      </div>
    </div>
  </body>
</html>
