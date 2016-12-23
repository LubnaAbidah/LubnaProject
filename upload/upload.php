<html>     
<body>    
<form enctype="multipart/form-data" action="" method="POST">      
      Pilih file yang akan diupload: </br>       
      <input name="userfile" type="file" />    <br />      
      <input type="submit" name="enter" value="Upload" />      
</form>   
<?php
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
 
 //pada contoh berikut file akan dipload ke direktori image  
 $dir_upload = "image/";  
 
 //buat nama untuk file hasil upload  
 $file_upload = $dir_upload . basename($file_name);  
 
 //cek keberadaan file hasil upload di server  
 if(file_exists($file_upload))  
 {  
      echo "Maaf, File yang sama sudah ada pada server <br />";  
      $err_upload=1;  
 }  
 
 //buat batasan maksimal ukuran file yang boleh diupload (dalam byte)  
 $max_size_upload=1000000;   
 
 //cek apakah ukuran file yang diupload melebihi batas  
 if($file_size > $max_size_upload)  
 {  
      echo "Maaf, Ukuran file yang diupload melebihi ".$max_size_upload." byte <br /> ";  
      $err_upload=1;  
 }  
 
 //cek hanya type JPG, GIF dan PNG saja yang diijinkan  
 if(($file_type!="image/jpeg") 
	 && ($file_type!="image/gif") 
	 && ($file_type!="image/png"))  
 {  
      echo "Maaf, Hanya file JPG , GIF dan PNG saja yang diperbolehkan <br /> ";  
      $err_upload=1;  
 }  
 
 //tampilkan error jika terjadi kesalahan  
 if($err_upload)  
 {  
      echo "Ada Error, proses upload file batal";  
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
?>
</body>     
</html>   