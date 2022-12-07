<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "datasiswa";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Tidak Terhubung ke DataBase");
}

$nis = "";
$nama = "";
$alamt = "";
$kelas = "";
$error = "";
$sukses = "";

// Untuk Edit Data
if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == "delete") {
    $id = $_GET['id'];
    $sql1 = "delete from siswa where id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);

    if ($q1) {
        $sukses = "Berhasil Menghapus Data";
    } else {
        $error = "Gagal Melakukan Delete Data";
    }
}


if ($op == "edit") {
    $id = $_GET['id'];
    $crud1 = "select * from siswa where id = '$id'";
    $c1 = mysqli_query($koneksi, $crud1);
    $r1 = mysqli_fetch_array($c1);
    $nis = $r1['nis'];
    $nama = $r1['nama'];
    $alamat = $r1['alamat'];
    $kelas = $r1['kelas'];

    if ($nis == "") {
        $error = "Data Tidak Di Temukan";

    }
}

// Untuk Create Data
if (isset($_POST['simpan'])) {
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $kelas = $_POST['kelas'];

    if ($nis && $nama && $alamat && $kelas) {
        if ($op == 'edit') {
            $crud1 = "update siswa set nis = '$nis',nama = '$nama',alamat = '$alamat',kelas = '$kelas' where id = '$id'";
            $cr1 = mysqli_query($koneksi, $crud1);
            if ($cr1) {
                $sukses = "Data Berhasil Di update";
            } else {
                $error = "Data Gagal Di update";
            }
        } else {
            $crud1 = "insert into siswa(nis, nama, alamat, kelas) value ('$nis', '$nama', '$alamat', '$kelas')";
            $c1 = mysqli_query($koneksi, $crud1);
            if ($c1) {
                $sukses = "Berhasil Memasukan Data";
            } else {
                $error = "Gagal Memasukan Data";
            }
        }
    } else {
        $error = "Silakan Masukan Semua Data";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataSiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
    .mx-auto {
        width: 800px;
    }

    .card {
        margin-top: 20px;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Data Siswa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/phpmyadmin/index.php?route=/sql&pos=0&db=datasiswa&table=siswa">Localhost</a>
                    </li>
                    <li class="nav-item dropdown">
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="index.htm">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search Siswa" aria-label="البحث عن">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div> 
    </nav>

    <div class="mx-auto">
        <!-- Untuk Create Data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Create / Edit
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error ?>
                </div>
                <?php
                    header("refresh:2;url = index.php");
                }
                    ?>

                <?php
                if ($sukses) {
                ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $sukses ?>
                </div>
                <?php
                    header("refresh:2;url = index.php");
                }
                    ?>

                <form action="" method="post">

                    <div class="mb-3 row">
                        <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nis" name="nis" value="<?php echo $nis ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                value="<?php echo $alamat ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="kelas" name="kelas">
                                <option value="">--- Pilih Kelas ---</option>
                                <option value="kelas X" <?php if ($kelas=="kelas X")
                                    echo "Selected" ?>>Kelas X 🗿
                                </option>
                                <option value="kelas XI" <?php if ($kelas=="kelas XI")
                                    echo "Selected" ?>>Kelas XI 🗿
                                </option>
                                <option value="kelas XII" <?php if ($kelas=="kelas XII")
                                    echo "Selected" ?>>Kelas XII 🗿
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn-primary">
                    </div>

                </form>
            </div>
        </div>

        <!-- Untuk Read Data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Siswa
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">NO.</th>
                            <th scope="col">NIS</th>
                            <th scope="col">NAMA</th>
                            <th scope="col">ALAMAT</th>
                            <th scope="col">KELAS</th>
                            <th scope="col">AKSI
                        </tr>
                        </tr>
                    <TBody>
                        <?php
                            $crud2 = "select * from siswa order by id desc";
                            $c2 = mysqli_query($koneksi, $crud2);
                            $urut = 1;
                            while ($r2 = mysqli_fetch_array($c2)) {
                                $id = $r2['id'];
                                $nis = $r2['nis'];
                                $nama = $r2['nama'];
                                $alamat = $r2['alamat'];
                                $kelas = $r2['kelas'];

                            ?>
                        <tr>
                            <th scope="row">
                                <?php echo $urut++ ?>
                            </th>
                            <td scope="row">
                                <?php echo $nis ?>
                            </td>
                            <td scope="row">
                                <?php echo $nama ?>
                            </td>
                            <td scope="row">
                                <?php echo $alamat ?>
                            </td>
                            <td scope="row">
                                <?php echo $kelas ?>
                            </td>
                            <td scope="row">
                                <a href="index.php?op=edit&id=<?php echo $id ?>"> <button type="button"
                                        class="btn btn-warning">Edit</button></a>
                                <a href="index.php?op=delete&id=<?php echo $id ?>"
                                    onclick="return confirm('Janganlah mengdelete delete data siswa 😇')"><button
                                        type="button" class="btn btn-danger">Delete</button></a>
                            </td>
                        </tr>
                        <?php
                            }
                                ?>
                    </TBody>
                    </thead>
                </table>
            </div>
        </div>

    </div>
</body>

</html>