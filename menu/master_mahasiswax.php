<?php
$a = !empty($_GET['a']) ? $_GET['a'] : "reset";
$idmahasiswa = !empty($_GET['id']) ? $_GET['id'] : " ";
$kdb = koneksidatabase();
$a = @$_GET["a"];
$sql = @$_POST["sql"];
$upload = @$_POST["upload"];

switch ($upload) {
	case "1": upload_data(); break;
}
switch ($sql) {
	case "insert": sql_insert(); break;
	case "update": sql_update(); break;
	case "delete": sql_delete(); break;
}

switch ($a) {
	case "reset" : curd_read(); break;
	case "tambah": curd_create() ; break;
	case "edit"  : curd_update($idmahasiswa); break;
	case "hapus" : curd_delete($idmahasiswa); break;
	default : curd_read(); break;
}
	mysqli_close($kdb);

function curd_read()
{
	$hasil = sql_select();
	$i=1;
	?>
	<link rel ="stylesheet" href ="./bootstrap/css/bootstrap.css" type="text/css">
  <link rel ="stylesheet" href ="bootstrap/css/bootstrap-theme.css" type="text/css">
	
	<H3> MASTER DATA Mahasiswa </H3>
  <a href="index.php?menu=5&a=tambah" class="btn btn-default btn-sm">
    <span class="glyphicon glyphicon-plus"></span> CREATE
  </a>
  <a href="menu/export_data_mhs_pdf.php?a=#" class="btn btn-primary btn-sm">EXPORT to PDF</a>
  <br>
  <br>
<div class="col-md-12 table-responsive">
  <table class="table table-hover table-striped table-bordered table-condensed">
    <thead class="text-center">
      <tr>
        <td>NO</td>
        <td>Id Mahasiswa</td>
        <td>NPM</td>
        <td>Nama</td>
        <td>Sex</td>
        <td>Tempat Lahir</td>
        <td>Tanggal Lahir</td>
        <td>Nama Agama</td>
        <td>Nama Tahun</td>
        <td>Nama Jalur Masuk</td>
        <td>Alamat Jalan</td>
        <td>Alamat Kecamatan</td>
        <td>Alamat KabupatenKota</td>
        <td>Alamat Provinsi</td>
        <td>Kode pos</td>
        <td>No Telepon</td>
        <td>Email</td>
        <td>Photo</td>
        <td>Publish</td>
        <td colspan="2">Aksi</td>
      </tr>
    </thead>
	<?php
	while($baris = mysqli_fetch_array($hasil))
	{
	?>
	<tr>
	<td><?php echo $i; ?></td>
	<td><?php echo $baris['idmahasiswa']; ?></td>
	<td><?php echo $baris['npm']; ?></td>
	<td><?php echo $baris['nama']; ?></td>
	<td><?php echo $baris['sex']; ?></td>
	<td><?php echo $baris['tmp_lahir']; ?></td>
	<td><?php echo $baris['tgl_lahir']; ?></td>
	<td><?php echo $baris['nmagama']; ?></td>
	<td><?php echo $baris['tahun']; ?></td>
	<td><?php echo $baris['nmjalurmasuk']; ?></td>
	<td><?php echo $baris['alamat_jln']; ?></td>
	<td><?php echo $baris['alamat_kecamatan']; ?></td>
	<td><?php echo $baris['alamat_kabupatenkota']; ?></td>
	<td><?php echo $baris['alamat_provinsi']; ?></td>
	<td><?php echo $baris['kodepos']; ?></td>
	<td><?php echo $baris['nohp']; ?></td>
	<td><?php echo $baris['email']; ?></td>
	<td><img src="./upload/image/<?php echo $baris['photo']; ?>" width="100px" height="85px"/></td>
	<td><?php if($baris['publish']=='T' ) {echo "<span class=\"glyphicon glyphicon-ok\"></span>";} else {echo "<span class=\"glyphicon glyphicon-remove\"></span>";} ?></td>
  	  <td>
        <a href="index.php?menu=5&a=edit&id=<?php echo $baris['idmahasiswa']; ?>" class="btn btn-info btn-sm">
          <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
        </a>
      </td>
      <td>
        <a href="index.php?menu=5&a=hapus&id=<?php echo $baris['idmahasiswa']; ?>" class="btn btn-danger btn-sm">
          <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
        </a>
      </td>
	</tr>
	<?php
		$i++;
	}
	?>
	</table>
	</div>
	<?php
	mysqli_free_result($hasil);
}
?>

