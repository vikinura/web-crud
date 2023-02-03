<!DOCTYPE html>

<?php
    include 'koneksi.php';
    session_start();

    $id_siswa = '';
    $nama_siswa = '';         
    $no_absen ='';
    $kelas = '';

    if(isset($_GET['ubah'])){
        $id_siswa = $_GET['ubah'];

        $query = "SELECT * FROM data_profil_siswa WHERE id_siswa = '$id_siswa';";
        $sql = mysqli_query($conn, $query);

        $result = mysqli_fetch_assoc($sql);

        $nama_siswa = $result['nama_siswa'];         
        $no_absen = $result['no_absen'];
        $kelas = $result['kelas'];

    }
?>

<html>
<head>
    <meta charset="utf-8">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js" ></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">

    <title>website CRUD</title>
</head> 
<body>
    <nav class="navbar navbar-light bg-light mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
            Devinta Dwi Maharani (13)
            </a>
        </div>
    </nav>
    <div class="container">
        <form method="POST" action="proses.php" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $id_siswa; ?>" name="id_siswa">
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">
                    Nama Siswa
                </label>
                <div class="col-sm-10">
                    <input required type="text" name="nama_siswa" class="form-control" id="nama" placeholder="Ex: Totoro" value="<?php echo $nama_siswa; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="noabsn" class="col-sm-2 col-form-label">
                    No Absen</label>
            <div class="col-sm-10">
                <input required type="text" name="no_absen" class="form-control" id="noabsn" placeholder="Ex: 112233" value="<?php echo $no_absen ?>">
            </div>
            </div>
            <div class="mb-3 row">
                <label for="kelas" class="col-sm-2 col-form-label">
                    Kelas
                </label>
                <div class="col-sm-10">
                    <select value="<?php echo $kelas; ?>" required id="kelas" name="kelas" class="form-select">
                        <option selected>Kelas</option>
                        <option value="XI TKJ2">XI TKJ2</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="foto" class="col-sm-2 col-form-label">
                    Foto
                </label>
                <div class="col-sm-10">
                    <input <?php if(!isset($_GET['ubah'])){ echo "required";} ?>class="form-control" type="file" name="foto" id="foto" accept="image/*">
                </div>
            </div>    
            <div class="mb-3 row mt-4">
                <div class="col">
                    <?php
                        if(isset($_GET['ubah'])){
                    ?>
                        <button type="submit" name="aksi" value="edit" class="btn btn-primary">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            Simpan Perubahan
                        </button>
                    <?php
                        } else {
                    ?>
                        <button type="submit" name="aksi" value="add" class="btn btn-primary">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            Tambahkan
                        </button>
                    <?php
                        }
                    ?>
                    <a href="index.php" type="button" class="btn btn-danger">
                        <i class="fa fa-reply" aria-hidden="true"></i>
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>