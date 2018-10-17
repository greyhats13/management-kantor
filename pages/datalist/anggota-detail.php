<?php
 error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
 date_default_timezone_set("Asia/Jakarta");
 if (strpos($_SESSION['jabatan'], 'Admin')===false) {
  echo '<script>alert("Maaf, Anda bukan Admin"); window.location="tampil/home"</script>';
}
?>

<div class="container">
<div>
<hr class="bounceInLeft animated" style="  
    border: 0;
    height: 1px;
    background: #333;
    background-image: linear-gradient(to right, #ccc, #333, #ccc);"
    >
    <div class="row">
      <h2>DATA ANGGOTA DETAIL</h2>
  </div>
<hr class="bounceInLeft animated" style="  
    border: 0;
    height: 1px;
    background: #333;
    background-image: linear-gradient(to right, #ccc, #333, #ccc);"
    >
</div>
</div>

<?php
   if (!defined('DIDALAM_INDEX_PHP')){ 
    //echo "Dilarang broh!";
        header("Location: ../../tampil/home");
    }
?>     
<div class="bounceInUp animated table-responsive">
  <table class="table table-bordered" id="table_rekap">
    <thead>
      <tr align="center">
        <th>Id Anggota</th>
            <th>Nama Anggota</th>
            <th>Jabatan</th>
            <th>Status</th>
            <th>Alamat</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>No Ktp</th>
            <th>No Rekening</th>
            <th>NPWP</th>
      </tr>
    </thead>
    <tbody>
            <?php
            $sql = "SELECT tb_anggota.id_anggota, tb_anggota.nama, GROUP_CONCAT(tb_jabatan.jabatan SEPARATOR ', ') as 'jabatan',tb_anggota.alamat,tb_anggota.tempat_lahir,tb_anggota.tgl_lahir,tb_anggota.jenis_kelamin,tb_anggota.no_ktp,tb_anggota.no_rekening,tb_anggota.npwp, tb_anggota.email, tb_anggota.jenis_kelamin, tb_anggota.status  FROM `tb_anggota` JOIN jabatan_anggota ON tb_anggota.id_anggota = jabatan_anggota.id_anggota JOIN tb_jabatan ON tb_jabatan.id_jabatan = jabatan_anggota.id_jabatan GROUP BY tb_anggota.id_anggota";
           $result = mysqli_query($koneksi,$sql);

           if (!$result) {
              //echo "sql yg 1 <br>";
              printf("Error: %s\n", mysqli_error($koneksi));
              exit();
              }
            while($r = mysqli_fetch_array($result))
            {
                $tempIDanggota= $r["id_anggota"]; 
            ?>
            <tr><td>
                <?php echo $r['id_anggota'] ?> </td>
              <td>
                <?php echo $r['nama'] ?> </td>
              <td>
                <?php echo $r['jabatan'] ?> </td>
                <td>
                <?php echo $r['status'] ?> </td>
                <td>
                <?php echo $r['alamat'] ?> </td>
                <td>
                <?php echo $r['tempat_lahir'] ?> </td>
                <td>
                <?php echo $r['tgl_lahir'] ?> </td>
                <td>
                <?php echo $r['jenis_kelamin'] ?> </td>
                <td>
                <?php echo $r['no_ktp'] ?> </td>
                <td>
                <?php echo $r['no_rekening'] ?> </td>
                <td>
                <?php echo $r['npwp'] ?> </td>
            </tr>
                  <?php
                }
                $no++;
          ?>          
    </tbody>              
  </table>
  </div>
    <!-- Deprecated Feature Convert CSV 
    <button button type="button"  class="btn btn-danger pull-right">Convert PDF</button>
   <form action="pages/proses/proses_convert-csv.php" method="POST">
      <input type="submit" id="btn_convert" class="btn btn-primary pull-right" value="Konvert ke CSV" name="submit_csv-rekapabsen">  
  </form>
  -->
  <div id="dataModalAnggota" class="modal fade">
			<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Detail Anggota</h4>
				</div>
				<div class="modal-body" id="employee_detail">
				</div>
				<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
				</div>
			</div>
			</div>
		</div>  
