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

    $('#containerx').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'DATA JUMLAH MAHASISWA'
        },
        subtitle: {
            text: 'BERDASARKAN AGAMA'
        },
        xAxis: {
            categories: [
			
    <?php
	  while($row = mysqli_fetch_assoc($tahunmasuk))
	  {
		 ?>'<?php echo $row['nmagama']; ?>', <?php 		 
      } ?>				
						],
            title: {
                text: 'Agama'
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah Mahasiswa',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' ORANG'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'horizontal',
            align: 'left',
            verticalAlign: 'bottom',
            x: 50,
            y: 10,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Agama',
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
<div id="containerx" style="min-width: 150px; width: 100%; min-height: 360px; margin: 0 auto"></div>	
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
  $sql = " select a.idagama, a.nmagama, (select count(b.npm) from mahasiswa as b where b.idagama = a.idagama) as jummhs "; 
  $sql .= " from agama as a "; 
  $res = mysqli_query($kdb, $sql) or die(mysql_error());
  return $res;
}

?>