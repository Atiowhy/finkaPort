<?php
session_start();
include 'koneksi.php';

// jika button simpan ditekan
$queryResume = mysqli_query($koneksi, "SELECT * FROM resume ORDER BY id DESC");
$rowResume = mysqli_fetch_assoc($queryResume);
if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $education = $_POST['education'];
    $sub_education = $_POST['sub_education'];
    $text_education = $_POST['text_education'];
    $internship = $_POST['internship'];
    $sub_internship = $_POST['sub_internship'];
    $text_internship = $_POST['text_internship'];
    $organization = $_POST['organization'];
    $sub_organization = $_POST['sub_organization'];
    $text_organization = $_POST['text_organization'];


    // mencari data di dalam table pengaturan, jika ada data akan diupdate, jika tidak ada akan di insert
    if (mysqli_num_rows($queryResume) > 0) {
        if (!empty($_FILES['foto']['name'])) {
            $nama_foto = $_FILES['foto']['name'];
            $ukuran_foto = $_FILES['foto']['size'];
            // png, jpg, jpeg
            $ext = array('png', 'jpg', 'jpeg');
            $extFoto = pathinfo($nama_foto, PATHINFO_EXTENSION);

            // JIKA EXTENSI FOTO TIDAK ADA EXT YANG TERDAFTAR DI ARRAY EXT
            if (!in_array($extFoto, $ext)) {
                echo "Ext tidak ditemukan";
                die;
            } else {
                // pindahkan gambar dari tmp folder ke folder yang sudah kita buat
                // unlink() : mendelete file
                unlink('upload/' . $rowResume['foto']);
                move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/' . $nama_foto);
                $update = mysqli_query($koneksi, "UPDATE resume SET education='$education', sub_education='$sub_education', text_education='$text_education', internship='$internship', sub_internship='$sub_internship', text_internship='$text_internship', organization='$organization', sub_organization='$sub_organization', text_organization='$text_organization' WHERE id ='$id'");
            }
        } else {
            $update = mysqli_query($koneksi, "UPDATE resume SET education='$education', sub_education='$sub_education', text_education='$text_education', internship='$internship', sub_internship='$sub_internship', text_internship='$text_internship', organization='$organization', sub_organization='$sub_organization', text_organization='$text_organization' WHERE id ='$id'");
        }
    } else {
        if (!empty($_FILES['foto']['name'])) {
            $nama_foto = $_FILES['foto']['name'];
            $ukuran_foto = $_FILES['foto']['size'];

            // png, jpg, jpeg
            $ext = array('png', 'jpg', 'jpeg');
            $extFoto = pathinfo($nama_foto, PATHINFO_EXTENSION);

            // JIKA EXTENSI FOTO TIDAK ADA EXT YANG TERDAFTAR DI ARRAY EXT
            if (!in_array($extFoto, $ext)) {
                echo "Ext tidak ditemukan";
                die;
            } else {
                // pindahkan gambar dari tmp folder ke folder yang sudah kita buat
                move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/' . $nama_foto);
                $insert = mysqli_query($koneksi, "INSERT INTO resume (education, sub_education, text_education, internship, sub_internship, text_internship, organization, sub_organization, text_organization) VALUES ('$education','$sub_education','$text_education','$internship','$sub_internship','$text_internship','$organization','$sub_organization','$text_organization')");
            }
        } else {
            $insert = mysqli_query($koneksi, "INSERT INTO resume (education, sub_education, text_education, internship, sub_internship, text_internship) VALUES ('$education','$sub_education','$text_education','$internship','$sub_internship','$text_internship','$organization','$sub_organization','$text_organization')");
        }
    }
    // $_POST: form input name=''
    // $_GET : url ?param='nilai'
    // $_FILES: ngambil nilai dari input type file

    header("location:pengaturan-resume.php");
}




