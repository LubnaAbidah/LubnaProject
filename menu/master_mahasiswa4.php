<?php
$a = !empty($_GET['a']) ? $_GET['a'] : "reset";
$idmahasiswa = !empty($_GET['id']) ? $_GET['id'] : " ";
$kdb = koneksidatabase();
$a = @$_GET["a"];
$sql = @$_POST["sql"];
switch ($sql) {
    case "insert": sql_insert(); break;
    case "update": sql_update(); break;
	case "delete": sql_delete(); break;
}

switch ($a) {
    case "reset" :  curd_read();   break;
    case "tambah":  curd_create(); break;
    case "edit"  :  curd_update($idmahasiswa); break;
    case "hapus"  :  curd_delete($idmahasiswa); break;
    default : curd_read(); break;
}
  mysqli_close($kdb);

function curd_read()
{
  $hasil = sql_select();
  $i=1;
  ?>
  <H3> MASTER DATA Mahasiswa </H3>
  <a href="index.php?menu=5&a=tambah" class="btn btn-default btn-sm">
    <span class="glyphicon glyphicon-plus"></span> CREATE
  </a>
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
  <tbody class="text-center">
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
  	  <td><?php echo $baris['photo']; ?></td>
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
  </tbody>
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
<br>
<div class="form-group">
  <label for="npm" class="col-md-2">NPM</label>
  <div class="col-md-6">
    <input type="text" name="npm" id="npm" maxlength="25" size="25" value="<?php  echo trim($row["npm"]) ?>" class="form-control">
  </div>
</div>
<div class="form-group">
  <label for="nama" class="col-md-2">Nama</label>
  <div class="col-md-6">
    <input type="text" name="nama" id="nama" maxlength="25" size="25" value="<?php  echo trim($row["nama"]) ?>" class="form-control">
  </div>
</div>
<div class="form-group">
  <label for="sex" class="col-md-2">Jenis Kelamin</label>
  <div class="col-md-6">
    <?php  $sex = str_replace('"', '"', trim($row["sex"])); ?>
    <input type="radio" name="sex" id="sex" value="P" <?php  if($sex=='P' || $sex=='') {echo "checked=\"checked\""; } else {echo ""; }  ?> />
    <label>Perempuan</label><br>
    <input type="radio" name="sex" id="sex" value="L" <?php  if($sex=='L') {echo "checked=\"checked\""; } else {echo ""; } ?> />
    <label>Laki-Laki</label>
  </div>
</div>
<div class="form-group">
  <label for="tmp_lahir" class="col-md-2">Tempat Lahir</label>
  <div class="col-md-6">
    <input type="text" name="tmp_lahir" id="tmp_lahir" maxlength="25" size="25" value="<?php  echo trim($row["tmp_lahir"]) ?>" class="form-control">
  </div>
</div>
<div class="form-group">
  <label for="tgl_lahir" class="col-md-2">Tanggal Lahir</label>
  <div class="col-md-6">
    <input type="date" name="tgl_lahir" id="tgl_lahir" maxlength="25" size="25" value="<?php  echo trim($row["tgl_lahir"]) ?>" class="form-control" placeholder="yyyy/mm/dd">
  </div>
</div>
<div class="form-group">
<label for="tgl_lahir" class="col-md-2">Id Agama</label>
 <div class="col-md-6">
<select name="idagama" id="idagama"> 
		<?php
			$kdb = koneksidatabase();
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
  </div>
  </div>
<div class="form-group">
<label for="tgl_lahir" class="col-md-2">Id Tahun</label>
 <div class="col-md-6">
<select name="idtahun" id="idtahun"> 
		<?php
			$kdb = koneksidatabase();
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
  </div>
  </div>
<div class="form-group">
<label for="tgl_lahir" class="col-md-2">Id Jalur Masuk</label>
 <div class="col-md-6">
<select name="idjalurmasuk" id="idjalurmasuk"> 
		<?php
			$kdb = koneksidatabase();
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
  </div>
  </div>
<div class="form-group">
  <label for="alamat_jln" class="col-md-2">Alamat</label>
  <div class="col-md-6">
    <input type="text" name="alamat_jln" id="alamat_jln" maxlength="25" size="25" value="<?php  echo trim($row["alamat_jln"]) ?>" class="form-control">
  </div>
</div>
<div class="form-group">
  <label for="alamat_kecamatan" class="col-md-2">Kecamatan</label>
  <div class="col-md-6">
    <input type="text" name="alamat_kecamatan" id="alamat_kecamatan" maxlength="25" size="25" value="<?php  echo trim($row["alamat_kecamatan"]) ?>" class="form-control">
  </div>
</div>
<div class="form-group">
  <label for="alamat_kabupatenkota" class="col-md-2">Kabupaten/Kota</label>
  <div class="col-md-6">
    <input type="text" name="alamat_kabupatenkota" id="alamat_kabupatenkota" maxlength="25" size="25" value="<?php  echo trim($row["alamat_kabupatenkota"]) ?>" class="form-control">
  </div>
</div>
<div class="form-group">
  <label for="alamat_provinsi" class="col-md-2">Provinsi</label>
  <div class="col-md-6">
    <input type="text" name="alamat_provinsi" id="alamat_provinsi" maxlength="25" size="25" value="<?php  echo trim($row["alamat_provinsi"]) ?>" class="form-control">
  </div>
</div>
<div class="form-group">
  <label for="kodepos" class="col-md-2">Kode Pos</label>
  <div class="col-md-6">
    <input type="text" name="kodepos" id="kodepos" maxlength="25" size="25" value="<?php  echo trim($row["kodepos"]) ?>" class="form-control">
  </div>
</div>
<div class="form-group">
  <label for="nohp" class="col-md-2">No Telepon</label>
  <div class="col-md-6">
    <input type="text" name="nohp" id="nohp" maxlength="25" size="25" value="<?php  echo trim($row["nohp"]) ?>" class="form-control">
  </div>
</div>
<div class="form-group">
  <label for="email" class="col-md-2">E-mail</label>
  <div class="col-md-6">
    <input type="text" name="email" id="email" maxlength="25" size="25" value="<?php  echo trim($row["email"]) ?>" class="form-control">
  </div>
</div>
<div class="form-group">
  <label for="photo" class="col-md-2">Photo</label>
  <div class="col-md-6">
    <input type="text" name="photo" id="photo" maxlength="25" size="25" value="<?php  echo trim($row["photo"]) ?>" class="form-control">
  </div>
</div>
<div class="form-group">
  <label for="publish" class="col-md-2">Publikasi</label>
  <div class="col-md-6">
    <?php  $publish = str_replace('"', '"', trim($row["publish"])); ?>
      <input type="radio" name="publish" id="publish" value="T" <?php  if($publish=='T' || $publish=='') {echo "checked=\"checked\""; } else {echo ""; }  ?> />
      <label>Dipublikasikan</label><br>
      <input type="radio" name="publish" id="publish" value="F" <?php  if($publish=='F') {echo "checked=\"checked\""; } else {echo ""; } ?> />
      <label>Tidak dipublikasikan</label>
  </div>
</div>
<?php  }?>

