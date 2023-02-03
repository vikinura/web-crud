<?php
    include 'koneksi.php';

    function tambah_data($data, $files){
        $nama_siswa = $data['nama_siswa'];
        $no_absen = $data['no_absen'];
        $kelas = $data['kelas'];

        $split = explode('.', $files['foto']['name']);
        $ekstensi = $split[count($split)-1];

        $foto = $nama_siswa.'.'.$ekstensi;

        $dir = "img/";
        $tmpFile = $_FILES['foto']['tmp_name'];

        move_uploaded_file($tmpFile, $dir.$foto);

        $query = "INSERT INTO data_profil_siswa VALUES(null, '$nama_siswa', '$no_absen', '$kelas', '$foto')";
        $sql = mysqli_query($GLOBALS['conn'], $query);

        return true;
    }

    function ubah_data($data, $files){
            $id_siswa = $data['id_siswa'];
            $nama_siswa = $data['nama_siswa'];
            $no_absen = $data['no_absen'];
            $kelas = $data['kelas'];

            $queryShow = "SELECT * FROM data_profil_siswa WHERE id_siswa = '$id_siswa';";
            $sqlShow = mysqli_query($GLOBALS['conn'], $queryShow);
            $result = mysqli_fetch_assoc($sqlShow);

            if($files['foto']['name'] == ""){
                $foto = $result['foto'];
            } else {

                $split = explode('.', $files['foto']['name']);
                $ekstensi = $split[count($split)-1];

                $foto = $result['nama_siswa'].'.'.$ekstensi;
                unlink("img/".$result['foto']);
                move_uploaded_file($files['foto']['tmp_name'], 'img/'.$foto);
            }

            $query = "UPDATE data_profil_siswa SET nama_siswa='$nama_siswa', no_absen='$no_absen', kelas='$kelas',  foto = '$foto' WHERE id_siswa='$id_siswa';";
            $sql = mysqli_query($GLOBALS['conn'], $query);

            return true;
            
    }

    function hapus_data($data){
        $id_siswa = $data['hapus'];

        $queryShow = "SELECT * FROM data_profil_siswa WHERE id_siswa = '$id_siswa';";
        $sqlShow = mysqli_query($GLOBALS['conn'], $queryShow);
        $result = mysqli_fetch_assoc($sqlShow);

        unlink("img/".$result['foto']);

        $query = "DELETE FROM data_profil_siswa WHERE id_siswa = '$id_siswa';";
        $sql = mysqli_query($GLOBALS['conn'], $query);

        return true;
    }
?>