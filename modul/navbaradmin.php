<nav class="navbar navbar-fixed-top navbar-default bg-warning">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed bg-white" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
       <img src="asset/img/logo.png" class="img-circle" alt="logo" style="float: left; margin-top: 2px;" width="45px"/>
      <a class="navbar-brand" href="home.php">BESPARKIR</a>
     
    </div>
    <div class="collapse navbar-collapse  bg-warning" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav "> 
        <li><a href="home_admin.php"><span  style="font-size: 18pt">Akses Operator</a></span></li>
        <li><a href="data_keuangan.php"><span style="font-size: 18pt">Data Keuangan</a></span></li>
      </ul>
       <ul class="nav navbar-nav navbar-right user-nav">
          <li class="dropdown avatar-dropdown">
            <img src="asset/img/petugas.png" class="img-circle avatar" alt="username" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="cursor: pointer;" />
                   <ul class="dropdown-menu user-dropdown bg-warning">
                     <li>
                      <ul>
                        <a href="ceklogout.php">
                          <li style="float: left;"><span class="fa fa-power-off "></span></li>
                          <li style="color: black; float: left;margin-left: 10px">Log Out</li>
                        </a>
                      </ul>
                    </li>
                  </ul>
                </li>
              </ul>
    </div><!-- /.navbar-collapse -->
  </div>
</nav>