<?php
function formeditor($row)
{
?>
<table class="table">
<tr>
	<td width="200px">Npm</td>
	<td><input type="text" name="npm" id="npm" maxlength="25" size="25" value="<?php echo trim($row["npm"]) ?>" ></td>
</tr>
<tr>
	<td width="200px">Nama</td>
	<td><input type="text" name="nama" id="nama" maxlength="25" size="25" value="<?php echo trim($row["nama"]) ?>" ></td>
</tr>
<tr>
	<td>Sex</td>
	<td>
	<?php $sex = str_replace('"', '"', trim($row["sex"])); ?>
	<input type="radio" name="sex" id="sex" value="L" <?php if($sex=='L') {echo "checked=\"checked\""; } else {echo ""; } ?> />
	<label>L</label>
	<input type="radio" name="sex" id="sex" value="P" <?php if($sex=='P') {echo "checked=\"checked\""; } else {echo "";} ?> \>
	<label>P</label>
	<input type="radio" name="sex" id="sex" value="-" <?php if($sex=='-' || $sex=='') {echo "checked=\"checked\""; } else {echo "";} ?> \>
	<label>-</label>
	</td>
</tr>
<tr>
	<td width="200px">Tempat Lahir</td>
	<td><input type="text" name="tmp_lahir" id="tmp_lahir" maxlength="25" size="25" value="<?php echo trim($row["tmp_lahir"]) ?>" ></td>
</tr>
<tr>
	<td width="200px">Tanggal Lahir</td>
	<td><input type="date" name="tgl_lahir" id="tgl_lahir" maxlength="25" size="25" value="<?php echo trim($row["tgl_lahir"]) ?>" ></td>
</tr>
<tr>
	<td>ID Agama</td>
	<td>
	<select name="idagama" id="idagama"> 
		<?php
			global $kdb;
			$sqlquery   = "select `idagama`, `nmagama`, `publish` from agama where `publish` = 'T' ";
			$hasilquery = mysqli_query($kdb, $sqlquery) or die (mysql_error());
			while ( $baris = mysqli_fetch_assoc($hasilquery)) {
					$value = $baris["idagama"];
					$caption = $baris ["nmagama"];
					if ($row["idagama"] == $baris ["idagama"])
					{$selstr = "selected"; }
					else {$selstr = ""; }
		?>
		<option value="<?php echo $value ?>" <?php echo $selstr ?>>
			&nbsp; <?php echo $caption; ?> &nbsp;
		</option>
		<?php
		}
		?>
	</select>
	</td>
</tr>
<tr>
	<td>ID Tahun</td>
	<td>
	<select name="idtahun" id="idtahun">
		<?php
			global $kdb;
			$sqlquery   = "select `idtahun`, `tahun`, `publish` from tahun where `publish` = 'T' ";
			$hasilquery = mysqli_query($kdb, $sqlquery) or die (mysql_error());
			while ( $baris = mysqli_fetch_assoc($hasilquery)) {
					$value = $baris["idtahun"];
					$caption = $baris ["tahun"];
					if ($row["idtahun"] == $baris ["idtahun"])
					{$selstr = "selected"; }
					else {$selstr = ""; }
		?>
		<option value="<?php echo $value ?>" <?php echo $selstr ?>>
			&nbsp; <?php echo $caption; ?> &nbsp;
		</option>
		<?php
		}
		?>
		</select>
	</td>
</tr>
<tr>
	<td>ID Jalur Masuk</td>
	<td>
	<select name="idjalurmasuk" id="idjalurmasuk"> 
		<?php
			global $kdb;
			$sqlquery   = "select `idjalurmasuk`, `nmjalurmasuk`, `publish` from jalurmasuk where `publish` = 'T' ";
			$hasilquery = mysqli_query($kdb, $sqlquery) or die (mysql_error());
			while ( $baris = mysqli_fetch_assoc($hasilquery)) {
					$value = $baris["idjalurmasuk"];
					$caption = $baris ["nmjalurmasuk"];
					if ($row["idjalurmasuk"] == $baris ["idjalurmasuk"])
					{$selstr = "selected"; }
					else {$selstr = ""; }
		?>
		<option value="<?php echo $value ?>" <?php echo $selstr ?>>
			&nbsp; <?php echo $caption; ?> &nbsp;
		</option>
		<?php
		}
		?>
	</select>
	</td>
</tr>
<tr>
	<td width="200px">Alamat Jalan</td>
	<td><input type="text" name="alamat_jln" id="alamat_jln" maxlength="25" size="25" value="<?php echo trim($row["alamat_jln"]) ?>" ></td>
</tr>
<tr>
	<td width="200px">Alamat Kecamatan</td>
	<td><input type="text" name="alamat_kecamatan" id="alamat_kecamatan" maxlength="25" size="25" value="<?php echo trim($row["alamat_kecamatan"]) ?>" ></td>
</tr>
<tr>
	<td width="200px">Alamat Kabupaten / Kota</td>
	<td><input type="text" name="alamat_kabupatenkota" id="alamat_kabupatenkota" maxlength="25" size="25" value="<?php echo trim($row["alamat_kabupatenkota"]) ?>" ></td>
</tr>
<tr>
	<td width="200px">Alamat Provinsi</td>
	<td><input type="text" name="alamat_provinsi" id="alamat_provinsi" maxlength="25" size="25" value="<?php echo trim($row["alamat_provinsi"]) ?>" ></td>
</tr>
<tr>
	<td width="200px">Kode Pos</td>
	<td><input type="text" name="kodepos" id="kodepos" maxlength="25" size="25" value="<?php echo trim($row["kodepos"]) ?>" ></td>
</tr>
<tr>
	<td width="200px">No HP</td>
	<td><input type="number" name="nohp" id="nohp" maxlength="25" size="25" value="<?php echo trim($row["nohp"]) ?>" ></td>
</tr>
<tr>
	<td width="200px">Email</td>
	<td><input type="email" name="email" id="email" maxlength="25" size="25" value="<?php echo trim($row["email"]) ?>" ></td>
</tr>
<tr>
	<td width="200px">Photo</td>
	<td><input type="file" name="userfile" id="userfile" maxlength="50" size="25" value="<?php echo trim($row["photo"]) ?>" ></td>
</tr>
<tr>
	<td>PUBLIKASI</td>
	<td>
	<?php $publish = str_replace('"', '"', trim($row["publish"])); ?>
	<input type="radio" name="publish" id="publish" value="T" <?php if($publish=='T' || $publish=='') {echo "checked=\"checked\""; } else {echo ""; } ?> />
	<label>Dipublikasikan</label><br>
	<input type="radio" name="publish" id="publish" value="F" <?php if($publish=='F') {echo "checked=\"checked\""; } else {echo "";} ?> \>
	<label>Tidak dipublikasikan</label>
	</td>
</tr>
</table>
<?php }?>

