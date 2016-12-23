<?php
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', 'root');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'dtakademik');
$kdb = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if (!$kdb){
			trigger_error ('Tidak dapat terkoneksi dengan database Engine MySQL :' .mysqli_connect_error());
		} else {
		echo 'Berhasil terkoneksi dengan database Engine MySQL';
		}
?>