<?php
function curd_create()
{
?>
<h3>Penambahan Data Mahasiswa</h3><br>

<form action="index.php?menu=5&a=reset" method="post" class="form-horizontal">
<input type="hidden" name="sql" value="insert" >
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
  "photo" => "",
  "publish" => "T");
formeditor($row)
?>
<p><input type="submit" name="action" value="Simpan" class="btn btn-default"> <a href="index.php?menu=5&a=reset" class="btn btn-default">Batal</a></p>
</form>
<?php } ?>

<?php
function curd_update($idmahasiswa)
{
global $kdb;
$hasil2 = sql_select_byid($idmahasiswa);
$row = mysqli_fetch_array($hasil2);
?>
<h3>Pengubahan Data Mahasiswa</h3><br>

<form action="index.php?menu=5&a=reset" method="post" class="form-horizontal">
<input type="hidden" name="sql" value="update" >
<input type="hidden" name="idmahasiswax" value="<?php  echo $idmahasiswa; ?>" >
<?php
formeditor($row)
?>
<p><input type="submit" name="action" value="Update" class="btn btn-info"> <a href="index.php?menu=5&a=reset" class="btn btn-default">Batal</a></p>
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

<form action="index.php?menu=5&a=reset" method="post">
<input type="hidden" name="sql" value="delete" >
<input type="hidden" name="idmahasiswax" value="<?php  echo $idmahasiswa; ?>" >
<h4>
  <span class="glyphicon glyphicon-alert"> </span>
  Anda yakin akan menghapus data mahasiswa <?php echo $row['nama'];?> ?
</h4>
<br>
<p><input type="submit" name="action" value="Delete" class="btn btn-danger"> <a href="index.php?menu=5&a=reset" class="btn btn-default">Batal</a></p>
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
  $sql = " SELECT mahasiswa.idmahasiswa, mahasiswa.npm, mahasiswa.nama, mahasiswa.sex, mahasiswa.tmp_lahir, mahasiswa.tgl_lahir, agama.nmagama, tahun.tahun, jalurmasuk.nmjalurmasuk, mahasiswa.alamat_jln, mahasiswa.alamat_kecamatan, mahasiswa.alamat_kabupatenkota, mahasiswa.alamat_provinsi, mahasiswa.kodepos, mahasiswa.nohp, mahasiswa.email, mahasiswa.photo, mahasiswa.publish FROM `mahasiswa`, `agama`, `tahun`, `jalurmasuk` WHERE mahasiswa.idagama=agama.idagama and mahasiswa.idtahun=tahun.idtahun and mahasiswa.idjalurmasuk=jalurmasuk.idjalurmasuk";
  $hasil = mysqli_query($kdb, $sql) or die(mysql_error());
  return $hasil;
}

