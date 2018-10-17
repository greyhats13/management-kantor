<?php
	chdir(dirname(__FILE__));
	include "../../con_db.php"; //sambung ke database
	include "../../fungsi_kakatu.php";
	date_default_timezone_set('Asia/Jakarta');
	$tgl_now = date("Y-m-d");
	$dayname = date('D', strtotime($tgl_now));
	$day = date('j', strtotime($tgl_now));
    //Tanggal Gajian 27 Reset semua uang akomodasi
	if ($day == 27) {
		$sql = "UPDATE tb_detail_absen SET credit_stat='paid' WHERE credit_stat='unpaid'";
		$result = mysqli_query($koneksi,$sql);
		 if (!$result) {
				  printf("Error: %s\n", mysqli_error($koneksi));
				  exit();
		}
	}
	if($dayname!="Sat" && $dayname!="Sun"){
		autoAbsenAlpha($koneksi,$tgl_now);
		//Emit Data dengan Socket IO
		emitData();
	}
?>