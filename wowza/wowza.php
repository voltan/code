<?php 

// MYSQL DB
mysql_connect('localhost','','');
mysql_select_db('');

// Set source and copy path and FTP info
$source_path = '/usr/local/WowzaMediaServer/logs/';
$main_path = '/home/webx/wowza/';
$ftp_server = '';
$ftp_user_name = '';
$ftp_user_pass = '';
$ftp_path = '';

// Make file name
//$file_name = 'wowzamediaserver_access.log.' . date( 'Y-m-d', strtotime('-1 days'));
$file_name = 'wowzamediaserver_access.log.2012-06-10';

// Set source and copy file path
$source_file = $source_path . $file_name;
$main_file = $main_path . $file_name;

// Try copy file
if(file_exists($source_file)) {
	if(copy($source_file,$main_file)){
	   $copy_log = '1';
	   // set up basic connection
		$conn_id = ftp_connect($ftp_server); 
		// login with username and password
		$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass); 
		// check connection
		if ((!$conn_id) || (!$login_result)) { 
		    $ftp_log = '2';
		    exit; 
		} else {
		    $ftp_log = '1';
		}
		// upload the file
		$upload = ftp_put($conn_id, $ftp_path . $file_name, $main_file, FTP_BINARY); 
		// check upload status
		if (!$upload) { 
		    $upload_log = '2';
		} else {
		    $upload_log = '1';
		    mysql_query("INSERT INTO `webx_wowza`.`file` (`file`, `create`) VALUES ('" . $file_name . "', '" . time() . "');");
		}
		// close the FTP stream 
		ftp_close($conn_id); 
	} else {
	   $copy_log = '2';
	   $upload_log = '0';
	   $ftp_log = '0';
	}
} else {
	$copy_log = '3';
	$upload_log = '0';
	$ftp_log = '0';
}

mysql_query("INSERT INTO `webx_wowza`.`log` (`copy`, `ftp`, `upload`, `create`, `file`) VALUES ('" . $copy_log . "', '" . $ftp_log . "', '" . $upload_log . "', '" . time() . "', '" . $file_name . "');");

?>
