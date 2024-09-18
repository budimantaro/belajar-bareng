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
        $sql1   = "INSERT INTO halaman(judul,kutipan,isi) VALUES ('$judul','$kutipan','$isi')";
        $q1     = mysqli_query($koneksi, $sql1);

        if ($q1) {
            $sukses = "SUKSES.. Data berhasil dimasukkan.";
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
            <input type="text" class="form-control" id="judul" value="<?php echo $kutipan ?>" name="judul">
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
