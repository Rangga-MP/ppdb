<?php
include('../dbconnect.php');
$u = $_GET['u'];
$cekdulu = mysqli_query($conn,"select * from userdata where nisn='$u'");
    $ambil = mysqli_fetch_array($cekdulu);
    //get alamat
    $ambilprov = $ambil['provinsi'];
    $prov1 = mysqli_query($conn,"select name from provinces where id='$ambilprov'");
    $prov = mysqli_fetch_array($prov1)['name'];
    $ambilkota = $ambil['kabupaten'];
    $kab1 = mysqli_query($conn,"select name from regencies where id='$ambilkota'");
    $kab = mysqli_fetch_array($kab1)['name'];
    $ambilkec = $ambil['kecamatan'];
    $kec1 = mysqli_query($conn,"select name from districts where id='$ambilkec'");
    $kec = mysqli_fetch_array($kec1)['name'];
    $ambilkel = $ambil['kelurahan'];
    $kel1 = mysqli_query($conn,"select name from villages where id='$ambilkel'");
    $kel = mysqli_fetch_array($kel1)['name'];

require_once("../dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$query = mysqli_query($conn,"select * from userdata where nisn='$u'");
$html = '
<center><h3>Pendaftaran SMK Canda Bhirawa Pare (Berbasis Online)</h3></center><hr/><br/>';
$html .= '<div class="row mt-5 mb-5">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="d-sm-flex justify-content-between align-items-center">
                <h2>Data Pribadi</h2>
                <img src="../user/'. $ambil['foto'].'" width="20%">
            </div>
            <div class="market-status-table mt-4">
                <div class="table-responsive" style="overflow-x:hidden;">
                    
                    <div class="row">
                        <div class="col">
                        <div class="form-group">
                            <label>NISN:</label>
                            <input name="nisn" type="text" class="form-control" value="'.$u.'" style="border-style:hidden; padding-bottom:-3px;" padding-bottom:-3px;">
                        </div>
                        </div>
                        <div class="col">
                        <div class="form-group">
                            <label>NIK:</label>
                            <input name="nik" type="text" class="form-control" value="'.$ambil['nik'].'" style="border-style:hidden; padding-bottom:-3px;" padding-bottom:-3px;">
                        </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                        <div class="form-group">
                            <label>Nama Lengkap:</label>
                            <input name="namalengkap" type="text" class="form-control" value="'. $ambil['namalengkap'].'" style="border-style:hidden; padding-bottom:-3px;" padding-bottom:-3px;">
                        </div>
                        </div>
                        <div class="col">
                        <div class="form-group">
                            <label>Jenis Kelamin:</label>
                            <input type="text" class="form-control" value="'. $ambil['jeniskelamin'].'" style="border-style:hidden; padding-bottom:-3px;" padding-bottom:-3px;">
                        </select>
                        </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                        <div class="form-group">
                            <label>Tempat Lahir:</label>
                            <input name="tempatlahir" type="text" class="form-control" maxlength="20" value="'. $ambil['tempatlahir'].'" style="border-style:hidden; padding-bottom:-3px;" padding-bottom:-3px;">
                        </div>
                        </div>
                        <div class="col">
                        <div class="form-group">
                            <label>Tanggal Lahir:</label>
                            <input name="tgllahir" type="date" class="form-control" value="'. $ambil['tanggallahir'].'" style="border-style:hidden; padding-bottom:-3px;" padding-bottom:-3px;">
                        </div>
                        </div>
                    </div>
                        <div class="form-group">
                            <label>Alamat Lengkap:</label>
                            <input name="alamat" type="text" class="form-control" placeholder="Alamat" value="'. $ambil['alamat'].'" style="border-style:hidden; padding-bottom:-3px;" padding-bottom:-3px;">
                        </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                        <label>Provinsi:</label>
                        <input type="text" class="form-control" value="'. $prov.'" style="border-style:hidden; padding-bottom:-3px;" padding-bottom:-3px;">
                    </div>
                    </div>
                    <div class="col">
                    <div class="form-group">
                        <label>Kota/Kabupaten:</label>
                        <input type="text" class="form-control" value="'. $kab.'" style="border-style:hidden; padding-bottom:-3px;" padding-bottom:-3px;">
                    </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                    <div class="form-group">
                        <label>Kecamatan:</label>
                        <input type="text" class="form-control" value="'. $kec.'" style="border-style:hidden; padding-bottom:-3px;" padding-bottom:-3px;">
                    </div>
                    </div>
                    <div class="col">
                    <div class="form-group">
                        <label>Kelurahan:</label>
                        <input type="text" class="form-control" value="'. $kel.'" style="border-style:hidden; padding-bottom:-3px;" padding-bottom:-3px;">
                    </div>
                    </div>
                </div>
                    <div class="row">
                        <div class="col">
                        <div class="form-group">
                            <label>Agama:</label>
                            <input type="text" class="form-control" value="'.  $ambil['agama'].'" style="border-style:hidden; padding-bottom:-3px;" padding-bottom:-3px;">
                        </div>
                        </div>
                        <div class="col">
                        <div class="form-group">
                            <label>No Telepon:</label>
                            <input name="telepon" type="text" class="form-control" maxlength="15" value="'.  $ambil['telepon'].'" style="border-style:hidden; padding-bottom:-3px;" padding-bottom:-3px;">
                        </div>
                        </div>
                    </div>
                        
                    </div>
                
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row mt-5 mb-5">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="d-sm-flex justify-content-between align-items-center">
                <h2>Data Orang Tua</h2>
            </div>
            <div class="market-status-table mt-4">
                <div class="table-responsive" style="overflow-x:hidden;">
                    
                    <div class="row">
                        <div class="col">
                        <div class="form-group">
                            <label>NIK Ayah:</label>
                            <input name="ayahnik" type="text" class="form-control" value="'. $ambil['ayahnik'].'" style="border-style:hidden; padding-bottom:-3px;" padding-bottom:-3px;">
                        </div>
                        </div>
                        <div class="col">
                        <div class="form-group">
                            <label>Nama Ayah:</label>
                            <input name="ayahnama" type="text" class="form-control" value="'. $ambil['ayahnama'].'" style="border-style:hidden; padding-bottom:-3px;" padding-bottom:-3px;">
                        </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                        <div class="form-group">
                            <label>Pendidikan Ayah:</label>
                            <input type="text" class="form-control" value="'. $ambil['ayahpendidikan'].'" style="border-style:hidden; padding-bottom:-3px;" padding-bottom:-3px;">
                        </div>
                        </div>
                        <div class="col">
                        <div class="form-group">
                            <label>Pekerjaan Ayah:</label>
                            <input type="text" class="form-control" value="'. $ambil['ayahpekerjaan'].'" style="border-style:hidden; padding-bottom:-3px;" padding-bottom:-3px;">
                        </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                        <div class="form-group">
                            <label>Penghasilan Ayah per bulan:</label>
                            <input type="text" class="form-control" value="'. $ambil['ayahpenghasilan'].'" style="border-style:hidden; padding-bottom:-3px;" padding-bottom:-3px;">
                        </div>
                        </div>
                        <div class="col">
                        <div class="form-group">
                            <label>No Telepon Ayah:</label>
                            <input name="ayahtelepon" type="text" class="form-control" maxlength="15" value="'. $ambil['ayahtelepon'].'" style="border-style:hidden; padding-bottom:-3px;" padding-bottom:-3px;">
                        </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>


                    <div class="row">
                        <div class="col">
                        <div class="form-group">
                            <label>NIK Ibu:</label>
                            <input name="ibunik" type="text" class="form-control" value="'. $ambil['ibunik'].'" style="border-style:hidden; padding-bottom:-3px;" padding-bottom:-3px;">
                        </div>
                        </div>
                        <div class="col">
                        <div class="form-group">
                            <label>Nama Ibu:</label>
                            <input name="ibunama" type="text" class="form-control" value="'. $ambil['ibunama'].'" style="border-style:hidden; padding-bottom:-3px;" padding-bottom:-3px;">
                        </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                        <div class="form-group">
                            <label>Pendidikan Ibu:</label>
                            <input type="text" class="form-control" value="'. $ambil['ibupendidikan'].'" style="border-style:hidden; padding-bottom:-3px;">
                        </div>
                        </div>
                        <div class="col">
                        <div class="form-group">
                            <label>Pekerjaan Ibu:</label>
                            <input type="text" class="form-control" value="'. $ambil['ibupekerjaan'].'" style="border-style:hidden; padding-bottom:-3px;">
                        </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                        <div class="form-group">
                            <label>Penghasilan Ibu per bulan:</label>
                            <input type="text" class="form-control" value="'. $ambil['ibupenghasilan'].'" style="border-style:hidden; padding-bottom:-3px;">
                        </div>
                        </div>
                        <div class="col">
                        <div class="form-group">
                            <label>No Telepon Ibu:</label>
                            <input name="ibutelepon" type="text" class="form-control" maxlength="15" value="'. $ambil['ibutelepon'].'" style="border-style:hidden; padding-bottom:-3px;">
                        </div>
                        </div>
                    </div>

                    <br>
                    <hr>
                    <br>


                    <div class="row">
                        <div class="col">
                        <div class="form-group">
                            <label>NIK Wali:</label>
                            <input name="walinik" type="text" class="form-control"  value="'. $ambil['walinik'].'" style="border-style:hidden; padding-bottom:-3px;">
                        </div>
                        </div>
                        <div class="col">
                        <div class="form-group">
                            <label>Nama Wali:</label>
                            <input name="walinama" type="text" class="form-control"  value="'.$ambil['walinama'].'" style="border-style:hidden; padding-bottom:-3px;">
                        </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                        <div class="form-group">
                            <label>Pekerjaan Wali:</label>
                            <input type="text" class="form-control" value="'. $ambil['walipekerjaan'].'" disabled style="border-style:hidden; padding-bottom:-3px;">
                        </div>
                        </div>
                        <div class="col">
                        <div class="form-group">
                            <label>No Telepon Wali:</label>
                            <input name="walitelepon" type="text" class="form-control" maxlength="15" value="'. $ambil['walitelepon'].'" style="border-style:hidden; padding-bottom:-3px;">
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row mt-5 mb-5">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="d-sm-flex justify-content-between align-items-center">
                <h2>Data Sekolah Asal & Berkas</h2>
            </div>
            <div class="market-status-table mt-4">
                <div class="table-responsive" style="overflow-x:hidden;">
                    
                    <div class="row">
                        <div class="col">
                        <div class="form-group">
                            <label>NPSN Sekolah Asal:</label>
                            <input name="sekolahnpsn" type="text" class="form-control"  value="'. $ambil['sekolahnpsn'].'" style="border-style:hidden; padding-bottom:-3px;">
                        </div>
                        </div>
                        <div class="col">
                        <div class="form-group">
                            <label>Nama Sekolah Asal:</label>
                            <input name="sekolahnama" type="text" class="form-control" value="'. $ambil['sekolahnama'].'" style="border-style:hidden; padding-bottom:-3px;">
                        </div>
                        </div>
                    </div>

                   

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="scanijazahdepan" class="form-control-label">Scan Ijazah Bagian Depan</label>
                        <div class="img-container">
                            <img id="ijazah-depan" src="../user/'. $ambil['scanijazahdepan'].'" width="50%">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="scanijazahbelakang" class="form-control-label">Scan Ijazah Bagian Belakang</label>
                        <div class="img-container">
                            <img id="ijazah-belakang" src="../user/'. $ambil['scanijazahbelakang'].'" width="50%">
                        </div>
                    </div>
                </div>
            </div>

                
                </div>
            </div>
        </div>
    </div>
</div>
</div>';

$html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'potrait');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream($u.'.pdf');
?>
<style>
    .img-container {
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
  max-height: 400px; /* Sesuaikan sesuai kebutuhan */
}

.img-container img {
  max-width: 100%;
  max-height: 100%;
  transition: transform 0.3s ease-in-out;
}
</style>
<script>
document.addEventListener("DOMContentLoaded", function () {
    function checkOrientation(imgId) {
        const img = document.getElementById(imgId);
        img.onload = function () {
            if (img.naturalWidth > img.naturalHeight) {
                img.style.transform = "rotate(90deg)";
            }
        };
    }

    checkOrientation("ijazah-depan");
    checkOrientation("ijazah-belakang");
});
</script>
