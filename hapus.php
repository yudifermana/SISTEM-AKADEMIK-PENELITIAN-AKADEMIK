<?php
// hapus.php

// Koneksi database (gunakan koneksi yang sama dengan file utama)
include 'index.php';

// Ambil ID dari parameter URL
$id_barang = $_GET['id'];

// Query hapus data
$hapus = mysqli_query($koneksi, "DELETE FROM tbarang WHERE id_barang=$id_barang");

if ($hapus) {
    echo "<script>
            alert('Hapus Data Sukses!');
            document.location= 'index.php';
          </script>";
} else {
    echo "<script>
            alert('Hapus Data Gagal!');
            document.location= 'index.php';
          </script>";
}
