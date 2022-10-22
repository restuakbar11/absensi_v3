<?php
if(empty($connection)){
  header('location:../../');
} else {
  include_once 'sw-mod/sw-panel.php';

  $query_employees ="SELECT id FROM employees";
  $result_count = $connection->query($query_employees);

  $query_position ="SELECT position_id FROM position";
  $result_count_position = $connection->query($query_position);

  $query_building ="SELECT building_id FROM building";
  $result_count_building = $connection->query($query_building);

  $query_shift ="SELECT shift_id FROM shift";
  $result_count_shift = $connection->query($query_shift);


echo'
<div class="content-wrapper">
<section class="content">
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>'.$result_count->num_rows.'</h3>
              <p>Karyawan</p>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
              <a href="./karyawan" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>'.$result_count_position->num_rows.'</h3>
              <p>Jabatan</p>
            </div>
            <div class="icon">
              <i class="fa fa fa-briefcase"></i>
            </div>
            <a href="./jabatan" class="small-box-footer">
             More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3>'.$result_count_building->num_rows.'</h3>
              <p>Lokasi Kantor</p>
            </div>
            <div class="icon">
              <i class="fa fa-building"></i>
            </div>
            <a href="./lokasi" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>'.$result_count_shift->num_rows.'</h3>
              <p>Jam Kerja</p>
            </div>
            <div class="icon">
              <i class="fa fa-retweet"></i>
            </div>
            <a href="./shift" class="small-box-footer">
              More Info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Statistik Absensi</h3>
        </div>
          <div class="box-body">
            <div class="chart">
               <canvas id="areaChart" style="height:300px"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Absensi Hari ini</h3>
        </div>
          <div class="box-body no-padding">
            <table class="table">
              <tbody>
                <tr>
                  <th style="width: 10px" class="text-center">No.</th>
                  <th>Nama</th>
                  <th>Jam Masuk</th>
                  <th>Jam Pulang</th>
                  <th class="text-right">Aksi</th>
                </tr>
                <tr>';
                $query_absent_day ="SELECT presence.employees_id,presence.time_in,presence.time_out,employees.employees_name FROM presence,employees WHERE presence.employees_id=employees.id AND presence.presence_date='$date' ORDER BY presence.presence_id LIMIT 10";
                $result_absent_day = $connection->query($query_absent_day);
                if($result_absent_day->num_rows > 0){
                $no=0;
                while ($row = $result_absent_day->fetch_assoc()) {
                  $no++;
                  echo'
                  <td class="text-center">'.$no.'</td>
                  <td>'.$row['employees_name'].'</td>
                  <td>'.$row['time_in'].'</td>
                  <td>'.$row['time_out'].'</td>
                  <td class="text-right"><a href="absensi&op=views&id='.epm_encode($row['employees_id']).'" class="btn btn-warning btn-xs"><i class="fa fa-external-link-square" aria-hidden="true"></i></a></td>
                </tr>';}}
                echo'
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Permohonan Cuti</h3>
          <div class="box-tools pull-right">
            <a href="cuty" class="btn btn-success btn-flat">Data Cuti</a>
          </div>
        </div>
          <div class="box-body no-padding">
          <table class="table">
            <tbody>
                <tr>
                  <th style="width: 10px" class="text-center">No.</th>
                  <th>Nama</th>
                  <th>Tanggal Cuti</th>
                  <th class="text-center">Jumlah</th>
                  <th class="text-right">Masuk Kerja</th>
                </tr>
                <tr>';
                $query_cuty="SELECT employees.employees_name,cuty.* FROM employees,cuty WHERE employees.id=cuty.employees_id AND cuty.cuty_status='3' order by cuty.cuty_id DESC LIMIT 10";
                $result_cuty = $connection->query($query_cuty);
                if($result_cuty->num_rows > 0){
                $no=0;
                while ($row_cuty= $result_cuty->fetch_assoc()) {
                $no++;
                  echo'
                  <td class="text-center">'.$no.'</td>
                  <td>'.$row_cuty['employees_name'].'</td>
                  <td>'.tgl_ind($row_cuty['cuty_start']).' sampai '.tgl_ind($row_cuty['cuty_end']).'</td>
                  <td class="text-center"><label class="label label-warning">'.$row_cuty['cuty_total'].'</label></td>
                  <td class="text-right">'.tgl_ind($row_cuty['date_work']).'</td>
                </tr>';}
                }
          echo'
            </tbody>
          </table>
          </div>
        </div>
      </div>
  </div>
</section>
</div>';


  $date = date("d-m-Y",strtotime("-6 days"));
    $D = substr($date,0,2);
    $M = substr($date,3,2)-1;
    $Y = substr($date,6,4);
    $tgl_skrg = date("Y-m-d");
    $seminggu = strtotime("-1 week +1 day",strtotime($tgl_skrg));
    $hasilnya = date('Y-m-d', $seminggu);
    //visitor
    for ($i=0; $i<=6; $i++){
      $tgl_pengujung   = strtotime("+$i day",strtotime($hasilnya));
      $hasil_pengujung = date("Y-m-d", $tgl_pengujung);
      $tanggal_visitor []= tgl_ind($hasil_pengujung);
      $query_absensi ="SELECT presence_date FROM presence WHERE presence_date='$hasil_pengujung'";
      $result_absensi = $connection->query($query_absensi);
      $absensi [] = $result_absensi->num_rows;

    }
 $tanggal_visitor = implode('","',$tanggal_visitor);?>
 <script type="text/javascript">
    var lineChartData = {
      labels :["<?php echo $tanggal_visitor;?>"],
      datasets : [
        {
          label: "Statistik Absensi",
          fillColor : "rgba(29,75,251,0.7)",
          strokeColor : "rgba(220,220,220,1)",
          pointColor : "rgba(220,220,220,1)",
          pointStrokeColor : "#fff",
          pointHighlightFill : "#fff",
          pointHighlightStroke : "rgba(220,220,220,1)",
          data :<?php echo json_encode($absensi);?>

        }
      ]

    }

  window.onload = function(){
    var ctx = document.getElementById("areaChart").getContext("2d");
    window.myLine = new Chart(ctx).Line(lineChartData, {
      responsive: true
    });
  }
 
</script>
<?PHP
}?>
