<?php
$a = !empty($_GET['a']) ? $_GET['a'] : "reset";
$idjalurmasuk = !empty($_GET['id']) ? $_GET['id'] : " ";
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
    case "edit"  :  curd_update($idjalurmasuk); break;
    case "hapus"  :  curd_delete($idjalurmasuk); break;
    default : curd_read(); break;
}
  mysqli_close($kdb);

function curd_read()
{
  $hasil = sql_select();
  $i=1;
  ?>
  <H3> MASTER DATA JALUR MASUK  </H3>
  <a href="index.php?menu=4&a=tambah" class="btn btn-default btn-sm">
    <span class="glyphicon glyphicon-plus"></span> CREATE
  </a>
  <br><br>
  <table class="table table-bordered table-striped table-hover table-condensed">
    <thead class="text-center">
      <tr>
        <td>No</td>
        <td>ID Jalur Masuk</td>
        <td>Jalur Masuk</td>
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
          <td><?php echo $baris['idjalurmasuk']; ?></td>
          <td><?php echo $baris['nmjalurmasuk']; ?></td>
          <td><?php if($baris['publish']=='T' ) {echo "<span class=\"glyphicon glyphicon-ok\"></span>";} else {echo "<span class=\"glyphicon glyphicon-remove\"></span>";} ?></td>
          <td>
            <a href="index.php?menu=4&a=edit&id=<?php echo $baris['idjalurmasuk']; ?>" class="btn btn-info btn-sm">
              <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            </a>
            <a href="index.php?menu=4&a=hapus&id=<?php echo $baris['idjalurmasuk']; ?>" class="btn btn-danger btn-sm">
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
<td width="200px">Jalur Masuk</td>
<td><input type="text" name="nmjalurmasuk" id="nmjalurmasuk" maxlength="25" size="25" value="<?php  echo trim($row["nmjalurmasuk"]) ?>" class="form-control"></td>
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
<h3>Penambahan Data Jalur Masuk</h3><br>

<br>
<form action="index.php?menu=4&a=reset" method="post">
<input type="hidden" name="sql" value="insert" >
<?php
$row = array(
  "nmjalurmasuk" => "",
  "publish" => "T");
formeditor($row)
?>
<p><input type="submit" name="action" value="Simpan" class="btn btn-default"> <a href="index.php?menu=4&a=reset" class="btn btn-default">Batal</a></p>
</form>
<?php } ?>

<?php
function curd_update($idjalurmasuk)
{
global $kdb;
$hasil2 = sql_select_byid($idjalurmasuk);
$row = mysqli_fetch_array($hasil2);
?>
<h3>Pengubahan Data Jalur Masuk</h3><br>

<br>
<form action="index.php?menu=4&a=reset" method="post">
<input type="hidden" name="sql" value="update" >
<input type="hidden" name="idjalurmasukx" value="<?php  echo $idjalurmasuk; ?>" >
<?php
formeditor($row)
?>
<p><input type="submit" name="action" value="Update" class="btn btn-info"> <a href="index.php?menu=4&a=reset" class="btn btn-default">Batal</a></p>
</form>
<?php } ?>

<?php
function curd_delete($idjalurmasuk)
{
global $kdb;
$hasil2 = sql_select_byid($idjalurmasuk);
$row = mysqli_fetch_array($hasil2);
?>
<h3>Penghapusan Data Jalur Masuk</h3><br>

<form action="index.php?menu=4&a=reset" method="post">
<input type="hidden" name="sql" value="delete" >
<input type="hidden" name="idjalurmasukx" value="<?php  echo $idjalurmasuk; ?>" >
<h4>
  <span class="glyphicon glyphicon-alert"> </span>
  Anda yakin akan menghapus data Jalur Masuk <?php echo $row['nmjalurmasuk'];?> ?
</h4>
<br>
<p><input type="submit" name="action" value="Delete" class="btn btn-danger"> <a href="index.php?menu=4&a=reset" class="btn btn-default">Batal</a></p>
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
  $sql = " select * from jalurmasuk ";
  $hasil = mysqli_query($kdb, $sql) or die(mysql_error());
  return $hasil;
}

function sql_insert()
{
  global $kdb;
  global $_POST;
  $sql  = " insert into `jalurmasuk` (`nmjalurmasuk`, `publish`) values ( '".$_POST["nmjalurmasuk"]."', '".$_POST["publish"]."' )";
  mysqli_query($kdb, $sql) or die( mysql_error());
}

function sql_select_byid($idjalurmasuk)
{
  global $kdb;
  $sql = " select * from jalurmasuk where idjalurmasuk = ".$idjalurmasuk;
  $hasil2 = mysqli_query($kdb, $sql) or die(mysql_error());
  return $hasil2;
}

function sql_update()
{
  global $kdb;
  global $_POST;
  $sql  = " update  `jalurmasuk` set `nmjalurmasuk` = '".$_POST["nmjalurmasuk"]."', publish = '".$_POST["publish"]."' where idjalurmasuk = ".$_POST["idjalurmasukx"];
  mysqli_query($kdb, $sql) or die( mysql_error());
}

function sql_delete()
{
  global $kdb;
  global $_POST;
  $sql  = " delete from `jalurmasuk` where idjalurmasuk = ".$_POST["idjalurmasukx"];
  mysqli_query($kdb, $sql) or die( mysql_error());
}

?>