<?php
function curd_create()
{
?>
<h3>Penambahan Data Mahasiswa</h3><br>
<a href="index.php?menu=5&a=reset"class="btn btn-danger btn-sm">Batal</a>
<br>
<form enctype="multipart/form-data" action="index.php?menu=5&a=reset" method="POST">
<input type="hidden" name="sql" value="insert">
<input type="hidden" name="upload" value="1">

<?php
$row = array(
"npm" => "",
"nama" => "",
"sex" => "",
"tmp_lahir" => "",
"tgl_lahir" => "",
"idagama" => "",
"idtahun" => "",
"idjalurmasuk" => "",
"alamat_jln" => "",
"alamat_kecamatan" => "",
"alamat_kabupatenkota" => "",
"alamat_provinsi" => "",
"kodepos" => "",
"nohp" => "",
"email" => "",
"userfile" => "default.jpg",
"publish" => "T");

formeditor($row)
?>
<p><input type="submit" name="enter" value="Simpan"class="btn btn-primary btn-sm"></p>
</form>
<?php }?>

<?php 
function curd_update($idmahasiswa) 
{
global $kdb;
$hasil2 = sql_select_byid($idmahasiswa);
$row = mysqli_fetch_array($hasil2);
?>
<h3>Pengubahan Data Mahasiswa</h3><br>
<a href="index.php?menu=5&a=reset"class="btn btn-danger btn-sm">Batal</a><br>
<form enctype="multipart/form-data" action="index.php?menu=5&a=reset" method="post">
	<input type="hidden" name="sql" value="update"class="btn btn-success btn-sm">
	<input type="hidden" name="upload" value="1">
	<input type="hidden" name="idmahasiswax" value="<?php  echo $idmahasiswa; ?>" >
<?php
formeditor($row)
?>
<p><input type="submit" name="enter" value="Update"class="btn btn-success btn-sm" ></p>
</form>
<?php } ?>

