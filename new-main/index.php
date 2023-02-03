<?php
  include 'koneksi.php';
  session_start();

  $query = "SELECT * FROM data_profil_siswa;";
  $sql = mysqli_query($conn, $query);
  $id_siswa = 0;

?>

<!DOCTYPE html>
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
    <nav class="navbar navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          Devinta Dwi Maharani (13)
        </a>
      </div>
    </nav>

    <!-- Judul -->
    <div class="container">
      <h1 class="mt-4">Data Profil Siswa</h1>
      <figure>
        <blockquote class="blockquote">
          <p>Data siswa SMK Telkom Malang kelas XI TKJ2.</p>
        </blockquote>
        <figcaption class="blockquote-footer">
          CRUD <cite title="Source Title">Create Read Update Delete</cite>
        </figcaption>
      </figure>
      <a href="kelola.php" type="button" class="btn btn-primary mb-3">
          <i class="fa fa-plus"></i>
            Tambah Data
      </a>

      <?php
        if(isset($_SESSION['eksekusi'])):
      ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">             
                <?php
                  echo $_SESSION['eksekusi'];
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
      <?php
          session_destroy();
          endif;
      ?>

      <div class="table-responsive">
          <table class="table align-middle table-bordered table-hover">
              <thead>
                <tr>
                  <th><center>No</center></th>
                  <th>Nama Siswa</th>
                  <th>No Absen</th>
                  <th>Kelas</th>
                  <th>Foto</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php
                while($result = mysqli_fetch_assoc($sql)){
              ?>
                <tr>
                  <td><center>
                    <?php echo ++$id_siswa; ?>.
                  </center></td>
                  <td>
                    <?php echo $result['nama_siswa']; ?>
                  </td>
                  <td>
                    <?php echo $result['no_absen']; ?>
                  </td>
                  <td>
                    <?php echo $result['kelas']; ?>
                  </td>
                  <td><center>
                    <img src="img/<?php echo $result['foto']; ?>" style="width: 150px;"></center>
                  </td>
                  <td><center>
                    <a href="kelola.php?ubah=<?php echo $result['id_siswa']; ?>" type="button" class="btn btn-success btn-sm">
                      Ubah
                    </a>
                    <a href="proses.php?hapus=<?php echo $result['id_siswa']; ?>" type="button" class="btn btn-danger btn-sm" onClick="return confirm('Apakah anda yakin ingin menghapus data tersebut??')">
                      Hapus
                    </a></center>
                  </td>
                </tr>
              <?php
                  }
              ?>
              </tbody> 
            </table> 
          </div>    
        </div>
    </body>
</html>