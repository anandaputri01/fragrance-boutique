<?php
include "koneksi.php";
$username = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username='$username'";
$hasil = $conn->query($sql);
$data = $hasil->fetch_assoc();

include "upload_foto.php";

if (isset($_POST['simpan'])) {
    $username = $_SESSION['username'];
    $password = $_POST['password'];
    $gambar = '';
    $nama_gambar = $_FILES['gambar']['name'];

    if (empty($password) && empty($nama_gambar)) {
        echo "<script>
            alert('Value kosong! Gagal menyimpan data. Masukkan Password baru anda atau foto profil baru anda untuk menyimpan.');
            document.location='admin.php?page=profil';
        </script>";
    }

    if ($nama_gambar != '') {
        $cek_upload = upload_foto($_FILES["gambar"]);

        if ($cek_upload['status']) {
            $gambar = $cek_upload['message'];
        } else {
            echo "<script>
                alert('" . $cek_upload['message'] . "');
                document.location='admin.php?page=profil';
            </script>";
            die;
        }
    }

    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        if ($nama_gambar == '') {
            $gambar = $_POST['gambar_lama'];
        } else {
            unlink("img/" . $_POST['gambar_lama']);
        }

        if ($password == '') {
            $stmt = $conn->prepare("UPDATE user
                                SET 
                                foto = ?
                                WHERE id = ?");

            $stmt->bind_param("si", $gambar, $id);
            $simpanProfile = $stmt->execute();
        } else {
            $password = md5($_POST['password']);
            $stmt = $conn->prepare("UPDATE user
                                SET 
                                password =?,
                                foto = ?
                                WHERE id = ?");

            $stmt->bind_param("ssi", $password, $gambar, $id);
            $simpan = $stmt->execute();
        }
    }

    if ($simpan) {
        echo "<script>
            alert('Simpan data sukses! Harap login kembali untuk mengakses dashboard admin');
            document.location='logout.php';
        </script>";
    } else if ($simpanProfile) {
        echo "<script>
            alert('Simpan data sukses');
            document.location='admin.php?page=profil';
        </script>";
    } else {
        echo "<script>
            alert('Simpan data gagal');
            document.location='admin.php?page=profil';
        </script>";
    }

    $stmt->close();
    $conn->close();
}

?>
<div class="container">
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" id="id" name="id" value="<?= $data['id'] ?>">
        <div class="mb-3">
            <input type="hidden" id="password_lama" name="password_lama" value="<?= $data['password'] ?>">
            <label for="password" class="form-label">Ganti Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password Baru hanya jika ingin mengganti password anda" autocomplete="off">
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Ganti Foto Profil</label>
            <input type="file" class="form-control" id="gambar" name="gambar">
        </div>
        <div class="mb-3">
            <label class="form-label">Foto Profil Saat Ini</label>
            <div>
                <img src="img/<?= $data['foto'] ?>" alt="Current Profile Photo" class="img-fluid" width="150">
            </div>
            <input type="hidden" name="gambar_lama" value="<?= $data["foto"] ?>">
        </div>
        <input type="submit" value="Update Profile" name="simpan" class="btn btn-primary">
    </form>
</div>