$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($koneksi, "SELECT * FROM user WHERE id ='$id'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

//jika button edit di klik
if (isset($_POST['edit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];

    //jika password di isi sama user 
    if ($_POST['password']) {
        $password = $_POST['password'];
    } else {
        $password = $rowEdit['password'];
    }

    $update = mysqli_query($koneksi, "UPDATE user SET nama='$nama',email='$email',password='$password' WHERE id='$id'");
    header("location:user.php?ubah=berhasil");
}
?>
<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <?php include 'inc/head.php' ?>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <?php include 'inc/sidebar.php' ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <?php include 'inc/nav.php' ?>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <h3 class="card-header">Pengaturan Resume</h3>
                                    <div class="card-body">
                                        <?php if (isset($_GET['hapus'])): ?>
                                            <div class="alert alert-success" role="alert">Data berhasil dihapus</div>
                                        <?php endif ?>

                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden"
                                                        class="form-control"
                                                        name="id"
                                                        value="<?php echo isset($rowResume['id']) ? $rowResume['id'] : '' ?>">

                                            <div class="mb-3 row">
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Education</label>
                                                        <input type="text"
                                                            class="form-control"
                                                            name="education"
                                                            placeholder="Masukkan jurusan anda"
                                                            value="<?php echo isset($rowResume['education']) ? $rowResume['education'] : '' ?>"
                                                            required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Nama Sekolah</label>
                                                        <input type="text"
                                                            class="form-control"
                                                            name="sub_education"
                                                            placeholder="Masukkan nama sekolah anda"
                                                            value="<?php echo isset($rowResume['sub_education']) ? $rowResume['sub_education'] : '' ?>"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Deskripsi Sekolah</label>
                                                        <input type="text"
                                                            class="form-control"
                                                            name="text_education"
                                                            placeholder="Masukkan deskripsi sekolah anda"
                                                            value="<?php echo isset($rowResume['text_education']) ? $rowResume['text_education'] : '' ?>">        
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Posisi Magang</label>
                                                        <input type="text"
                                                            class="form-control"
                                                            name="internship"
                                                            placeholder="Masukkan email anda"
                                                            value="<?php echo isset($rowResume['internship']) ? $rowResume['internship'] : '' ?>">   
                                                    </div>
                                                </div>  
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Nama Perusahaan</label>
                                                        <input type="text"
                                                            class="form-control"
                                                            name="sub_internship"
                                                            placeholder="Masukkan nama perusahaan anda"
                                                            value="<?php echo isset($rowResume['sub_internship']) ? $rowResume['sub_internship'] : '' ?>"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Deskripsi Magang</label>
                                                        <input type="text"
                                                            class="form-control"
                                                            name="text_internship"
                                                            placeholder="Masukkan deskripsi magang anda"
                                                            value="<?php echo isset($rowResume['text_internship']) ? $rowResume['text_internship'] : '' ?>"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Posisi Organisasi</label>
                                                        <input type="text"
                                                            class="form-control"
                                                            name="organization"
                                                            placeholder="Masukkan posisi organisasi anda"
                                                            value="<?php echo isset($rowResume['organization']) ? $rowResume['organization'] : '' ?>"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Nama Organisasi</label>
                                                        <input type="text"
                                                            class="form-control"
                                                            name="sub_organization"
                                                            placeholder="Masukkan nama organisasi anda"
                                                            value="<?php echo isset($rowResume['sub_organization']) ? $rowResume['sub_organization'] : '' ?>"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Deskripsi Organisasi</label>
                                                        <input type="text"
                                                            class="form-control"
                                                            name="text_organization"
                                                            placeholder="Masukkan deskripsi organisasi anda"
                                                            value="<?php echo isset($rowResume['text_organization']) ? $rowResume['text_organization'] : '' ?>"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>  
                                           
                                            <div class="mb-3 row">
                                                <div class="col-sm-12">
                                                    <label for="" class="form-label">Foto</label>
                                                    <input type="file"
                                                        name="foto">
                                                        <img width="150" src="upload/<?php echo isset($rowResume['foto']) ? $rowResume['foto'] : '' ?>" alt="">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <button class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'edit' : 'simpan' ?>" type="submit">
                                                    Simpan
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                ©
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                , made with ❤️ by
                                <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
                            </div>
                            <div>
                                <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                                <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                                <a
                                    href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                                    target="_blank"
                                    class="footer-link me-4">Documentation</a>

                                <a
                                    href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                                    target="_blank"
                                    class="footer-link me-4">Support</a>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/admin/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/admin/assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/admin/assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/admin/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/admin/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/admin/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/admin/assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>