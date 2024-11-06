<?php
session_start();
include 'koneksi.php';

// jika button simpan ditekan
$queryPengaturan = mysqli_query($koneksi, "SELECT * FROM general_setting ORDER BY id DESC");
$rowPengaturan = mysqli_fetch_assoc($queryPengaturan);
if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $sub_judul = $_POST['sub_judul'];
    $ig_link = $_POST['ig_link'];
    $linkedin_link = $_POST['linkedin_link'];
    $site_name = $_POST['site_name'];


    // mencari data di dalam table pengaturan, jika ada data akan diupdate, jika tidak ada akan di insert
    if (mysqli_num_rows($queryPengaturan) > 0) {
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
                unlink('upload/' . $rowPengaturan['foto']);
                move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/' . $nama_foto);
                $update = mysqli_query($koneksi, "UPDATE general_setting SET judul='$judul', sub_judul='$sub_judul', foto='$nama_foto', ig_link='$ig_link', linkedin_link='$linkedin_link', site_name='$site_name' WHERE id ='$id'");
            }
        } else {
            $update = mysqli_query($koneksi, "UPDATE general_setting SET judul='$judul', sub_judul='$sub_judul', ig_link='$ig_link', linkedin_link='$linkedin_link', site_name='$site_name' WHERE id ='$id'");
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
                $insert = mysqli_query($koneksi, "INSERT INTO general_setting (judul, sub_judul, foto, ig_link, linkedin_link, site_name) VALUES ('$judul','$sub_judul','$nama_foto','$ig_link','$linkedin_link','$site_name')");
            }
        } else {
            $insert = mysqli_query($koneksi, "INSERT INTO general_setting (judul, sub_judul, ig_link, linkedin_link, site_name) VALUES ('$judul','$sub_judul','$ig_link','$linkedin_link','$site_name')");
        }
    }
    // $_POST: form input name=''
    // $_GET : url ?param='nilai'
    // $_FILES: ngambil nilai dari input type file

    header("location:pengaturan-website.php");
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
                                    <h3 class="card-header">Pengaturan Website</h3>
                                    <div class="card-body">
                                        <?php if (isset($_GET['hapus'])): ?>
                                            <div class="alert alert-success" role="alert">Data berhasil dihapus</div>
                                        <?php endif ?>

                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden"
                                                        class="form-control"
                                                        name="id"
                                                        value="<?php echo isset($rowPengaturan['id']) ? $rowPengaturan['id'] : '' ?>">

                                            <div class="mb-3 row">
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Judul</label>
                                                        <input type="text"
                                                            class="form-control"
                                                            name="judul"
                                                            placeholder="Masukkan judul portfolio"
                                                            value="<?php echo isset($rowPengaturan['judul']) ? $rowPengaturan['judul'] : '' ?>"
                                                            required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Sub Judul</label>
                                                        <input type="text"
                                                            class="form-control"
                                                            name="sub_judul"
                                                            placeholder="Masukkan sub judul portfolio"
                                                            value="<?php echo isset($rowPengaturan['sub_judul']) ? $rowPengaturan['sub_judul'] : '' ?>"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Link Instagram</label>
                                                        <input type="url"
                                                            class="form-control"
                                                            name="ig_link"
                                                            placeholder="Masukkan Link Instagram Anda"
                                                            value="<?php echo isset($rowPengaturan['ig_link']) ? $rowPengaturan['ig_link'] : '' ?>">
                                                            
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Link Linkedin</label>
                                                        <input type="url"
                                                            class="form-control"
                                                            name="linkedin_link"
                                                            placeholder="Masukkan Link Linkedin Anda"
                                                            value="<?php echo isset($rowPengaturan['linkedin_link']) ? $rowPengaturan['linkedin_link'] : '' ?>">
                                                            
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Site Name</label>
                                                        <input type="sitename"
                                                            class="form-control"
                                                            name="site_name"
                                                            placeholder="Masukkan site name anda"
                                                            value="<?php echo isset($rowPengaturan['site_name']) ? $rowPengaturan['site_name'] : '' ?>">
                                                            
                                                    </div>
                                            </div>
                                           
                                            <div class="mb-3 row">
                                                <div class="col-sm-12">
                                                    <label for="" class="form-label">Foto</label>
                                                    <input type="file"
                                                        name="foto">
                                                        <img width="150" src="upload/<?php echo isset($rowPengaturan['foto']) ? $rowPengaturan['foto'] : '' ?>" alt="">
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