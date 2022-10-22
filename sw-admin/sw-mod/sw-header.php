<?php if(empty($connection)){
  header('location:./404');
} else {
$query="SELECT presence.employees_id,presence.time_in,presence.time_out,employees.employees_name FROM presence,employees WHERE presence.employees_id=employees.id AND presence.presence_date='$date' ORDER BY presence.presence_id DESC LIMIT 10";
$result_notif = $connection->query($query);

$query_cuty_notif ="SELECT employees.employees_name,cuty.* FROM employees,cuty WHERE employees.id=cuty.employees_id AND cuty.cuty_status='3' order by cuty.cuty_id";
$result_cuty_notif  = $connection->query($query_cuty_notif);
echo'
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dasboard | '.$site_name.'</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta http-equiv="cache-control" content="no-cache">
  <meta http-equiv="Pragma" content="no-cache">
  <meta name="robots" content="noindex">
  <meta name="googlebot" content="noindex">
  <meta name="mobile-web-app-capable" content="yes">
  
  <link rel="shortcut icon" href="'.$site_url.'/sw-content/favicon.png">
  <link rel="apple-touch-icon" href="'.$site_url.'/sw-content/favicon.png">
  <link rel="apple-touch-icon" sizes="72x72" href="'.$site_url.'/sw-content/favicon.png">
  <link rel="apple-touch-icon" sizes="114x114" href="'.$site_url.'/sw-content/favicon.png">
  <link rel="stylesheet" href="./sw-assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="./sw-assets/css/AdminLTE.min.css">
  <link rel="stylesheet" href="./sw-assets/css/skin-blue-light.css">
  <link rel="stylesheet" href="./sw-assets/css/font-awesome.css">
  <link rel="stylesheet" href="./sw-assets/css/sw-custom.css">
  <link rel="stylesheet" href="./sw-assets/plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="./sw-assets/plugins/timepicker/bootstrap-timepicker.min.css">
  <link rel="stylesheet" type="text/css" href="./sw-assets/css/simple-lightbox.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">';
  if($mod =='pendaftar'){
  echo'
  <link rel="stylesheet" href="./sw-assets/plugins/select2/dist/css/select2.min.css">';}
  if($mod =='setting-pendaftaran'){
    echo'
  <link rel="stylesheet" href="./sw-assets/plugins/datepicker/datepicker3.css">';
}
  if($mod=='absensi'){
  echo'
    <link rel="stylesheet" href="../sw-mod/sw-assets/js/plugins/magnific-popup/magnific-popup.css">';
  }
  echo'
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- </head> -->
</head>
<body class="sidebar-mini skin-blue-light fixed">';
echo'<div class="wrapper">
    <div class="loading"></div>
<header class="main-header">
    <!-- Logo -->
    <a href="./" class="logo">
      <span class="logo-mini"><b>ABSENSI</span>
      <span class="logo-lg"><b>'.strtoupper($site_name).'</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      
      <div class="navbar-custom-menu pull-left">
        <ul class="nav navbar-nav">
            <li><a href="#">'.tanggal_ind($date).'</a></li>
        </ul>
      </div>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        
        <li><a href="../" target="_blank"><i class="fa fa-desktop" aria-hidden="true"></i></a></li>

        <!-- Notifications: style can be found in dropdown.less -->
        <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-calendar" aria-hidden="true"></i>
              <span class="label label-warning">'.$result_cuty_notif->num_rows.'</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Anda memiliki '.$result_cuty_notif->num_rows.' notifikasi</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">';
                while ($row_cuty = $result_cuty_notif->fetch_assoc()) {
                  echo'
                  <li>
                    <a href="cuty">
                      '.$row_cuty['employees_name'].'<br>
                      Tgl Cuti : '.tgl_ind($row_cuty['cuty_start']).' sampai '.tgl_ind($row_cuty['cuty_end']).'<br>
                      <label class="label label-warning">Jumlah: '.$row_cuty['cuty_total'].'</label>
                    </a>
                  </li>';
                }
                echo'
                </ul>
              </li>
            </ul>
        </li>
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">'.$result_notif->num_rows.'</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Anda memiliki '.$result_notif->num_rows.' notifikasi</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">';
                while ($row= $result_notif->fetch_assoc()) {
                  echo'
                  <li>
                    <a href="absensi&op=views&id='.epm_encode($row['employees_id']).'">
                      '.$row['employees_name'].'<br>
                      <i class="fa fa-sign-in text-aqua"></i>Absen Masuk : '.$row['time_in'].'<br>';
                  if($row['time_out']=='00:00:00'){}else{
                      echo'
                      <i class="fa fa-sign-out text-aqua"></i>Absen Pulang : '.$row['time_out'].'';}
                    echo'
                    </a>
                  </li>';
                }
                echo'
                </ul>
              </li>
            </ul>
          </li>

        <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">'.strip_tags(substr($row_user['fullname'],0,10)).' <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">';?>
                <li><a href="javascript:void();" onClick="location.href='./logout';"><i class="fa fa-sign-out"></i> Logout</a></li>
              </ul>
            </li>
          
        </ul>
      </div>
    </nav>
  </header>
<?PHP }?>