<?php
include("inc_header.php");
?>

<!-- kita buat variabel kosong dahulu -->
<?php
$nama       = "";
$isi        = "";
$foto       = "";

$error      = "";  // ------> tampilan apabila terjadi error
$sukses     = "";  // ------> tampilan apabila sukses

if (isset($_GET['id'])) {   // dicek apakah ada id
    $id = $_GET['id'];
} else {
    $id = "";
}

if ($id != "") {   // jika id tidak sama kosong
    $id = $_GET['id'];
    $sql1 = "SELECT * FROM tutors WHERE id ='$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $nama    = $r1['nama'];
    $isi      = $r1['isi'];

    if ($isi == '') {
        $error = "Data tidak ditemukan";
    }
}


if (isset($_POST['simpan'])) {
    $nama    = $_POST['nama'];
    $isi      = $_POST['isi'];

    // jika isi nama,  tidak ada maka tampilan informasi error
    if ($nama == '' or $isi == '') {
        $error = "Silahkan masukkan data isi dan nama...";
    }

    //Array ( [foto] => Array ( [name] => Presidential_room.jpg [full_path] => Presidential_room.jpg 
    //[type] => image/jpeg [tmp_name] => C:\xampp\tmp\phpC959.tmp [error] => 0 [size] => 50545 ) )
    //print_r($_FILES);
    if ($_FILES['foto']['name']) {
        $foto_name = $_FILES['foto']['name'];
        $foto_file = $_FILES['foto']['tmp_name'];

        $detail_file = pathinfo($foto_name);
        $foto_ekstensi = $detail_file['extension'];
        // Array ( [dirname] => . [basename] => Connecting_room.jpeg [extension] => jpeg [filename] => Connecting_room )
        // print_r($detail_file);

        $type_file_bisa = array("jpg", "jpeg", "png", "gif"); // kita tentukan file yang bisa disimpan
        if (!in_array($foto_ekstensi, $type_file_bisa)) {
            $error = "Ekstensi yang diperbolehkan jpg, jpeg, PNG, Gif";
        }
    }

    if (empty($error)) {
        if ($foto_name) {
            $direktori = "../gambar";
            $foto_name = "tutors_" . time() . "_" . $foto_name; // rename disimpan
            move_uploaded_file($foto_file, $direktori . "/" . $foto_name);
        }
        if ($id != "") {
            $sql1 = "UPDATE tutors SET nama='$nama',
            isi='$isi',tgl_isi=NOW() WHERE id='$id'";
            $sukses = " Data derhasil diUpdate.";
        } else {
            $sql1   = "INSERT INTO tutors(nama,foto,isi) VALUES ('$nama','$foto_name','$isi')";
            $sukses = "SUKSES.. Data berhasil dimasukkan.";
        }

        $q1     = mysqli_query($koneksi, $sql1);

        if ($q1) {
            // echo $sukses;
        } else {
            $error  = "Gagal...input data";
        }
    }
}

?>

<h1>Halaman Input Admin tutors </h1>
<div class="mb-3 row">
    <a href="tutors.php">Kembali ke tutors Admin</a>
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


<form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3 row">
        <label for="nama" class="col-sm-2 col-form-label">nama</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nama" value="<?php echo $nama ?>" name="nama">
        </div>
    </div>

    <div class="mb-3 row">
        <label for="foto" class="col-sm-2 col-form-label">Foto</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" id="foto" name="foto">
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