<?php session_start();
    require_once'../../../sw-library/sw-config.php'; 
    require_once'../../../sw-library/sw-function.php';
    include_once'../../../sw-library/vendor/autoload.php';
if(empty($_SESSION['SESSION_USER']) && empty($_SESSION['SESSION_ID'])){
    //Kondisi tidak login
   header('location:../login/');
}

else{
  //kondisi login
switch (@$_GET['action']){

case 'print':
if (empty($_GET['id'])) {
      $error[] = 'ID tidak boleh kosong';
    } else {
      $id = mysqli_real_escape_string($connection,epm_decode($_GET['id']));
  }
if (empty($error)) {
$query="SELECT employees.employees_name,cuty.*,position.position_name FROM employees,cuty,position WHERE employees.position_id= position.position_id AND employees.id=cuty.employees_id AND cuty_id='$id'";
$result = $connection->query($query);
if($result->num_rows > 0){
$row    = $result->fetch_assoc();
echo'
<!DOCTYPE html>
<html>
<head>
    <title>Permohonan Cuti '.$row['employees_name'].'</title>
    <style>
    body{font-family:Arial,Helvetica,sans-serif}.container_box{position:relative}.container_box .row h3{line-height:25px;font-size:20px;margin:0px 0 10px;text-transform:uppercase}.container_box .text-center{text-align:center}.container_box .content_box{position:relative;margin-top:50px;}.container_box .content_box .des_info{margin:20px 0;text-align:right}.container_box h3{font-size:30px}table.customTable{width:100%;background-color:#fff;border-collapse:collapse;border-width:0px;border-color:#b3b3b3;border-style:solid;color:#000}table.customTable td,table.customTable th{border-width:0px;border-color:#b3b3b3;border-style:solid;padding:10px;text-align:left}table.customTable thead{background-color:#f6f3f8}.text-center{text-align:center}
    .label {display: inline;padding: .2em .6em .3em;font-size: 75%;font-weight: 700;line-height: 1;color: #fff;text-align: center;white-space: nowrap; vertical-align: baseline;border-radius: .25em;}
    .label-success{background-color: #00a65a !important;}.label-warning {background-color: #f0ad4e;}.label-info {background-color: #5bc0de;}.label-danger{background-color: #dd4b39 !important;}
    p{line-height:20px;padding:0px;margin: 5px;}.pull-right{float:right}
    .name-ttd{
      font-weight:bold;
      text-align:center;
      text-decoration: underline;
      margin-top:70px;
      text-transform:uppercase
    }
    hr{
      border-top: 1px solid black;
    }

    @media print {
      a[href]:after { content: none !important; }
      @page { margin: 0; }
      body  { margin: 1.6cm; }
    }
        </style>
  <script>
     window.onafterprint = window.close;
         window.print();
  </script>
</head>
<body>

<section class="container_box">
      <div class="row">
          <h3 class="text-center">PERMOHONAN PENGAMBILAN CUTI<br>'.$site_company.'</h3>
          <p class="text-center">'.$site_address.'</p>
          <hr>
        <div class="content_box">
          <p>Yth. HRD '.$site_company.'<br>
          di tempat<p>

          <p style="margin:20px 0px 10px 0px;">Dengan hormal,<br>
          yang bertanda tangan di bawah ini:<p>
          <table class="table customTable">
            <tbody>
              <tr>
                <td width="200">Nama</td>
                <td>: '.$row['employees_name'].'</td>
              </tr>
              <tr>
                <td>Jabatan</td>
                <td>: '.$row['position_name'].'</td>
              </tr>

              <tr>
                <td>Tanggal Pengambilan Cuti</td>
                <td>: '.tgl_ind($row['cuty_start']).' sampai '.tgl_ind($row['cuty_end']).'</td>
              </tr>
              <tr>
                <td>Tanggal Kembali Kerja</td>
                <td>: '.tgl_ind($row['date_work']).'</td>
              </tr>

              <tr>
                <td>Keperluan</td>
                <td>: '.strip_tags($row['cuty_description']).'</td>
              </tr>

            </tbody>
          </table>

          <p style="margin-top:20px;">Bermaksud mengajukan cuti tahunan selama '.$row['cuty_total'].' hari, yaitu pada <b>'.tgl_indo($row['cuty_start']).' hingga '.tgl_indo($row['cuty_end']).'</b>, saya akan mulai bekerja kembali pada <b>'.tgl_indo($row['date_work']).'</b></p>

          <p style="margin-top:20px;">Demikian permohonan cuti ini saya ajukan. Terimakasih atas perhatian Bapak/Ibu.</p>

          <p style="margin-top:50px">Tanggal '.tgl_indo($date).'</p>
          <center>
            <table class="table customTable" style="margin-top:10px;">
              <tbody>
                <tr>
                  <td class="text-center">Pemohon<p class="name-ttd">'.$row['employees_name'].'</p></td>
                  <td class="text-center">Menyetujui<p class="name-ttd">'.$site_manager.'</p></td>
                  <td class="text-center">Mengetahui<p class="name-ttd">'.$site_director.'</p></td>
                </tr>
              </tbody>
            </table>
          </center>

        </div>
</section>';
}else{
  echo'Data tidak ditemukan';
}
}

break;
  }
}?>