<?php
include("inc_header.php");
?>

<?php
//cek katakunci jika ada kata kunci maka tampilkan kata kunci jika tidak maka kosong
$katakunci = (isset($_GET['katakunci']) ? $_GET['katakunci'] : "");
$sukses = "";         // kita definisikan tulisan sukses pada alert dengan isian " "

if (isset($_GET['op'])) {   // dicek apakah ada op
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id = $_GET['id'];
    $sql1 = "DELETE FROM halaman WHERE id ='$id'";
    $q1 = mysqli_query($koneksi, $sql1);

    if ($q1) {
        $sukses = "Berhasil hapus data.";
    }
}
?>

<h1>Halaman admin</h1>
<p>
    <a href="halaman_input.php">
        <input type="button" class="btn btn-primary" value="Buat Halaman Baru">
    </a>
</p>

<?php
if ($sukses) {
?>
    <div class="alert alert-info" role="alert">
        <?php echo $sukses ?>
    </div>
<?php
}
?>


<form class="row g-3" method="get">
    <div class="col-auto">
        <input type="text" class="form-control" placeholder="Masukkan Kata Kunci"
            name="katakunci" value="<?php echo $katakunci; ?>">
    </div>
    <div class="col-auto">
        <input type="submit" name="cari" value="Cari Tulisan" class="btn btn-secondary">
    </div>

</form>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th class="col-1">#</th>
            <th>Judul</th>
            <th>Kutipan</th>
            <th class="col-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sqltambahan    = "";
        if ($katakunci != '') {
            $array_katakunci = explode(" ", $katakunci); //explode digunakan untuk memisahkan menjadi array data yang dipisahkan oleh " " dari berbagai masukkan kata kunci
            for ($x = 0; $x < count($array_katakunci); $x++) {       // dimulai dari o sampai jumlah data
                $sqlcari[] = "(judul LIKE'%" . $array_katakunci[$x] .
                    "%' or kutipan LIKE'%" . $array_katakunci[$x] .
                    "%' or isi LIKE'%" . $array_katakunci[$x] . "%')";
            }

            $sqltambahan    = " WHERE " . implode(" or ", $sqlcari);
        }

        $sql1   = ("SELECT * FROM halaman $sqltambahan ORDER BY id DESC");
        $q1      = mysqli_query($koneksi, $sql1);

        $nomor  = 1;

        while ($r1 = mysqli_fetch_array($q1)) {
        ?>
            <tr>
                <td><?= $nomor++; ?></td>
                <td><?php echo $r1['judul']  ?></td>
                <td><?php echo $r1['kutipan']  ?></td>
                <td>
                    <a href="halaman_input.php?id=<?php echo $r1['id'] ?>">
                        <span class=" badge rounded-pill bg-warning text-dark">Edit</span>
                    </a>

                    <a href="halaman.php?op=delete&id=<?php echo $r1['id'] ?>"
                        onclick="return confirm('Apakah yakin <?php echo $r1['judul'] ?> mau dihapus?')">
                        <span class="badge rounded-pill bg-danger">Hapus</span>
                    </a>
                </td>
            </tr>
        <?php
        }
        ?>


    </tbody>
</table>

<?php
include("inc_footer.php");
?>
