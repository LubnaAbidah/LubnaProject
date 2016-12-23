<?php
$a = !empty($_GET['a']) ? $_GET['a'] : "reset";
$idtahun = !empty($_GET['id']) ? $_GET['id'] : " ";
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
    case "edit"  :  curd_update($idtahun); break;
    case "hapus"  :  curd_delete($idtahun); break;
    default : curd_read(); break;
}
  mysqli_close($kdb);

function curd_read()
{
  $hasil = sql_select();
  $i=1;
  ?>
  <H3> MASTER DATA TAHUN  </H3>
  <a href="index.php?menu=3&a=tambah" class="btn btn-default btn-sm">
    <span class="glyphicon glyphicon-plus"></span> CREATE
  </a><br><br>
  <table class="table table-hover table-striped table-bordered table-condensed">
    <thead class="text-center">
      <tr>
        <td>No</td>
        <td>ID Tahun</td>
        <td>Tahun</td>
        <td>Publish</td>
        <td>Aksi</td>
      </tr>
    </thead>
    <tbody class="text-center">
      <?php
      while($baris = mysqli_fetch_array($hasil))
      {
        ?>
        <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo $baris['idtahun']; ?></td>
          <td><?php echo $baris['tahun']; ?></td>
          <td><?php if($baris['publish']=='T' ) {echo "<span class=\"glyphicon glyphicon-ok\"></span>";} else {echo "<span class=\"glyphicon glyphicon-remove\"></span>";} ?></td>
          <td>
            <a href="index.php?menu=3&a=edit&id=<?php echo $baris['idtahun']; ?>" class="btn btn-info btn-sm">
              <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            </a>
            <a href="index.php?menu=3&a=hapus&id=<?php echo $baris['idtahun']; ?>" class="btn btn-danger btn-sm">
              <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
            </a>
          </td>
        </tr>
        <?php
        $i++;
      }
      ?>
    </tbody>
  </table>
   <?php
  mysqli_free_result($hasil);
}
 ?>


<?php
function formeditor($row)
  {
?>
<table>
<tr>
<td width="200px">Tahun</td>
<td><input type="text" name="tahun" id="tahun" maxlength="25" size="25" value="<?php  echo trim($row["tahun"]) ?>" class="form-control"></td>
</tr>
<tr>
<td >Publikasi</td>
<td >
<?php  $publish = str_replace('"', '"', trim($row["publish"])); ?>
<br>
<input type="radio" name="publish" id="publish" value="T" <?php  if($publish=='T' || $publish=='') {echo "checked=\"checked\""; } else {echo ""; }  ?> />
<label>Dipublikasikan</label>
<br>
<input type="radio" name="publish" id="publish" value="F" <?php  if($publish=='F') {echo "checked=\"checked\""; } else {echo ""; } ?> />
<label>Tidak dipublikasikan</label>
</td>
</tr>
</table>
<?php  }?>

<?php
function curd_create()
{
?>
<h3>Penambahan Data Tahun</h3><br>

<br>
<form action="index.php?menu=3&a=reset" method="post">
<input type="hidden" name="sql" value="insert" >
<?php
$row = array(
  "tahun" => "",
  "publish" => "T");
formeditor($row)
?>
<p><input type="submit" name="action" value="Simpan" class="btn btn-default"> <a href="index.php?menu=3&a=reset" class="btn btn-default">Batal</a></p>
</form>
<?php } ?>

<?php
function curd_update($idtahun)
{
global $kdb;
$hasil2 = sql_select_byid($idtahun);
$row = mysqli_fetch_array($hasil2);
?>
<h3>Pengubahan Data Tahun</h3><br>

<br>
<form action="index.php?menu=3&a=reset" method="post">
<input type="hidden" name="sql" value="update" >
<input type="hidden" name="idtahunx" value="<?php  echo $idtahun; ?>" >
<?php
formeditor($row)
?>
<p><input type="submit" name="action" value="Update" class="btn btn-default"> <a href="index.php?menu=3&a=reset" class="btn btn-default">Batal</a></p>
</form>
<?php } ?>

<?php
function curd_delete($idtahun)
{
global $kdb;
$hasil2 = sql_select_byid($idtahun);
$row = mysqli_fetch_array($hasil2);
?>
<h3>Penghapusan Data Tahun</h3><br>

<form action="index.php?menu=3&a=reset" method="post">
<input type="hidden" name="sql" value="delete" >
<input type="hidden" name="idtahunx" value="<?php  echo $idtahun; ?>" >
<h4>
  <span class="glyphicon glyphicon-alert"> </span>
  Anda yakin akan menghapus data tahun <?php echo $row['tahun'];?> ?
</h4>
<br>
<p><input type="submit" name="action" value="Delete" class="btn btn-danger"> <a href="index.php?menu=3&a=reset" class="btn btn-default">Batal</a></p>
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
  $sql = " select * from tahun ";
  $hasil = mysqli_query($kdb, $sql) or die(mysql_error());
  return $hasil;
}

function sql_insert()
{
  global $kdb;
  global $_POST;
  $sql  = " insert into `tahun` (`tahun`, `publish`) values ( '".$_POST["tahun"]."', '".$_POST["publish"]."' )";
  mysqli_query($kdb, $sql) or die( mysql_error());
}

function sql_select_byid($idtahun)
{
  global $kdb;
  $sql = " select * from tahun where idtahun = ".$idtahun;
  $hasil2 = mysqli_query($kdb, $sql) or die(mysql_error());
  return $hasil2;
}

function sql_update()
{
  global $kdb;
  global $_POST;
  $sql  = " update  `tahun` set `tahun` = '".$_POST["tahun"]."', publish = '".$_POST["publish"]."' where idtahun = ".$_POST["idtahunx"];
  mysqli_query($kdb, $sql) or die( mysql_error());
}

function sql_delete()
{
  global $kdb;
  global $_POST;
  $sql  = " delete from `tahun` where idtahun = ".$_POST["idtahunx"];
  mysqli_query($kdb, $sql) or die( mysql_error());
}

?>
