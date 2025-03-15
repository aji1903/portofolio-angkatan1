<?php
include "../koneksi.php";
session_start();
session_regenerate_id();
if (empty($_SESSION['email'])) {
    header('Location: login.php');
}
if (isset($_POST['add'])) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $foto = $_FILES['foto'];

    if ($foto['error'] == 0) {
        $fillName = uniqid() . "_" . basename($foto["name"]);
        $fillPath = "../assets/upload/" . $fillName;
        move_uploaded_file($foto['tmp_name'], $fillPath);
        $insert_p = mysqli_query($connect, "INSERT INTO project (nama, kategori, foto) VALUES ('$nama','$kategori','$fillName')");
        if ($insert_p) {
            header("location:../admin/project.php?tambah=berhasil");
        } else {
            header("location:tambah-project.php?tambah=gagal");
        };
    };
}



if (isset($_GET['edit'])) {
    $id = base64_decode($_GET['edit']);
    $editr = mysqli_query($connect, "SELECT * FROM project WHERE id='$id'");
    $row = mysqli_fetch_assoc($editr);
}
if (isset($_POST['edit'])) {
    $id = base64_decode($_GET['edit']);
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $foto = $_FILES['foto'];
    unlink("../assets/upload/" . $row['foto']);

    if ($foto['error'] == 0) {
        $fillName = uniqid() . "_" . basename($foto["name"]);
        $fillPath = "../assets/upload/" . $fillName;
        move_uploaded_file($foto['tmp_name'], $fillPath);
    };

    $update = mysqli_query($connect, "UPDATE project SET nama='$nama', kategori='$kategori', foto='$fillName' WHERE id=$id ");
    if ($update) {
        header("location:../admin/project.php?edit=berhasil");
    } else {
        header("location:add_edit_project.php?edit=$id ");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Project</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-ico n">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <?php include "../inc/navbar.php" ?>
    <!-- ======= Sidebar ======= -->
    <?php include "../inc/sidebar.php" ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Blank Page</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Pages</li>
                    <li class="breadcrumb-item active">Blank</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="container">
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-12">
                                <div class="card m-3">
                                    <div class="card-header text-center fw-bold"><?= isset($_GET['edit']) ? 'Edit ' : 'Add ' ?>Project</div>

                                    <form action="" method="post" enctype="multipart/form-data">
                                        <!-- eksekusi input dengan $_FILE wajib menggunakan enctype="multipart/form-data" -->
                                        <div class="m-3">
                                            <label for="" class="form-lable">Nama</label>
                                            <input type="text" name="nama" class="form-control" value="<?= isset($_GET['edit']) ? $row['nama'] : '' ?>">
                                        </div>
                                        <div class="m-3">
                                            <label for="" class="form-lable">Kategori</label>
                                            <input type="text" name="kategori" class="form-control" value="<?= isset($_GET['edit']) ? $row['kategori'] : '' ?>">
                                        </div>
                                        <div class="m-3">
                                            <label for="" class="form-lable">Foto</label>
                                            <input type="file" name="foto" class="form-control">
                                            <?php if (isset($_GET['edit'])) {
                                            ?>
                                                <div class="m-3">
                                                    <img src="../assets/upload/<?= $row['foto'] ?>" width="100">
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <!-- <div class="m-3">
                                            <label for="" class="form-lable">Instansi</label>
                                            <input type="text" name="instansi" class="form-control" value="<?= isset($_GET['edit']) ? $row['instansi'] : '' ?>">
                                        </div>
                                        <div class="m-3">
                                            <label for="" class="form-lable">Deskripsi</label>
                                            <textarea name="deskripsi" cols="4" class="form-control" id=""><?= isset($_GET['edit']) ? $row['deskripsi'] : '' ?></textarea>
                                        </div> -->
                                        <!-- <?php if (isset($_GET['edit'])) {
                                                ?>
                                            <div class="m-3">
                                                <img src="assets/upload/<?= $row['foto'] ?>" width="100" alt="">
                                            </div>
                                        <?php
                                                } ?> -->

                                        <div class="m-3">
                                            <a class="btn btn-secondary" href="../admin/project.php">Back</a>
                                            <button class="btn btn-success" type="submit" name="<?= isset($_GET['edit']) ? 'edit' : 'add' ?>"><?= isset($_GET['edit']) ? 'Update' : 'Add' ?></button>

                                        </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>

</body>

</html>