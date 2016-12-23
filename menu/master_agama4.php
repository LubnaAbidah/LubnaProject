<?php
$a = !empty($_GET['a']) ? $_GET['a'] : "reset";
$idagama = !empty($_GET['id']) ? $_GET['id'] : " ";
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
    case "edit"  :  curd_update($idagama); break;
    case "hapus"  :  curd_delete($idagama); break;
    default : curd_read(); break;
}
  mysqli_close($kdb);

function curd_read()
{
  $hasil = sql_select();
  $i=1;
  ?>
  <H3> MASTER DATA AGAMA  </H3>
  <a href="index.php?menu=2&a=tambah">
    <button type="button" name="button" class="btn btn-default btn-sm">
      <span class="glyphicon glyphicon-plus"></span> CREATE
    </button>
  </a><br><br>
  <table class="table table-hover table-bordered table-striped table-condensed">
    <thead class="text-center">
      <tr>
        <td>No</td>
        <td>ID Agama</td>
        <td>Agama</td>
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
      <td><?php echo $baris['idagama']; ?></td>
      <td><?php echo $baris['nmagama']; ?></td>
      <td><?php if($baris['publish']=='T' ) {echo "<span class=\"glyphicon glyphicon-ok\"></span>";} else {echo "<span class=\"glyphicon glyphicon-remove\"></span>";} ?></td>
      <td>
      <a href="index.php?menu=2&a=edit&id=<?php echo $baris['idagama']; ?>" class="btn btn-info btn-sm">
          <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
      </a>
      <a href="index.php?menu=2&a=hapus&id=<?php echo $baris['idagama']; ?>" class="btn btn-danger btn-sm">
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
<td width="200px">Agama</td>
<td><input type="text" name="nmagama" id="nmagama" maxlength="25" size="25" value="<?php  echo trim($row["nmagama"]) ?>" class="form-control"></td>
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
<h3>Penambahan Data Agama</h3><br>

<br>
<form action="index.php?menu=2&a=reset" method="post">
<input type="hidden" name="sql" value="insert" >
<?php
$row = array(
  "nmagama" => "",
  "publish" => "T");
formeditor($row)
?>
<p>
  <input type="submit" name="action" value="Simpan" class="btn btn-default"> <a href="index.php?menu=2&a=reset" class="btn btn-default" >Batal</a>
</p>
</form>
<?php } ?>

<?php
function curd_update($idagama)
{
global $kdb;
$hasil2 = sql_select_byid($idagama);
$row = mysqli_fetch_array($hasil2);
?>
<h3>Pengubahan Data Agama</h3><br>

<br>
<form action="index.php?menu=2&a=reset" method="post">
<input type="hidden" name="sql" value="update" >
<input type="hidden" name="idagamax" value="<?php  echo $idagama; ?>" >
<?php
formeditor($row)
?>
<p><input type="submit" name="action" value="Update" class="btn btn-info "> <a href="index.php?menu=2&a=reset" class="btn btn-default">Batal</a></p>
</form>
<?php } ?>

<?php
function curd_delete($idagama)
{
global $kdb;
$hasil2 = sql_select_byid($idagama);
$row = mysqli_fetch_array($hasil2);
?>
<h3>Penghapusan Data Agama</h3><br>
<br>
<form action="index.php?menu=2&a=reset" method="post">
<input type="hidden" name="sql" value="delete" >
<input type="hidden" name="idagamax" value="<?php  echo $idagama; ?>" >
<h4>
    <span class="glyphicon glyphicon-alert"> </span>
    Anda yakin akan menghapus data agama <?php echo $row['nmagama'];?> ?
</h4>
<br>
<p>
  <input type="submit" name="action" value="Delete" class="btn btn-danger">
  <a href="index.php?menu=2&a=reset" class="btn btn-default">Batal</a>
</p>
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
  $sql = " select * from agama ";
  $hasil = mysqli_query($kdb, $sql) or die(mysql_error());
  return $hasil;
}

function sql_insert()
{
  global $kdb;
  global $_POST;
  $sql  = " insert into `agama` (`nmagama`, `publish`) values ( '".$_POST["nmagama"]."', '".$_POST["publish"]."' )";
  mysqli_query($kdb, $sql) or die( mysql_error());
}

function sql_select_byid($idagama)
{
  global $kdb;
  $sql = " select * from agama where idagama = ".$idagama;
  $hasil2 = mysqli_query($kdb, $sql) or die(mysql_error());
  return $hasil2;
}

function sql_update()
{
  global $kdb;
  global $_POST;
  $sql  = " update  `agama` set `nmagama` = '".$_POST["nmagama"]."', publish = '".$_POST["publish"]."' where idagama = ".$_POST["idagamax"];
  mysqli_query($kdb, $sql) or die( mysql_error());
}

function sql_delete()
{
  global $kdb;
  global $_POST;
  $sql  = " delete from `agama` where idagama = ".$_POST["idagamax"];
  mysqli_query($kdb, $sql) or die( mysql_error());
}

?>
