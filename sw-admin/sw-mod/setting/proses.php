<?php
session_start();
if(empty($_SESSION['SESSION_USER']) && empty($_SESSION['SESSION_ID'])){
    header('location:../../login/');
 exit;}
else {
require_once'../../../sw-library/sw-config.php';
require_once'../../login/login_session.php';
include('../../../sw-library/sw-function.php'); 
$extensionList = array("jpg", "png", "ico");
switch (@$_GET['action']){
/* ------------------------------
    Update
---------------------------------*/
case 'update':

if($level_user ==1){
$error = array();
if (empty($_POST['site_name'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $site_name = mysqli_real_escape_string($connection, $_POST['site_name']);
}

if (empty($_POST['site_description'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $site_description = mysqli_real_escape_string($connection,$_POST['site_description']);
}

if (empty($_POST['site_phone'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $site_phone = mysqli_real_escape_string($connection,$_POST['site_phone']);
}


if (empty($_POST['site_address'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $site_address = mysqli_real_escape_string($connection,$_POST['site_address']);
}

if (empty($_POST['site_email'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $site_email = mysqli_real_escape_string($connection,$_POST['site_email']);
}

if (empty($_POST['site_email_domain'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $site_email_domain = mysqli_real_escape_string($connection,$_POST['site_email_domain']);
}


if (empty($_POST['site_url'])) {
  $error[] = 'tidak boleh kosong';
} else {
  $site_url = mysqli_real_escape_string($connection,$_POST['site_url']);
}

$site_logo    = $_FILES['site_logo']["name"];
$file_tmp = $_FILES['site_logo']['tmp_name']; 
$ukuran_file  = $_FILES['site_logo']['size'];


if($site_logo == ''){
  if (empty($error)) { 
    $update = "UPDATE sw_site SET site_url='$site_url',
                      site_name='$site_name',
                      site_phone='$site_phone',
                      site_address='$site_address',
                      site_description='$site_description',
                      site_email='$site_email',
                      site_email_domain='$site_email_domain' WHERE site_id='1'"; 
    if($connection->query($update) === false) { 
      die($connection->error.__LINE__); 
        echo'Data tidak berhasil disimpan!';
    } else{
        echo'success';
    }}
    else{           
        echo'Bidang inputan tidak boleh ada yang kosong..!';
    }
}else{
  $query= mysqli_query($connection,"SELECT site_logo from sw_site WHERE site_id='1'");
  $data   = mysqli_fetch_assoc($query);
  $images_delete = strip_tags($data['site_logo']);
  $tmpfile = "../../../sw-content/".$images_delete;
  
  if(file_exists("../../../sw-content/$images_delete")){
      unlink ($tmpfile);
  }

  $x = explode('.', $site_logo);
  $ekstensi = strtolower(end($x));
  $nama_file      =''.seo_title($site_logo).'';
  $nama_file_unik = ''.$nama_file.'.'.$ekstensi.'';
  $namaDir        = '../../../sw-content/';
  $pathFile       = $namaDir;

if(in_array($ekstensi, $extensionList) === true){
if($ukuran_file < 1044070){
  
  $update = "UPDATE sw_site SET site_url='$site_url',
                      site_name='$site_name',
                      site_phone='$site_phone',
                      site_address='$site_address',
                      site_description='$site_description',
                      site_logo='$nama_file_unik',
                      site_email='$site_email',
                      site_email_domain='$site_email_domain' WHERE site_id='1'" or die($connection->error.__LINE__); 
      if($connection->query($update) === false) { 
        echo'Data tidak berhasil disimpan!';
      }else{
        echo'success';
        move_uploaded_file($file_tmp, '../../../sw-content/'.$nama_file_unik);
      }
    }else{
      echo'Ukuran File terlalu besar, File harus berukuran maxsimal 1MB!';
    }
  }else{
    echo'Format file yang di upload tidak diperbolehkan, Format harus JPG,PNG!';
  }}

}else{
   echo'Anda tidak memiliki hak akses!';
}


// =========================
// Update Profile
// =========================
break;
case 'profile':
if($level_user ==1){
  $error = array();
  if (empty($_POST['site_company'])) {
          $error[] = 'tidak boleh kosong';
      } else {
      $site_company = anti_injection($_POST['site_company']);
  }

  if (empty($_POST['site_manager'])) {
          $error[] = 'tidak boleh kosong';
      } else {
      $site_manager = anti_injection($_POST['site_manager']);
  }

  if (empty($_POST['site_director'])) {
          $error[] = 'tidak boleh kosong';
      } else {
          $site_director = anti_injection($_POST['site_director']);
  }

  if (empty($error)) { 
  $update = "UPDATE sw_site SET site_company='$site_company',
                      site_manager='$site_manager',
                      site_director='$site_director' WHERE site_id='1'"; 
    if($connection->query($update) === false) { 
      die($connection->error.__LINE__); 
        echo'Data tidak berhasil disimpan!';
    } else{
        echo'success';
    }}
    else{           
        echo'Bidang inputan tidak boleh ada yang kosong..!';
    }

  }else{
     echo'Anda tidak memiliki hak akses!';
  }

break;
}}