<?php 
function curd_delete($idmahasiswa) 
{
global $kdb;
$hasil2 = sql_select_byid($idmahasiswa);
$row = mysqli_fetch_array($hasil2);
?>
<h3>Penghapusan Data Mahasiswa</h3><br>

<br>
<form action="index.php?menu=5&a=reset" method="post">
<input type="hidden" name="sql" value="delete" >
<input type="hidden" name="idmahasiswax" value="<?php  echo $idmahasiswa; ?>" >
<h3> Anda yakin akan menghapus data Mahasiswa <?php echo $row['nama'];?> </h3>
<p><input type="submit" name="action" value="Delete"class="btn btn-primary btn-sm" >
<a href="index.php?menu=5&a=reset"style="color:white;" class="btn btn-danger btn-sm">Batal</a></p>
</form>
<?php } ?>

<?php
function koneksidatabase()
{
	include('./koneksi/koneksi.php');
		return $kdb;
}

function sql_select()
{
	global $kdb;
	$sql = " select a.*, b.nmagama, c.tahun, d.nmjalurmasuk from mahasiswa as a, agama as b, tahun as c, jalurmasuk as d where b.idagama = a.idagama and
  c.idtahun = a.idtahun and d.idjalurmasuk = a.idjalurmasuk "; 
	$hasil = mysqli_query($kdb, $sql) or die(mysql_error());
	return $hasil;
}

function sql_insert()
{
		global $kdb;
		$namafile = $_FILES["userfile"]["name"];
		$file_ext = strtolower(substr($namafile, strpos($namafile,' .')+1));
		$newname = strtotime(date('Y-m-d H:i:s'));
		$newfile = $newname.$file_ext;
		$filephoto = basename($newfile);
		$sql = "insert into `mahasiswa` (`npm`, `nama`, `sex`, `tmp_lahir`, `tgl_lahir`, `idagama`, `idtahun`, `idjalurmasuk`, `alamat_jln`, `alamat_kecamatan`, `alamat_kabupatenkota`, `alamat_provinsi`, `kodepos`, `nohp`, `email`, `photo`,`publish`) 
		values 
		(
		'".$_POST["npm"]."', 
		'".$_POST["nama"]."', 
		'".$_POST["sex"]."', 
		'".$_POST["tmp_lahir"]."', 
		'".$_POST["tgl_lahir"]."', 
		'".$_POST["idagama"]."', 
		'".$_POST["idtahun"]."', 
		'".$_POST["idjalurmasuk"]."', 
		'".$_POST["alamat_jln"]."', 
		'".$_POST["alamat_kecamatan"]."', 
		'".$_POST["alamat_kabupatenkota"]."', 
		'".$_POST["alamat_provinsi"]."', 
		'".$_POST["kodepos"]."', 
		'".$_POST["nohp"]."', 
		'".$_POST["email"]."', 
		'".$filephoto."',
		'".$_POST["publish"]."')";
		mysqli_query($kdb, $sql) or die(mysql_error());
}

