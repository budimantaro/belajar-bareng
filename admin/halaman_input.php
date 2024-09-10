<?php
include("inc_header.php");
?>

<!-- kita buat variabel kosong dahulu -->
<?php
    $judul      ="";
    $kutipan    ="";
    $isi        ="";
    $error      ="";  // ------> tampilan apabila terjadi error
    $sukses     ="";  // ------> tampilan apabila sukses
    
?>

<h1>Halaman Input Admin </h1>
<div class="mb-3 row">
    <a href="halaman.php">Kembali ke halaman Admin</a>
</div>

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
            <textarea name="isi" class="form-control" > <?php echo $isi;?> </textarea>
        </div>
    </div>

    <div class="mb-3 row">
        <div class="col-sm-2">

        </div>
        <div class="col-sm-10">
            <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary"/>
        </div>
</div>

</form>

<?php
include("inc_footer.php");
?>