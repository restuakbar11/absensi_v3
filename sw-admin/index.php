<?php  //error_reporting(0);
/* Admin Panel
* (c) 08 Agustus 2021
*/
@session_start();
require_once'../sw-library/sw-config.php';
include_once '../sw-library/sw-function.php';
if(empty($_SESSION['SESSION_USER']) && empty($_SESSION['SESSION_ID'])){
    header('location:./login/');
 exit;}

else{
  require_once'./login/login_session.php';
  //ob_start("minify_html");
  $dbhostsql      = DB_HOST;
  $dbusersql      = DB_USER;
  $dbpasswordsql  = DB_PASSWD;
  $dbnamesql      = DB_NAME;
  $connection     = mysqli_connect($dbhostsql, $dbusersql, $dbpasswordsql, $dbnamesql ) or die( mysqli_error($connection));
  
  $website_url        = $row_site['site_url'];
  $website_name       = $row_site['site_name'];
  $website_phone      = $row_site['site_phone'];
  $website_addres     = $row_site['site_address'];
  $meta_description   = $row_site['site_description'];
  $website_logo       = $row_site['site_logo'];
  $website_email      = $row_site['site_email'];

  $iB = getBrowser();
  $browser= $iB['name'];
  $host_name =gethostbyaddr($_SERVER['REMOTE_ADDR']);
  $tgl_active  = date('Y-m-d');

if(!empty($_GET['mod'])){
  $mod = mysqli_escape_string($connection, @$_GET['mod']);}else {$mod ='home';}
  include_once 'sw-mod/sw-header.php';
  //include_once 'sw-mod/sw-footer.php';
      ob_start();
if(file_exists('./sw-mod/'.$mod.'/'.$mod.'.php')){
      include('sw-mod/'.$mod.'/'.$mod.'.php');
      include_once 'sw-mod/sw-footer.php';
      //theme_foot();
}else{
      include('sw-mod/home/home.php');
      include_once 'sw-mod/sw-footer.php';
      //theme_foot();
    }
  }
  //ob_end_flush(); // minify_html
?>