<?php 
if ($mod ==''){
    header('location:../404');
    echo'kosong';
}else{
    include_once 'sw-mod/sw-header.php';
    $tgl_skg = date('Y-m-d');
if(!isset($_COOKIE['COOKIES_MEMBER'])){
 echo'
 <!-- App Capsule -->
    <div id="appCapsule">
        <div class="section mt-2 text-center">
            <h1>Masuk</h1>
            <h4>Isi formulir untuk masuk</h4>
        </div>
        <div class="section mb-5 p-2">

            <form id="form-login">
                <div class="card">
                    <div class="card-body pb-1">
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="email1">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail Anda">
                                <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                            </div>
                        </div>
        
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="password1">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Kata sandi Anda">
                                <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-links mt-2">
                    <div>
                        <a href="registrasi">Mendaftar</a>
                    </div>
                    <div><a href="forgot" class="text-muted">Lupa Password?</a></div>
                </div>

                <div class="form-button-group  transparent">
                   <button type="submit" class="btn btn-primary btn-block"><ion-icon name="log-in-outline"></ion-icon> Masuk</button>
                   <a href="oauth/google" class="btn btn-danger btn-block"><ion-icon name="logo-google"></ion-icon> Masuk Dengan Google</a>
                </div>

            </form>
        </div>

    </div>
    <!-- * App Capsule -->';}
  else{

  echo'<!-- App Capsule -->
    <div id="appCapsule">
        <!-- Wallet Card -->
        <div class="section wallet-card-section pt-1">
            <div class="wallet-card">
                <!-- Balance -->
                <div class="balance">
                    <div class="left">
                        <span class="title"> Selamat '.$salam.'</span>
                        <h1 class="total">'.ucfirst($row_user['employees_name']).'</h1>
                    </div>
                </div>
                <!-- * Balance -->
                <!-- Wallet Footer -->
                <div class="wallet-footer">
                    <div class="item">
                        <a href="./absent">
                            <div class="icon-wrapper bg-danger">
                                <ion-icon name="camera-outline"></ion-icon>
                            </div>
                            <strong>Absen</strong>
                        </a>
                    </div>


                    <div class="item">
                        <a href="./cuty">
                            <div class="icon-wrapper bg-primary">
                               <ion-icon name="calendar-outline"></ion-icon>
                            </div>
                            <strong>Cuti</strong>
                        </a>
                    </div>
                   
                    <div class="item">
                        <a href="./history">
                            <div class="icon-wrapper bg-success">
                               <ion-icon name="document-text-outline"></ion-icon>
                            </div>
                            <strong>History</strong>
                        </a>
                    </div>

                    <div class="item">
                        <a href="./profile">
                            <div class="icon-wrapper bg-warning">
                               <ion-icon name="person-outline"></ion-icon>
                            </div>
                            <strong>Profil</strong>
                        </a>
                    </div>


                </div>
                <!-- * Wallet Footer -->
            </div>
        </div>
        <!-- Wallet Card -->

    <!-- Label Absensi Hari ini -->
    <div class="section">
        <div class="row mt-2">';
            if($result_absent->num_rows > 0){
                echo'
                <div class="col-6 col-md-3 mb-2">
                    <div class="stat-box bg-danger">
                        <div class="title text-white">Absen Masuk</div>
                        <div class="value text-white">'.$row_absent['time_in'].'</div>
                    </div>
                </div>';

                if($row_absent['time_out']=='00:00:00'){
                echo'
                <div class="col-6 col-md-3 mb-2">
                    <a href="./absent"><div class="stat-box bg-success">
                        <div class="title text-white">Absen Pulang</div>
                        <div class="value text-white">Belum absen</div>
                    </div></a>
                </div>';
                }else{
                echo'
                <div class="col-6 col-md-3 mb-2">
                    <div class="stat-box bg-success">
                        <div class="title text-white">Absen Pulang</div>
                        <div class="value text-white">'.$row_absent['time_out'].'</div>
                    </div>
                </div>';
                }
            } 
            else{
                echo'
                <div class="col-6 col-md-3 mb-2">
                    <a href="./absent"><div class="stat-box bg-danger">
                        <div class="title text-white">Absen Masuk</div>
                        <div class="value text-white">Belum absen</div>
                    </div></a>
                </div>

                <div class="col-6 col-md-3 mb-2">
                    <div class="stat-box bg-secondary">
                        <div class="title text-white">Absen Pulang</div>
                        <div class="value text-white">Belum Absen</div>
                    </div>
                </div>';
            }
            $query_absent_lembur   ="SELECT employees_id,time_in,time_out FROM presence_lembur WHERE employees_id='$row_user[id]' AND presence_date='$tgl_skg'";
            $result_absen_lembur = $connection->query($query_absent_lembur);
            if ($result_absen_lembur->num_rows > 0) {
                while($row_absen_lembur     = $result_absen_lembur->fetch_assoc()){
                    echo '<div class="col-6 col-md-3 mb-2">
                    <div class="stat-box bg-primary">
                        <div class="title text-white">Absen Lembur</div>
                        <div class="value text-white">'.$row_absen_lembur['time_in'].'</div>
                    </div>
                </div>';
                    if ($row_absen_lembur['time_out']=='00:00:00') {
                        echo '<div class="col-6 col-md-3 mb-2">
                            <a href="./lembur"><div class="stat-box bg-secondary">
                                <div class="title text-white">Absen Lembur</div>
                                <div class="value text-white">Selesai Lembur</div>
                            </div></a>
                            </div>';
                    }else{
                        echo '<div class="col-6 col-md-3 mb-2">
                            <div class="stat-box bg-secondary">
                                <div class="title text-white">Absen Lembur</div>
                                <div class="value text-white">'.$row_absen_lembur['time_out'].'</div>
                            </div>
                            </div>';
                    }
                }
                

                
            }else{
                    echo '<div class="col-6 col-md-3 mb-2">
                    <a href="./lembur"><div class="stat-box bg-primary">
                        <div class="title text-white">Absen Lembur</div>
                        <div class="value text-white">Mulai Lembur</div>
                    </div></a>
                </div>
                <div class="col-6 col-md-3 mb-2">
                   <div class="stat-box bg-secondary">
                        <div class="title text-white">Absen Lembur</div>
                        <div class="value text-white">Selesai Lembur</div>
                    </div>
                </div>'; 
            }
        echo' 
        </div>
    </div>


    <div class="section mt-4">
        <div class="section-title mb-1">Absensi Bulan
            <select class="select select-change text-primary" required>';
                if($month ==1){echo'<option value="01" selected>Januari</option>';}else{echo'<option value="01">Januari</option>';}
                if($month ==2){echo'<option value="02" selected>Februari</option>';}else{echo'<option value="02">Februari</option>';}
                if($month ==3){echo'<option value="03" selected>Maret</option>';}else{echo'<option value="03">Maret</option>';}
                if($month ==4){echo'<option value="04" selected>April</option>';}else{echo'<option value="04">April</option>';}
                if($month ==5){echo'<option value="05" selected>Mei</option>';}else{echo'<option value="05">Mei</option>';}
                if($month ==6){echo'<option value="06" selected>Juni</option>';}else{echo'<option value="06">Juni</option>';}
                if($month ==7){echo'<option value="07" selected>Juli</option>';}else{echo'<option value="07">Juli</option>';}
                if($month ==8){echo'<option value="08" selected>Agustus</option>';}else{echo'<option value="08">Agustus</option>';}
                if($month ==9){echo'<option value="09" selected>September</option>';}else{echo'<option value="09">September</option>';}
                if($month ==10){echo'<option value="10" selected>Oktober</option>';}else{echo'<option value="10">Oktober</option>';}
                if($month ==11){echo'<option value="12" selected>November</option>';}else{echo'<option value="12">November</option>';}
                if($month ==12){echo'<option value="12" selected>Desember</option>';}else{echo'<option value="12">Desember</option>';}
              echo'
            </select><span class="text-primary">'.$year.'</span>
        </div>
        <div class="transactions">
            <div class="row">
                <div class="load-home" style="display:contents"></div>   
            </div>
            </div>
        </div>

    <div class="section">
        <div class="row mt-2"> 
        <div class="col-6">
            <div class="section-title">1 Minggu Terakhir Absen Kerja</div>
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-dark rounded bg-danger">
                        <thead>
                            <tr>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Jam Masuk</th>
                                <th scope="col">Jam Pulang</th>
                            </tr>
                        </thead>
                        <tbody>';
                        $query_absen="SELECT presence_date,time_in,time_out FROM presence WHERE MONTH(presence_date) ='$month' AND employees_id='$row_user[id]' ORDER BY presence_id DESC LIMIT 6";
                        $result_absen = $connection->query($query_absen);
                        if($result_absen->num_rows > 0){
                            while ($row_absen= $result_absen->fetch_assoc()) {
                            echo'
                            <tr>
                                <th scope="row">'.tgl_ind($row_absen['presence_date']).'</th>
                                <td>'.$row_absen['time_in'].'</td>
                                <td>'.$row_absen['time_out'].'</td>
                            </tr>';
                        }}
                        echo'
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>

            <div class="col-6">
            <div class="section-title">1 Minggu Terakhir Absen Lembur</div>
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-dark rounded bg-primary">
                            <thead>
                                <tr>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Lembur Mulai</th>
                                    <th scope="col">Lembur Selesai</th>
                                </tr>
                            </thead>
                            <tbody>';
                            $query_absen="SELECT presence_date,time_in,time_out FROM presence_lembur WHERE MONTH(presence_date) ='$month' AND employees_id='$row_user[id]' ORDER BY presence_date desc LIMIT 6";
                            $result_absen = $connection->query($query_absen);
                            if($result_absen->num_rows > 0){
                                while ($row_absen= $result_absen->fetch_assoc()) {
                                echo'
                                <tr>
                                    <th scope="row">'.tgl_ind($row_absen['presence_date']).'</th>
                                    <td>'.$row_absen['time_in'].'</td>
                                    <td>'.$row_absen['time_out'].'</td>
                                </tr>';
                            }}
                            echo'
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>   
    </div>';

    }
  include_once 'sw-mod/sw-footer.php';
} ?>