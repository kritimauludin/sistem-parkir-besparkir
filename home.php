<?php
include "config/koneksi.php";
date_default_timezone_set("Asia/Jakarta");
$username = $_GET['nama'];

session_start();
if(($_SESSION['role'] != "petugas")){
 // echo "<script>alert('Login Dulu Haked');document.location.href='index.php'</script>";
}

  $kode = "BP" . rand(100,999);

  $query = mysqli_query($con, "SELECT * FROM tb_daftar_parkir WHERE status=1");
  $cek_isi = mysqli_num_rows($query);
  $cek_sisa = 200-$cek_isi;

  if (isset($_GET['logout'])){
    session_destroy();

    echo "<script>document.location.href='index.php'</script>";
  }

  if (isset($_POST['btn_masuk'])) {
    
    $plat_nomor = $_POST['plat_nomor'];
    $merk = $_POST['merk'];
    $tanggal = date('Y-m-d');
    $jam_masuk = date('H:i');
    $hitung_jam_masuk = date('H');
    $jenis = $_POST['jenis'];

    $select_isi = mysqli_num_rows($query);
    if ($select_isi >= 200) {
      echo "<script>alert('Parkiran Sudah Penuh')</script>";
    }
    else{
      $sisa = 200 - $seleksi_isi;
      $cek_kode = mysqli_num_rows(mysqli_query($con, "SELECT kode FROM tb_daftar_parkir WHERE kode='$kode'"));
      $cek_plat = mysqli_num_rows(mysqli_query($con, "SELECT plat_nomor FROM tb_daftar_parkir WHERE plat_nomor='$plat_nomor'"));

      if($cek_kode>=1) {
        $kode = "BP" . rand(100,999);
      }elseif ($cek_plat>=1 ) {
        echo "<script>alert('Kendaraan Tersebut Sudah Ada di Dalam Parkiran')</script>";
      }else{
        $sql = "INSERT INTO tb_daftar_parkir(kode, plat_nomor, jenis, merk, tanggal, jam_masuk, hitung_jam_masuk, status) VALUES('$kode', '$plat_nomor', '$jenis', '$merk', '$tanggal', '$jam_masuk', '$hitung_jam_masuk', '1')";
        $query = mysqli_query($con, $sql);        
        echo "<script>document.location.href='printkarcis.php?plat_nomor=$plat_nomor'</script>";
      }
    }
  }

 ?>

<html lang="en">
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
<body style="overflow-x: hidden;" class="dashboard topnav">
      <!-- start: Header (document.location.href='printkarcis.php?plat_nomor=$plat_nomor') -->
      <?php include_once ("modul/navbar.php");?>
      <div id="content">
                <div class="col-md-6" style="margin-top: 25px;">
                  <div class="col-md-12 panel">
                    <div class="col-md-12 panel-heading bg-warning">
                      <h4 style="color: white;font-size: 20pt;">Parkir Masuk<span class="right" style="color : #f7f7f7; font-weight: bold; text-align: right; padding-right: 10px;">Tersedia : <?= $cek_sisa ?></span></h4>
                    </div>
                    <div class="col-md-12 panel-body" style="padding-bottom:25px;">
                      <div class="col-md-12">
                        <form class="cmxform" method="POST">
                          <div class="col-md-8">
                            <div class="form-group form-animate-text" style="margin-top:15px !important;">
                              <input type="text" class="form-text" name="plat_nomor" id="plat_nomor" required>
                              <span class="bar"></span>
                              <label>Plat Nomor</label>
                            </div>
                            <div class="form-group form-animate-text" style="margin-top:10px !important;">
                              <input type="text" class="form-text" name="merk" id="merk" required>
                              <span class="bar"></span>
                              <label>Merk Kendaraan</label>
                            </div>
                          </div>
                          <div class="col-md-4" style="padding-top: 10px">
                            <label><h4>Jenis Kendaraan</h4></label>
                          </div>
                          <div class="col-md-4" style="padding:5px 20px 0 25px;" name="jenis_kendaraan">
                            <div class="form-animate-radio">
                              <label class="radio">
                                <input id="radio1" type="radio" name="jenis" value="Motor" required/>
                                <span class="outer">
                                  <span class="inner bg-warning"></span>
                                </span> Motor
                              </label>
                            </div>
                            <div class="form-animate-radio">
                              <label class="radio">
                                <input id="radio2" type="radio" name="jenis" value="Mobil" required/>
                                <span class="outer">
                                  <span class="inner bg-warning"></span>
                                </span> Mobil
                              </label>
                            </div>
                          </div>
                          <input class="submit btn col-md-12" type="submit" value="Submit" style="height: 40px; background: grey; color: white;" name="btn_masuk">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
                      </form>
                    </div>
                  </div>
                </div>

                <div class="col-md-12 col-sm-12 col-x-12" style="margin-top: 20px;">
                  <div class="col-md-12 panel">
                    <div class="col-md-12 panel-heading bg-warning">
                      <h4 style="color: white;font-size: 20pt;">Daftar Kendaraan <span class="right" style="color : white; font-weight: bold; text-align: right; padding-right: 10px;">Terisi : <?= $cek_isi ?></span></h4>
                    </div>
                    <div class="panel-body">
                    <div class="table-responsive col-md-12 col-sm-12 col-xs-12">
                    <table class="table table-hover col-md-12 col-sm-12 col-xs-12" width="100%" cellspacing="0">
                    <thead>
                      <tr style="font-size: 13pt">
                        <th style="max-width: 120px;">Kode</th>
                        <th style="max-width: 200px;">Plat Nomor</th>
                        <th>Jenis</th>
                        <th>Merk</th>
                        <th style="max-width: 200px;">Jam Masuk</th>
                        <th>Tanggal</th>
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
                        <td><?php echo $data['tanggal'] ?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  </div>
                  </div>
                  </div>
                </div>
      </div>
 <script>        
    $("#kode").keyup(function(){
      var total = parseInt($("#total").val())
      var bayar = parseInt($("#bayar").val())
      
      var kembali = bayar - total;
      $("#kembali").attr("value",kembali)
      
      });

  $("#btnKeluar").on('click',function(){
    var kodeKeluar = $('#kode_keluar').val();
    $.ajax({
    url : 'config/showdata.php',
    type : 'GET',
    data : "kode=" + kodeKeluar,
    success:function(hasil){
      if(hasil != 0){
        $("#total").val(hasil);
      }else{
        alert('Masukan Kode parkir');
      }
    },
    });
  });
      </script>
</body>
</html>