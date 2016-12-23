<?php
session_start();
mysql_connect("localhost","root","") or die("Nggak bisa koneksi");
mysql_select_db("dtmhs");
$nmuser = $_POST['nmuser'];
$psw = $_POST['psw'];
$op = $_GET['op'];
if($op=="in"){
    $cek = mysql_query("SELECT * FROM user WHERE nmuser='$nmuser' AND password='$psw' AND publish='T' ");
    if(mysql_num_rows($cek)==1){
        $c = mysql_fetch_array($cek);
        $_SESSION['nmuser'] = $c['nmuser'];
            header("location:index.php");
    }else{
         die("username / password salah <a href=\"javascript:history.back()\">kembali</a>");
    }
}else if($op=="out"){
    unset($_SESSION['nmuser']);
    header("location:index.php");
}
?>