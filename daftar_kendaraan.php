<?php
  include "config/koneksi.php";
  $username = $_GET['nama'];
  $cek_isi = mysqli_num_rows(mysqli_query($con, "SELECT * FROM tb_daftar_parkir WHERE status=1"));
  $cek_mobil = mysqli_num_rows(mysqli_query($con, "SELECT * FROM tb_daftar_parkir WHERE jenis ='Mobil' && status=1"));
  $cek_motor = mysqli_num_rows(mysqli_query($con, "SELECT * FROM tb_daftar_parkir WHERE jenis ='Motor' && status=1"));
   ?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Parkir Online</title>
  <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">
  <script type="text/javascript" src="asset/js/jquery.min.js"></script>
  <script type="text/javascript" src="asset/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/font-awesome.min.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/animate.min.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/nouislider.min.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/select2.min.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/ionrangeslider/ion.rangeSlider.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/ionrangeslider/ion.rangeSlider.skinFlat.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/bootstrap-material-datetimepicker.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/simple-line-icons.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/mediaelementplayer.css"/>
  <link href="asset/css/style.css" rel="stylesheet">
  <link rel="shortcut icon" href="asset/img/logo.png">
</head>
<body class="dashboard topnav">
        <?php include_once ("modul/navbar.php");?>
      <div id="content">
          <div class="col-md-6 col-sm-6 col-xs-12"  style="margin-top: 30px;">
                  <div class="col-md-12 panel">
                    <div class="col-md-12 panel-heading bg-warning">
                      <h4 style="color: white;font-size: 20pt;">History</h4>
                    </div>
                    <div class="panel-body">
                    <div class="table-responsive col-md-12 col-sm-12 col-xs-12">
                    <table class="table" width="100%" cellspacing="0">
                    <thead>
                      <tr style="font-size: 13pt">
                        <th style="max-width: 120px;">Kode</th>
                        <th style="max-width: 250px;">Plat Nomor</th>
                        <th>Jenis</th>
                        <th>Merk</th>
                        <th style="max-width: 200px;">Jam Masuk</th>
                        <th style="max-width: 200px;">Jam Keluar</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $sql = "SELECT * FROM tb_daftar_parkir WHERE status = '0'";
                        $query = mysqli_query($con, $sql);

                        while ($data = mysqli_fetch_array($query)) {?>
                      <tr style="font-size: 11pt">
                        <td><?php echo $data['kode'] ?></td>
                        <td><?php echo $data['plat_nomor'] ?></td>
                        <td><?php echo $data['jenis'] ?></td>
                        <td><?php echo $data['merk'] ?></td>
                        <td><?php echo $data['jam_masuk'] . " WIB" ?></td>
                        <td><?php echo $data['jam_keluar'] . " WIB" ?></td>
                        <td class="btn-group"><a href="hapus_data.php?id=<?php echo $data['kode']; ?>" class="btn btn-xs btn-danger" onclick="return confirm('Yakin data ini akan dihapus?');">Hapus</a></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  </div>
                  </div>
                  </div>
                </div>
            </div>
                <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top: 20px;">
                  <div class="col-md-6 panel">
                    <div class="col-md-12 panel-heading bg-warning">
                      <span class="border border-secondary"></span>
                      <h4 style="color: white;font-size: 20pt;">Jumlah Motor</h4>
                    </div>
                    <div class="panel-body" style="text-align: center;font-size: 64pt;">
                      <?= $cek_motor ?>
                  </div>
                  </div>

                  <div class="col-md-6 panel">
                    <div class="col-md-12 panel-heading bg-warning">
                      <h4 style="color: white;font-size: 20pt;">Jumlah Mobil</h4>
                    </div>
                    <div class="panel-body" style="text-align: center;font-size: 64pt;">
                      <?= $cek_mobil ?>
                  </div>
                  </div>

                <div class="col-md-12 panel">
                    <div class="col-md-12 panel-heading bg-warning">
                      <h4 style="color: white;font-size: 20pt;">Daftar Kendaraan <span class="right" style="color : white; font-weight: bold; text-align: right; padding-right: 10px;">Terisi : <?= $cek_isi ?></span></h4>
                    </div>
                    <div class="panel-body">
                    <div class="table-responsive col-md-12 col-sm-12 col-xs-12">
                    <table class="table table-hover" width="100%" cellspacing="0">
                    <thead>
                      <tr style="font-size: 13pt">
                        <th style="max-width: 120px;">Kode</th>
                        <th style="max-width: 250px;">Plat Nomor</th>
                        <th>Jenis</th>
                        <th>Merk</th>
                        <th style="max-width: 200px;">Jam Masuk</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $sql = "SELECT * FROM tb_daftar_parkir WHERE status = '1'";
                        $query = mysqli_query($con, $sql);
                        while ($data = mysqli_fetch_array($query)) {?>
                      <tr style="font-size: 11pt">
                        <td><?php echo $data['kode'] ?></td>
                        <td><?php echo $data['plat_nomor'] ?></td>
                        <td><?php echo $data['jenis'] ?></td>
                        <td><?php echo $data['merk'] ?></td>
                        <td><?php echo $data['jam_masuk'] . " WIB" ?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  </div>
                  </div>
                  </div>
                </div>
</body>
</html>