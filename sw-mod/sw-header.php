<?php if(empty($connection)){
  header('location:./404');
} else {
  ob_start("minify_html");
echo'
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
  <title>'.$website_name.'</title>
  <meta name="theme-color" content="#FF396F">
  <meta name="msapplication-navbutton-color" content="#FF396F">
  <meta name="apple-mobile-web-app-status-bar-style" content="#FF396F">

    <!-- Favicons -->
  <link rel="shortcut icon" href="'.$website_url.'/sw-content/favicon.png">
  <link rel="apple-touch-icon" href="'.$website_url.'/sw-content/favicon.png">
  <link rel="apple-touch-icon" sizes="72x72" href="'.$website_url.'/sw-content/favicon.png">
  <link rel="apple-touch-icon" sizes="114x114" href="'.$website_url.'/sw-content/favicon.png">
  
  <meta name="robots" content="index, follow">
  <meta name="description" content="'.$meta_description.'">
  <meta name="keywords" content="'.$meta_keyword.'">
  <meta name="author" content="'.$website_name.'">
  <meta http-equiv="Copyright" content="'.$website_name.'">
  <meta name="copyright" content="'.$website_name.'">
  <meta itemprop="image" content="sw-content/meta-tag.jpg">

  <link rel="stylesheet" href="sw-mod/sw-assets/css/style.css">
  <link rel="stylesheet" href="sw-mod/sw-assets/css/sw-custom.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">';
  if($mod =='history'){
    echo'
  <link rel="stylesheet" href="sw-mod/sw-assets/js/plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="sw-mod/sw-assets/js/plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="sw-mod/sw-assets/js/plugins/magnific-popup/magnific-popup.css">';
}

echo'
</head>

<body>
<div class="loading"><div class="spinner-border text-primary" role="status"></div></div>
  <!-- loader -->
    <div id="loader">
        <img src="'.$base_url.'sw-mod/sw-assets/img/logo-icon.png" alt="icon" class="loading-icon">
    </div>
    <!-- * loader -->';
if(isset($_COOKIE['COOKIES_MEMBER'])){
  echo'
<!-- App Header -->
    <div class="appHeader bg-danger text-light">
        <div class="left">
            <a href="#" class="headerButton" data-toggle="modal" data-target="#sidebarPanel">
                <ion-icon name="menu-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            <img src="'.$base_url.'sw-content/'.$site_logo.'" alt="logo" class="logo">
        </div>
        <div class="right">
            <div class="headerButton" data-toggle="dropdown" id="dropdownMenuLink" aria-haspopup="true">';
              if($row_user['photo'] ==''){
                echo'<img src="'.$base_url.'sw-content/avatar.jpg" alt="image" class="imaged w32">';
              }else{
                echo'
                <img src="timthumb?src='.$base_url.'sw-content/karyawan/'.$row_user['photo'].'&h=40&w=45" alt="image" class="imaged w32">';}
              echo'
               <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">';?>
                <a class="dropdown-item" onclick="location.href='./profile';" href="./profile"><ion-icon size="small" name="person-outline"></ion-icon>Profil</a>
                <a class="dropdown-item" onclick="location.href='./logout';" href="./logout"><ion-icon size="small" name="log-out-outline"></ion-icon>Keluar</a>
              </div>
            </div>
        </div>
            <div class="progress" style="display:none;position:absolute;top:50px;z-index:4;left:0px;width: 100%">
                <div id="progressBar" class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                    <span class="sr-only">0%</span>
                </div>
            </div>
    </div>
<?php
echo'<!-- App Sidebar -->
    <div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <!-- profile box -->
                    <div class="profileBox pt-2 pb-2">
                        <div class="image-wrapper">';
                        if($row_user['photo'] ==''){
                        echo'<img src="'.$base_url.'/sw-content/avatar.jpg" alt="image" class="imaged  w36">';
                        }else{
                        echo'<img src="timthumb?src='.$base_url.'sw-content/karyawan/'.$row_user['photo'].'&h=40&w=45" class="imaged  w36">';
                        }
                          echo'
                        </div>
                        <div class="in">
                            <strong>'.ucfirst($row_user['employees_name']).'</strong>
                            <div class="text-muted">'.$row_user['employees_code'].'</div>
                        </div>
                        <a href="#" class="btn btn-link btn-icon sidebar-close" data-dismiss="modal">
                            <ion-icon name="close-outline"></ion-icon>
                        </a>
                    </div>
                    <!-- * profile box -->
              
                    <!-- menu -->
                    <div class="listview-title mt-1">Absen</div>
                    <ul class="listview flush transparent no-line image-listview">
                        <li>
                            <a href="./" class="item">
                                <div class="icon-box bg-danger">
                                    <ion-icon name="home-outline"></ion-icon>
                                </div> Home 
                            </a>
                        </li>
                        <li>
                            <a href="./present" class="item">
                                <div class="icon-box bg-danger">
                                    <ion-icon name="scan-outline"></ion-icon>
                                </div>
                                    Absen
                            </a>
                        </li>

                        <li>
                            <a href="./cuty" class="item">
                                <div class="icon-box bg-danger">
                                  <ion-icon name="calendar-outline"></ion-icon>
                                </div>
                                  Cuti
                            </a>
                        </li>

                        <li>
                            <a href="./history" class="item">
                                <div class="icon-box bg-danger">
                                    <ion-icon name="document-text-outline"></ion-icon>
                                </div>
                                   History
                            </a>
                        </li>
                      
                        <li>
                            <a href="profile" class="item">
                                <div class="icon-box bg-danger">
                                    <ion-icon name="person-outline"></ion-icon>
                                </div>
                                    Profil
                            </a>
                        </li>

                        </li>
                        <li>
                            <a href="./logout" class="item">
                                <div class="icon-box bg-danger">
                                    <ion-icon name="log-out-outline"></ion-icon>
                                </div>
                                    Keluar
                            </a>
                        </li>

                    </ul>
                    <!-- * menu -->
                </div>
            </div>
        </div>
    </div>
    <!-- * App Sidebar -->';
  }
 }?>