<!DOCTYPE html>
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
  <link rel="stylesheet" href="asset/css/style.css">
  <link rel="shortcut icon" href="asset/img/logo.png">
</head>
<?php
include "config/koneksi.php";
date_default_timezone_set("Asia/Jakarta");
$username = $_GET['nama'];

session_start();
if(($_SESSION['role'] != "petugas")){
  echo "<script>alert('Login Dulu Haked');document.location.href='index.php'</script>";
}

  $kode = "BP" . rand(100,999);

  $query = mysqli_query($con, "SELECT * FROM tb_daftar_parkir");
  $cek_isi = mysqli_num_rows(mysqli_query($con, "SELECT * FROM tb_daftar_parkir WHERE status=1"));
  $cek_sisa = 200-$cek_isi;

  if (isset($_GET['logout'])){
    session_destroy();

    echo "<script>document.location.href='index.php'</script>";
  }
 ?>

<body style="overflow-x: hidden;" class="dashboard topnav">
        <?php include_once ("modul/navbar.php");?>                                                              
      <div id="content">
              <div class="col-md-6" style="margin-top: 17px;">
                  <div class="col-md-10 panel">
                    <div class="col-md-12 panel-heading bg-warning ">
                      <h4 style="color: white;font-size: 20pt;">Parkir Keluar</h4>
                    </div>
                    <div class="col-md-12 panel-body" style="padding-bottom:25px;">
                      <div class="col-md-12">
                        <form class="cmxform" method="POST" action="proses.php">
                          <div class="col-md-12">
                            <div class="form-group form-animate-text" style="margin-top:25px !important;">
                              <input type="text" class="form-text" name="kode" id="kode_keluar" required>
                              <span class="bar"></span>
                              <label>Masukan Kode</label>
                            </div>
                          </div>
                          <input class="btn bg-warning col-md-12" type="button" value="Go" data-toggle ="modal" data-target="#myModal" style="height: 40px; color: white;" id="btnKeluar">
                          <!-- Modal -->
                          <div class="col-md-12">
                                <div class="modal fade modal-v1" id="myModal">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                      <form action="proses.php" method="post" enctype="multipart/form-data">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h2 class="modal-title">
                                          <img src="asset/img/logo.png" class="img-circle" alt="logo" style="margin-top: -10px;" width="45px"/>
                                          Keluar Parkir
                                        </h2>
                                      </div>
                                      <div class="modal-body" style="padding-bottom: 10px; text-align: center;">
                                        <h3 id="kode">
                                            <div class="form-group">
                                                <div class="col-lg-12">
                                                <input type="text" align="center" class="form-control android" name="total" id="total" readonly>
                                              </div>
                                              <div class="col-lg-12">
                                                <input type="text" class="form-control android" name="bayar" id="bayar" placeholder="BAYAR">
                                              </div>
                                            <div class="col-lg-12">
                                                <input type="text" class="form-control android" name="kembali" id="kembali" placeholder="kembali" readonly>
                                              </div>
                                          </div>
                                          </h3>
                                          <input class="btn bg-warning" type="submit"  value="Go" name="btn_Keluar" style="margin: 20px 17px 0 0; height: 40px; font-weight: bold; color: white;">
                                        </div>
                                      <div class="modal-footer">
                                      </div>
                                      </form>
                                    </div><!-- /.modal-content -->
                                  </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                            </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
               <div class="col-md-12 col-sm-12 col-x-12" style="margin-top: 20px;">
                  <div class="col-md-12 panel">
                    <div class="col-md-12 panel-heading bg-warning ">
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
        alert('hasil');
      }
    },
    });
  });
</script>
</body>
</html>