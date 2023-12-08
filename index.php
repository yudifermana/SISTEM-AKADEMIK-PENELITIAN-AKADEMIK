<?php
// koneksi database
$server = "localhost";
$user = "root";
$password = "";
$database = "db_tugas_yudi";

$koneksi = mysqli_connect($server, $user, $password, $database) or die(mysqli_error($koneksi));

// Logic simpan
if (isset($_POST['bsimpan'])) {
    // data baru disimpan
    $simpan = mysqli_query($koneksi, " INSERT INTO tbarang(kode, nama, asal, jumlah, satuan, tanggal_diterima) 
    VALUES ('$_POST[tkode]', '$_POST[tnama]', '$_POST[tasal]', '$_POST[tjumlah]', '$_POST[tsatuan]', '$_POST[ttanggal_diterima]')
    
    ");
    // jika simpan data sukses
    if ($simpan) {
        echo "<script>
                alert('Simpan Data Sukses!');
                document.location= 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Simpan Data Gagal!');
                document.location= 'index.php';
              </script>";
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tugas Yudi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h3 class="text-center">Data Inventaris</h3>
        <h3 class="text-center">Inventaris Kantor</h3>

        <div class="Row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header bg-info text-light">
                        Form Input Data Barang
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Kode Barang</label>
                                <input type="text" name="tkode" class="form-control" placeholder="Masukan Kode Barang">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Barang</label>
                                <input type="text" name="tnama" class="form-control" placeholder="Masukan Nama Barang">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Asal Barang</label>
                                <select class="form-select" name="tasal">
                                    <option>-Pilih-</option>
                                    <option value="Pembelian">Pembelian</option>
                                    <option value="Hibah">Hibah</option>
                                    <option value="Sumbangan">Sumbangan</option>
                                    <option value="Bantuan">Bantuan</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Jumlah</label>
                                        <input type="number" name="tjumlah" class="form-control" placeholder="Masukan Jumlah Barang">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">

                                        <label class="form-label">Satuan</label>
                                        <select class="form-select" name="tsatuan">
                                            <option>-Pilih-</option>
                                            <option value="Unit">Unit</option>
                                            <option value="Kotak">Kotak</option>
                                            <option value="Box">Box</option>
                                            <option value="Pcs">Pcs</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Tangal Diterima</label>
                                        <input type="date" name="ttanggal_diterima" class="form-control">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <hr>
                                    <button class="btn btn-primary" name="bsimpan" type="submit">Simpan</button>
                                    <button class="btn btn-danger" name="bkosongkan" type="reset">Kosongkan</button>
                                </div>
                        </form>
                    </div>
                </div>
                <div class="card-footer bg-info">
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header bg-info text-light">
                Data Barang
            </div>
            <div class="card-body">
                <div class="col-md-6 mx-auto">
                    <form method="POST">
                        <div class="input-group mb-3">
                            <input type="text" name="tcari" class="form-control" placeholder="Masukan Kata Kunci">
                            <button class="btn btn-primary" name="bcari" type="submit">Cari</button>
                            <button class="btn btn-danger" name="breset" type="submit">Reset</button>
                        </div>
                    </form>
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <tr>
                        <th>NO</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Asal Barang</th>
                        <th>Jumlah</th>
                        <th>Tanggal Diterima</th>
                        <th>Aksi</th>
                    </tr>


                    <?php
                    // menampilkan data dari database
                    $no = 1;
                    // pencarian data
                    if (isset($_POST['bcari'])) {
                        $keyword = $_POST['tcari'];
                        $q = "SELECT * FROM tbarang WHERE kode like '%$keyword%' or nama like '%$keyword%' or asal like '%$keyword%' order by id_barang desc ";
                    } else {
                        $q = "SELECT * FROM tbarang order by id_barang desc";
                    }
                    $tampil = mysqli_query($koneksi, $q);
                    while ($data = mysqli_fetch_array($tampil)) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['kode'] ?></td>
                            <td><?= $data['nama'] ?></td>
                            <td><?= $data['asal'] ?></td>
                            <td><?= $data['jumlah'] ?> <?= $data['satuan'] ?></td>

                            <td><?= $data['tanggal_diterima'] ?></td>
                            <td>
                                <a href="edit.php?id=<?= $data['id_barang'] ?>&edit" class="btn btn-warning">Edit</a>
                                <a href="hapus.php?id=<?= $data['id_barang'] ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">Hapus</a>
                            </td>

                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            <div class="card-footer bg-info">
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>