function sql_select_byid($idmahasiswa)
{
		global $kdb;
		$sql = " select * from mahasiswa where idmahasiswa = ".$idmahasiswa; 
		$hasil2 = mysqli_query($kdb, $sql) or die(mysql_error());
		return $hasil2;
}
function sql_update()
{
		global $kdb;
		$namafile = $_FILES["userfile"]["name"];
		$file_ext = strtolower(substr($namafile, strpos($namafile,' .')+1));
		$newname = strtotime(date('Y-m-d H:i:s'));
		$newfile = $newname.$file_ext;
		$filephoto = basename($newfile);
		$sql  = " update `mahasiswa` set 
		`npm` = '".$_POST["npm"]."', 
		`nama` = '".$_POST["nama"]."', 
		`sex` = '".$_POST["sex"]."', 
		`tmp_lahir` = '".$_POST["tmp_lahir"]."', 
		`tgl_lahir` = '".$_POST["tgl_lahir"]."', 
		`idagama` = '".$_POST["idagama"]."', 
		`idtahun` = '".$_POST["idtahun"]."', 
		`idjalurmasuk` = '".$_POST["idjalurmasuk"]."', 
		`alamat_jln` = '".$_POST["alamat_jln"]."', 
		`alamat_kecamatan` = '".$_POST["alamat_kecamatan"]."', 
		`alamat_kabupatenkota` = '".$_POST["alamat_kabupatenkota"]."', 
		`alamat_provinsi` = '".$_POST["alamat_provinsi"]."', 
		`kodepos` = '".$_POST["kodepos"]."', 
		`nohp` = '".$_POST["nohp"]."', 
		`email` = '".$_POST["email"]."', 
		`photo` = '".$filephoto."',
		`publish` = '".$_POST["publish"]."' 
		where idmahasiswa = ".$_POST["idmahasiswax"];			  
		mysqli_query($kdb, $sql) or die( mysql_error()); 
}

function sql_delete()
{
		global $kdb;
		global $_POST; 
		$sql  = " delete from `mahasiswa` where idmahasiswa = ".$_POST["idmahasiswax"];			  
		mysqli_query($kdb, $sql) or die( mysql_error()); 
}

function upload_data()
{
		if(isset($_POST["enter"]))
		{
		//ambil parameter-parameter file yang diupload:
		//nama, nama temp, ukuran dan type
		$file_name = $_FILES["userfile"]["name"];
		$file_tmp_name = $_FILES["userfile"]["tmp_name"];
		$file_size = $_FILES["userfile"]["size"];
		$file_type = $_FILES["userfile"]["type"];

		//definisikan variabel untuk menangani error saat upload
		$err_upload=0;

		//pada contoh berikut file akan diupload ke direktori image
		$dir_upload = "./upload/image/";

		//mengambil ekstensi sebuah file
		$file_ext = strtolower(substr($file_name, strpos($file_name,' .')+1));

		//new name
		$newname = strtotime(date('Y-m-d H:i:s'));

		//menggabungkan new name dengan ekstensi
		$newfile = $newname.$file_ext;

		//buat nama untuk file hasil upload
		$file_upload = $dir_upload . basename($newfile);

		//cek keberadaan file hasil upload di server
		if(file_exists($file_upload))
		{
			echo "Maaf, file yang sama sudah ada pada server kami <br />";
			$err_upload=1;
		}

		//buat batasan maksimum ukuran file yang boleh diupload (dalam byte) buat 2MB
		$max_size_upload=1000000;

		//cek apakah ukuran file yang diupload melebihi batas
		if($file_size > $max_size_upload)
		{
			echo "Maaf, ukuran file yang diupload melebih ".$max_size_upload." byte <br /> ";
				$err_upload=1;
		}

		//cek hanya type JPG, GIF dan PNG saja yang diijinkan buat tipe pdf dan word(doc atau docx) exel atau ppt
		if(($file_type!="image/jpeg") && ($file_type!="image/gif") && ($file_type!="image/png"))
		{
			echo "Maaf, hanya file JPG, GIF dan PNG saja yang diperbolehkan <br />";
			$err_upload=1;
		}

		//tampilkan error jika terjadi kesalahan
		if($err_upload)
		{
			echo "Ada Error, proses upload dibatalkan";
		}
		//proses upload file jika semua benar
		else
		{
			if(move_uploaded_file($file_tmp_name,$file_upload))
			{
				echo "Proses upload berhasil";
			}
			else
			{
				echo "Proses upload gagal";
			}
		}
		}
}
?>