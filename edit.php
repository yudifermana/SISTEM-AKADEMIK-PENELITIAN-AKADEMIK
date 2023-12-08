<?php
// edit.php

// Koneksi database (gunakan koneksi yang sama dengan file utama)
include 'index.php';

// Ambil ID dari parameter URL
$id_barang = $_GET['id'];

// Ambil data dari database berdasarkan ID
$result = mysqli_query($koneksi, "SELECT * FROM tbarang WHERE id_barang=$id_barang");
$data = mysqli_fetch_assoc($result);

// Proses form jika tombol update ditekan
if (isset($_POST['bupdate'])) {
    $kode = $_POST['tkode'];
    $nama = $_POST['tnama'];
    $asal = $_POST['tasal'];
    $jumlah = $_POST['tjumlah'];
    $satuan = $_POST['tsatuan'];
    $tanggal_diterima = $_POST['ttanggal_diterima'];

    // Query update data
    $update = mysqli_query($koneksi, "UPDATE tbarang SET
        kode='$kode', nama='$nama', asal='$asal', jumlah='$jumlah', satuan='$satuan', tanggal_diterima='$tanggal_diterima'
        WHERE id_barang=$id_barang
    ");

    if ($update) {
        echo "<script>
                alert('Update Data Sukses!');
                document.location= 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Update Data Gagal!');
                document.location= 'index.php';
              </script>";
    }
}
?>

<!-- ... (HTML form untuk edit) ... -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <?php
                    // Koneksi database (gunakan koneksi yang sama dengan file utama)
                    // include 'index.php';

                    // Ambil ID dari parameter URL
                    $id_barang = $_GET['id'];

                    // Ambil data dari database berdasarkan ID
                    $result = mysqli_query($koneksi, "SELECT * FROM tbarang WHERE id_barang=$id_barang");
                    $data = mysqli_fetch_assoc($result);
                    ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Kode Barang</label>
                            <input type="text" name="tkode" class="form-control" value="<?= $data['kode'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" name="tnama" class="form-control" value="<?= $data['nama'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Asal Barang</label>
                            <select class="form-select" name="tasal" required>
                                <option value="Pembelian" <?= ($data['asal'] == 'Pembelian') ? 'selected' : '' ?>>Pembelian</option>
                                <option value="Hibah" <?= ($data['asal'] == 'Hibah') ? 'selected' : '' ?>>Hibah</option>
                                <option value="Sumbangan" <?= ($data['asal'] == 'Sumbangan') ? 'selected' : '' ?>>Sumbangan</option>
                                <option value="Bantuan" <?= ($data['asal'] == 'Bantuan') ? 'selected' : '' ?>>Bantuan</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Jumlah</label>
                                    <input type="number" name="tjumlah" class="form-control" value="<?= $data['jumlah'] ?>" required>
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Satuan</label>
                                    <select class="form-select" name="tsatuan" required>
                                        <option value="Unit" <?= ($data['satuan'] == 'Unit') ? 'selected' : '' ?>>Unit</option>
                                        <option value="Kotak" <?= ($data['satuan'] == 'Kotak') ? 'selected' : '' ?>>Kotak</option>
                                        <option value="Box" <?= ($data['satuan'] == 'Box') ? 'selected' : '' ?>>Box</option>
                                        <option value="Pcs" <?= ($data['satuan'] == 'Pcs') ? 'selected' : '' ?>>Pcs</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Diterima</label>
                                    <input type="date" name="ttanggal_diterima" class="form-control" value="<?= $data['tanggal_diterima'] ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button class="btn btn-primary" name="bupdate" type="submit">Update</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        // Tampilkan modal saat tombol Edit diklik
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('editModal'), {
                keyboard: false
            });

            // Cek apakah parameter URL 'edit' ada, jika ya, tampilkan modal
            var urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('edit')) {
                myModal.show();
            }
        });
    </script>


</body>

</html>