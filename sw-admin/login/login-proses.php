<?PHP session_start();
require_once'../../sw-library/sw-config.php'; 
include_once'../../sw-library/sw-function.php';
	$salt 			= '$%DSuTyr47542@#&*!=QxR094{a911}+';
	$ip_login 		= $_SERVER['REMOTE_ADDR'];
	$created_login	= date('Y-m-d H:i:s');
	$iB 			= getBrowser();
	$browser 		= $iB['name'].' '.$iB['version'];

if (isset($_GET['username'])){

	$username 	= htmlentities($_GET['username']);
	$password 	= hash('sha256',$salt.$_GET['password']);
	$session	= md5(rand(1000,9999).rand(19078,9999).date('ymdhisss'));

	$update = mysqli_query($connection,"UPDATE user set created_login='$created_login',session='-' where password='$password'") or die (mysqli_error($connection));

$query_login = "SELECT * FROM user WHERE username='$username' AND password='$password'";
	$result_login = $connection->query($query_login);
	$login_num = $result_login->num_rows;
	$row 	= $result_login->fetch_assoc();

	$SESSION_USER		= 	$row['session'];
	$SESSION_ID 		=	strip_tags($row['user_id']);
	$fullname			=	$row['fullname'];
	$username			=	strip_tags($row['username']);
		
	$pesan = "Saat ini [".$fullname."] Sedang Membuka Halaman Admin
	[Detail Akun] :
	Nama  	  : ".$fullname."
	Username  : ".$username."
	Ip		  : ".$ip_login."
	Tgl Login : ".$created_login."
	Browser : ".$browser."
	\n
	Hormat Kami,\nTim S-widodo.com\n
	Pesan noreply";

	$to = 'emailanda@gmail.com'; //ubah email anda
	$subject = 'Admin Online';
	$headers = "From: $site_email_domain <$site_email_domain>\r\n";//email domain

if($login_num == '0'){
	  echo '{"response":{"error": "0"}}';
	} 
else {
	echo '{"response":{"error": "1"}}';
///session
	$_SESSION['SESSION_USER']		= $SESSION_USER;
	$_SESSION['SESSION_ID']			= $SESSION_ID;
	//mail($to, $subject, $pesan, $headers); aktifkan jika ingin dapat notif login
}}