function sql_insert()
{
  global $kdb;
  global $_POST;
  $sql  = " insert into `mahasiswa` ( `npm`, `nama`, `sex`, `tmp_lahir`, `tgl_lahir`, `idagama`, `idtahun`, `idjalurmasuk`, `alamat_jln`, `alamat_kecamatan`, `alamat_kabupatenkota`, `alamat_provinsi`, `kodepos`, `nohp`, `email`, `photo`, `publish` ) values ( '".$_POST["npm"]."', '".$_POST["nama"]."', '".$_POST["sex"]."', '".$_POST["tmp_lahir"]."', '".$_POST["tgl_lahir"]."', '".$_POST["idagama"]."', '".$_POST["idtahun"]."', '".$_POST["idjalurmasuk"]."', '".$_POST["alamat_jln"]."', '".$_POST["alamat_kecamatan"]."', '".$_POST["alamat_kabupatenkota"]."', '".$_POST["alamat_provinsi"]."', '".$_POST["kodepos"]."', '".$_POST["nohp"]."', '".$_POST["email"]."', '".$_POST["photo"]."', '".$_POST["publish"]."' )";
  mysqli_query($kdb, $sql) or die( mysql_error());
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
  global $_POST;
  $sql  = "update  mahasiswa set npm = '".$_POST["npm"]."', nama = '".$_POST["nama"]."', sex = '".$_POST["sex"]."', tmp_lahir = '".$_POST["tmp_lahir"]."', tgl_lahir = '".$_POST["tgl_lahir"]."', idagama = '".$_POST["idagama"]."', idtahun = '".$_POST["idtahun"]."', idjalurmasuk = '".$_POST["idjalurmasuk"]."', alamat_jln = '".$_POST["alamat_jln"]."', alamat_kecamatan = '".$_POST["alamat_kecamatan"]."',  alamat_kabupatenkota = '".$_POST["alamat_kabupatenkota"]."', alamat_provinsi = '".$_POST["alamat_provinsi"]."', kodepos = '".$_POST["kodepos"]."', nohp = '".$_POST["nohp"]."', email = '".$_POST["email"]."', photo = '".$_POST["photo"]."', publish = '".$_POST["publish"]."' where idmahasiswa = ".$_POST["idmahasiswax"];
  mysqli_query($kdb, $sql) or die( mysql_error());
}
function sql_delete()
{
  global $kdb;
  global $_POST;
  $sql  = " delete from `mahasiswa` where idmahasiswa = ".$_POST["idmahasiswax"];
  mysqli_query($kdb, $sql) or die( mysql_error());
}
?>
