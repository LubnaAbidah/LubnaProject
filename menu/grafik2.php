<!DOCTYPE html>
<html>
<head>

<div class="col-md-12">
<?php
$kdb = koneksidatabase();
grafik(); 
mysqli_close($kdb);

function grafik() 
{
global $dbc;
$tahunmasuk = sql_select_tahun_masuk_mahasiswa();
$datamhs = sql_select_tahun_masuk_mahasiswa();
?>
<script src="./framework/highchart/jquery.min.js" type="text/javascript"></script>
<script src="./framework/highchart/highcharts.js" type="text/javascript"></script>
<script src="./framework/highchart/modules/exporting.js" type="text/javascript"></script>	
<script type="text/javascript">
$(function () {
    $('#grafikline').highcharts({
        title: {
            text: 'DATA JUMLAH MAHASISWA',
            x: -20 //center
        },
        subtitle: {
            text: 'BERDASARKAN TAHUN MASUK',
            x: -20
        },
  credits: {
   enabled: false
  },
        xAxis: {
   title: {
                text: 'Tahun Masuk'
            },
            categories: [  <?php
	  while($row = mysqli_fetch_assoc($tahunmasuk))
	  {
		 ?>'<?php echo $row['tahun']; ?>', <?php 		 
      } ?>
			
			
			]
        },
        yAxis: {
            title: {
                text: 'Jumlah Mahasiswa'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ' orang'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
     name: "Tahun",
     data: [
	  <?php
	  while($row = mysqli_fetch_assoc($datamhs))
	  {
		 echo $row['jummhs'].', ';  
     } ?>	
	]
    }]
    });
});
</script>
</head>
<body>
<div id="grafikline" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
</body>
</html>
<?php
  mysqli_free_result($tahunmasuk);
}

function koneksidatabase()
{
    include('./koneksi/koneksi.php');
	return $kdb;
} 

function sql_select_tahun_masuk_mahasiswa()
{
  global $kdb;
  $sql = " select a.idtahun, a.tahun, (select count(b.npm) from mahasiswa as b where b.idtahun = a.idtahun) as jummhs "; 
  $sql .= " from tahun as a "; 
  $res = mysqli_query($kdb, $sql) or die(mysql_error());
  return $res;
}

?>
</div>
