<?php
include("inc_header.php");
?>

<!-- kita buat variabel kosong dahulu -->
<?php
$judul      = "";
$kutipan    = "";
$isi        = "";
$error      = "";  // ------> tampilan apabila terjadi error
$sukses     = "";  // ------> tampilan apabila sukses

if (isset($_GET['id'])) {   // dicek apakah ada id
    $id = $_GET['id'];
} else {
    $id = "";
}

if ($id != "") {   // jika id tidak sama kosong
    $id = $_GET['id'];
    $sql1 = "SELECT * FROM halaman WHERE id ='$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $judul    = $r1['judul'];
    $kutipan  = $r1['kutipan'];
    $isi      = $r1['isi'];

    if ($isi ==''){
        $error = "Data tidak ditemukan";
    }

}


if (isset($_POST['simpan'])) {
    $judul    = $_POST['judul'];
    $kutipan  = $_POST['kutipan'];
    $isi      = $_POST['isi'];

    // jika isi judul, kutipan, tidak ada maka tampilan informasi error
    if ($judul == '' or $isi == '') {
        $error = "Silahkan masukkan data isi dan judul...";
    }

    //
    if (empty($error)) {
        if($id != ""){
            $sql1 = "UPDATE halaman SET judul='$judul',
            kutipan='$kutipan',isi='$isi',tgl_isi=NOW() WHERE id='$id'";
            $sukses = " Data derhasil diUpdate.";
        }else{
            $sql1   = "INSERT INTO halaman(judul,kutipan,isi) VALUES ('$judul','$kutipan','$isi')";
            $sukses = "SUKSES.. Data berhasil dimasukkan.";
        }

        $q1     = mysqli_query($koneksi, $sql1);

        if ($q1) {
            echo $sukses;
        } else {
            $error  = "Gagal...input data";
        }
    }
}

?>

<h1>Halaman Input Admin </h1>
<div class="mb-3 row">
    <a href="halaman.php">Kembali ke halaman Admin</a>
</div>

<?php
if ($error) {
?>
    <div class="alert alert-danger" role="alert">
        <?php echo $error ?>
    </div>
<?php
}
?>
<?php
if ($sukses) {
?>
    <div class="alert alert-primary" role="alert">
        <?php echo $sukses ?>
    </div>
<?php
}
?>


<form action="" method="post">
    <div class="mb-3 row">
        <label for="judul" class="col-sm-2 col-form-label">Judul</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="judul" value="<?php echo $judul ?>" name="judul">
        </div>
    </div>

    <div class="mb-3 row">
        <label for="kutipan" class="col-sm-2 col-form-label">Kutipan</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="kutipan" value="<?= $kutipan; ?>" name="kutipan">
        </div>
    </div>

    <div class="mb-3 row">
        <label for="isi" class="col-sm-2 col-form-label">Isi</label>
        <div class="col-sm-10">
            <textarea name="isi" class="form-control"> <?php echo $isi; ?> </textarea>
        </div>
    </div>

    <div class="mb-3 row">
        <div class="col-sm-2">

        </div>
        <div class="col-sm-10">
            <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
        </div>
    </div>

</form>

<?php
include("inc_footer.php");
?>
