<?php
session_start();
if(!isset($_SESSION['nmuser'])){ header("location:login.php"); }
	$menu = !empty($_GET['menu']) ? $_GET['menu'] : "1";
?>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SIAKAD - POLITEKNIK NEGERI LAMPUNG</title>
	<link href="./bootstrap/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="./bootstrap/docs.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="shortcut icon" type="text/css" href="image/logo-polinela.png"/>
</head>
<body >
	<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
	<div class="container">
	<div class="pull-right navbar-brand">
		<?php echo " Welcome ".$_SESSION['nmuser'].' | <a href=sistem.php?op=out class="btn btn-danger">Log Out</a> '; ?>
	</div>
		<div class="navbar-header">
			<a href="index.php?menu=1" class="navbar-brand">PENGOLAHAN DATA MAHASISWA</a>	
		</div>
	</div>
	</header>

    <div class="container bs-docs-container">
        <div class="row">
            <div class="col-md-3">
                <div class="bs-sidebar" role="complementary">
                    <ul class="nav bs-sidenav">
                        <li <?php if($menu==1) { echo 'class="active"'; } else { echo 'class=""'; } ?> >
                            <a href="index.php?menu=1">
                              <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home
                            </a>
                        </li>
                        <li <?php if($menu==2) { echo 'class="active"'; } else { echo 'class=""'; } ?>>
                            <a href="index.php?menu=2">
                              <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Master Agama
                            </a>
                        </li>
                        <li <?php if($menu==3) { echo 'class="active"'; } else { echo 'class=""'; } ?>>
                            <a href="index.php?menu=3">
                              <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Master Tahun
                            </a>
                        </li>
                        <li <?php if($menu==4) { echo 'class="active"'; } else { echo 'class=""'; } ?>>
                            <a href="index.php?menu=4">
                              <span class="glyphicon glyphicon-education" aria-hidden="true"></span> Master Jalur Masuk
                            </a>
                        </li>
                        <li <?php if($menu==5) { echo 'class="active"'; } else { echo 'class=""'; } ?>>
                            <a href="index.php?menu=5">
                              <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Master Mahasiswa
                            </a>
                        </li>
						<li <?php if($menu==6) { echo 'class="active"'; } else { echo 'class=""'; } ?>>
                            <a href="index.php?menu=6">
                              <span class="glyphicon glyphicon-signal" aria-hidden="true"></span> Grafik Mahasiswa-Tahun
                            </a>
                        </li>
						<li <?php if($menu==7) { echo 'class="active"'; } else { echo 'class=""'; } ?>>
                            <a href="index.php?menu=7">
                              <span class="glyphicon glyphicon-signal" aria-hidden="true"></span> Grafik Mahasiswa-Agama
                            </a>
                        </li>
						<li <?php if($menu==8) { echo 'class="active"'; } else { echo 'class=""'; } ?>>
                            <a href="index.php?menu=8">
                              <span class="glyphicon glyphicon-signal" aria-hidden="true"></span> Grafik Mahasiswa-Jalur Masuk
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9" role="main">
                <?php
                    switch($menu)
                    {
                        case('1'): include_once('./menu/welcome.php'); break;
                        case('2'): include_once('./menu/master_agama4.php'); break;
                        case('3'): include_once('./menu/master_tahun4.php'); break;
                        case('4'): include_once('./menu/master_jalurmasuk4.php'); break;
                        case('5'): include_once('./menu/master_mahasiswax.php'); break;
						case('6'): include_once('./menu/grafik2.php'); break;
						case('7'): include_once('./menu/graph_mhsx.php'); break;
						case('8'): include_once('./menu/graph_mhs.php'); break;
                        default:   include_once('./menu/welcome.php'); break;
                    }
                ?>
            </div>
        </div>
    </div>


<footer class="bs-footer" role="contentinfo">
    <div class="container">
        <div class="">
            <p>Praktik 11 / Sistem Menu / SIWEB / Program Studi Manajemen Informatika Politeknik Negeri Lampung .</p>
        </div>
    </div>
</footer>



</body>
</html>
