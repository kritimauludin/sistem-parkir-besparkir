<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Parkir Online</title>
	<link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">
	<script type="text/javascript" src="asset/js/jquery.min.js"></script>
	<script type="text/javascript" src="asset/js/bootstrap.min.js"></script>
  <script src="datepicker/datepicker.js"></script>
  <link rel="stylesheet" type="text/css" href="datepicker/datepicker.css"/>
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
<?php 
include 'config/koneksi.php';
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();

    echo "<script>document.location.href='index.php'</script>";
  }

  if (isset($_POST['btn_print'])) {
  	echo "<script>location.href='print/datakeuangan.php'</script";
  }
 ?>

<body class="dashboard topnav">
  <?php include_once ("modul/navbaradmin.php");?>
	<div id="content">
 <?php
            $Open = mysql_connect("localhost","root","");
                if (!$Open){
                die ("Koneksi ke MySQL Gagal !");
                }
            $Koneksi = mysql_select_db("db_parkir");
                if (!$Koneksi){
                die ("Koneksi ke Database Gagal !");
                }
        ?>
        <form action="data_keuangan.php" method="post" name="postform">
             <div class="col-md-12 col-sm-12 col-x-12" style="margin-top: 30px; height: auto;">
                  <div class="col-md-12 panel">
                    <div class="col-md-12 panel-heading bg-warning">
                      <h4 style="color: white;font-size: 20pt;">Cari Data Keuangan</h4>
                    
            <table class="table table-responsive col-lg-4 col-md-6 col-sm-6 col-x-10" width="100%" cellspacing="0" style="color : white;">
                    <th width="10" align="center"><b>Dari Tanggal</b></th>
                    <th style="color: black;" colspan="2" width="10">: <input type="text" class="datepicker" name="tanggal_awal" size="12" />
                    <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.postform.tanggal_awal);return false;" ></a>                
                    </th>
                    <th width="10" align="center"><b>Sampai Tanggal</b></th>
                    <th style="color: black;" colspan="2" width="10">: <input type="text" class="datepicker" name="tanggal_akhir" size="12" />
                    <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.postform.tanggal_akhir);return false;" ></a>                
                    </th>
                    <th colspan="2" width="50"><input class="submit btn btn-white " type="submit" value="Cari" style="height: 40px color: black; border-radius: 5px;" name="pencarian"></th>
            </table>
            </div>
            </div>
        </form><br />
        <div class="panel-body bg-white">
        <div class="table-responsive col-md-12 col-sm-12 col-xs-12">
        <p>
        <?php
            if(isset($_POST['pencarian'])){
            $tanggal_awal=$_POST['tanggal_awal'];
            $tanggal_akhir=$_POST['tanggal_akhir'];
            if(empty($tanggal_awal) || empty($tanggal_akhir)){
            ?>
            <script language="JavaScript">
                alert('Tanggal Awal dan Tanggal Akhir Harap di Isi!');
                document.location='data_keuangan.php';
            </script>
            <?php
            }else{
            ?><i>Hasil data dari Tanggal <b><?php echo $_POST['tanggal_awal']?></b> s/d <b><?php echo $_POST['tanggal_akhir']?></b></i>
            <?php
            $query=mysql_query("SELECT * from tb_daftar_parkir where tanggal between '$tanggal_awal' and '$tanggal_akhir' && status='0'");
            }
        ?>
        </p>
        <table class="table table-hover col-md-12 col-sm-12 col-xs-12" width="100%" cellspacing="0" style="margin-top: 5px;">
                <thead>
                      <tr style="font-size: 13pt">
                        <th>Tanggal</th>
                        <th>Jenis</th>
                        <th>Total</th>
                      </tr>
                </thead>
                <tbody>
                      <?php 
                        $a = 0 ;
                        while($row=mysql_fetch_array($query)){
                          $a++;
                          $jmlh[$a] = $row['total'];
                       
            ?>
            <tr style="font-size: 12pt"><tr>
                <th ><?php echo $row['tanggal'];?></th>
                <th ><?php echo $row['jenis'];?></th>
                <th ><?php echo 'Rp. ' .number_format($row['total']).',-';?></th>
            </tr>
            <?php
            }
            ?>  
             </tbody>
                    <tr style="font-size: 12pt">
                        <th colspan="2">Total Pemasukan</th>
                        <th ><?php echo "Rp. ".array_sum($jmlh).",-"; ?></th>
                    </tr> 
            <tr>
                <th colspan="4" align="center"> 
                <?php
                if(mysql_num_rows($query)==0){
                    echo "<font color=red><blink>Pencarian data tidak ditemukan!</blink></font>";
                }
                ?>
                </th>
            </tr> 
        </table>
        <?php
        }
        else{
            unset($_POST['pencarian']);
        }
        ?>
        <iframe width=174 height=189 name="gToday:normal:calender/normal.js" id="gToday:normal:calender/normal.js" src="calender/ipopeng.htm" scrolling="no"  style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
        </div>
        </div>
        </div>
      </div>
        <form action="data_keuangan.php" method="post" name="postform">
             <div class="col-md-12 col-sm-12 col-x-12" style="margin-top: 30px;">
                  <div class="col-md-12 panel">
                    <div class="col-md-12 panel-heading bg-warning">
                      <h4 style="color: white;font-size: 20pt;">Daftar Keuangan</h4>
                    </div>
                    <div class="panel-body">
        <div class="table-responsive col-md-12 col-sm-12 col-xs-12">
        <table class="table table-hover col-md-12 col-sm-12 col-xs-12" width="100%" cellspacing="0" style="margin-top: 5px;">
                <thead>
                      <tr>
                        <th> <input class="submit btn btn-warning col-md-2"  type="submit" style="height: 40px;margin-top: 20px;" value="Print" name="btn_print"></th>
                      </tr>
                      <tr style="font-size: 13pt">
                        <th>Tanggal</th>
                        <th>Jenis</th>
                        <th>Total</th>
                      </tr>
                </thead>
                <tbody>
                      <?php 
                      $sql = "SELECT * FROM tb_daftar_parkir WHERE status = '0'";
                        $query = mysqli_query($con, $sql);
                        $a = 0 ;
                        while ($data = mysqli_fetch_array($query)) {
                        
                          $a++;
                          $jmlh[$a] = $data['total'];
                       
            ?>
            <tr style="font-size: 12pt"><tr>
                <th><?php echo $data['tanggal'];?></th>
                <th><?php echo $data['jenis'];?></th>
                <th><?php echo 'Rp. '.number_format($data['total']).',-';?></th>
            </tr>
            <?php
            }
            ?>  
             </tbody>
                    <tr style="font-size: 12pt">
                        <th colspan="2">Total Pemasukan</th>
                        <th ><?php echo 'Rp. '.array_sum($jmlh).',-'; ?></th>
                    </tr> 
                    
            <tr>
                <th colspan="4" align="center"> 
                </th>
            </tr> 
        </table>
                  </div>
            </div>
        </form>
	
</body>
</html>