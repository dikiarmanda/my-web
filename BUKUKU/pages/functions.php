<?php 
require 'koneksi.php';
// ambil data dari database
function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// input member
function tambah($data) {
    global $conn;
    // ambil data dari input
    $nim = htmlspecialchars($data["inputNIM"]);
    $nama = htmlspecialchars($data["inputNama"]);
    $jnsKlmn = htmlspecialchars($data["inputGender"]);
    $alamat = htmlspecialchars($data["inputAlamat"]);
    $email = htmlspecialchars($data["inputEmail"]);
    $pass = mysqli_real_escape_string($conn, $data["inputPassword"]);
    $wa = htmlspecialchars($data["inputWhatsapp"]);
    $prodi = htmlspecialchars($data["inputProdi"]);

    // cek nim sudah ada atau belum
    $result = query("SELECT nim FROM member WHERE nim = '$nim'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('NIM sudah terdaftar');
        </script>";
    }

    // enkripsi password
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    
    $query = "INSERT INTO member
                VALUES
                ('', '$nim', '$nama', '$jnsKlmn', '$alamat', '$wa', '$email', '$pass', '$prodi', '')
                ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// jumlah user member dan admin
function user($data) {
    global $conn;
    $hitung = mysqli_query($conn, $data);
    $hasil = mysqli_fetch_assoc($hitung);
    return $hasil['total'];
}

function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM member WHERE idMember = $id");
    return mysqli_affected_rows($conn);
}

function ubah($data) {
    global $conn;
    // ambil data dari input
    $id = htmlspecialchars($data["id"]);
    $nim = htmlspecialchars($data["inputNIM"]);
    $nama = htmlspecialchars($data["inputNama"]);
    $jnsKlmn = htmlspecialchars($data["inputGender"]);
    $alamat = htmlspecialchars($data["inputAlamat"]);
    $email = htmlspecialchars($data["inputEmail"]);
    $pass = mysqli_real_escape_string($conn, $data["inputPassword"]);
    $wa = htmlspecialchars($data["inputWhatsapp"]);
    $prodi = htmlspecialchars($data["inputProdi"]);
    $stat = htmlspecialchars($data["status"]);

    // enkripsi password
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    
    $query = "UPDATE member SET 
                nim = '$nim',
                namaMember = '$nama',
                jnsKlmn = '$jnsKlmn',
                alamat = '$alamat', 
                noWa = '$wa',
                email = '$email',
                pass = '$pass',
                prodi = '$prodi',
                status = '$stat'
                WHERE idMember = '$id'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function cari($keyword) {
    $query = "SELECT * FROM member
                WHERE
                namaMember LIKE '%$keyword%' OR
                nim LIKE '%$keyword%' OR
                email LIKE '%$keyword%' OR
                status LIKE '%$keyword%' OR
                prodi LIKE '%$keyword%'";
    return query($query);
}

function bukuBaru($data) {
    global $conn;
    // ambil data dari input
    $jdl = $data["inputJudul"];
    $pngrng = $data["inputPengarang"];
    $trbit = $data["inputTerbit"];
    $cover = $data["inputCover"];
    $fileBuku = $data["inputBuku"];
    $jdl = $data["inputJudul"];
}
?>