<?php
include("../koneksi.php");
session_start();
session_regenerate_id();
$rows = mysqli_query($connect, "SELECT * FROM services ORDER BY id DESC");
if (empty($_SESSION['email'])) {
    header('Location: login.php');
}
if (isset($_GET['idDeletes'])) {
    $id = $_GET['idDeletes'];

    $fotos = mysqli_query($connect, "SELECT * FROM services WHERE id='$id'");
    $rowpoto = mysqli_fetch_assoc($fotos);

    unlink("assets/upload/" . $rowpoto['fotos']);
    $delete = mysqli_query($connect, "DELETE FROM services WHERE id='$id'");
    header('Location:service.php?hapus=berhasil');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Service</title>
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
                        <div class="row mt-2">
                            <div class="col-12"></div>
                            <div class="col-12">
                                <div class="card ">
                                    <div class="card-header text-center fw-bold">Service</div>
                                    <?php
                                    if (isset($_GET['tambah']) && $_GET['tambah'] == "berhasil") {
                                    ?>
                                        <div class="alert alert-success text-center" role="alert">
                                            Tambah Data Berhasil!
                                        </div>

                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if (isset($_GET['hapus']) && $_GET['hapus'] == "berhasil") {
                                    ?>
                                        <div class="alert alert-danger text-center" role="alert">
                                            Hapus Data Berhasil!
                                        </div>

                                    <?php
                                    }
                                    ?>

                                    <div class="card-body">
                                        <div class="mt-1 mb-1">
                                            <a href="../function/add_edit_service.php" class="btn btn-primary m-3">Create</a>
                                        </div>
                                        <div class="table table-responsive ">
                                            <table class="table table-bordered text-canter">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Service</th>
                                                    <th>Foto</th>
                                                    <th>Action</th>

                                                </tr>
                                                <?php
                                                $no = 1;
                                                foreach ($rows as $row) {
                                                ?>

                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $row['namas'] ?></td>
                                                        <td><img src="../assets/upload/<?= $row['fotos'] ?>" width="100" alt=""></td>


                                                        <td>
                                                            <a href="../function/add_edit_service.php?idEdits=<?= base64_encode($row['id']) ?>" class="btn btn-primary mb-2">Edit</a>
                                                            <a onclick="return confirm ('Apakah Anda Yaking Ingin Menghapus??')" href="service.php?idDeletes= <?= $row['id'] ?>" class="btn btn-danger">Delete</a>
                                                            <form action="profile.php?idst=<?= $row['id'] ?>" method="post">
                                                                <input onchange="this.form.submit()" type="radio" name="status" <?= isset($row['status']) && $row['status'] == 1 ? 'checked' : '' ?> value="1">
                                                            </form>
                                                        </td>

                                                    </tr>
                                                <?php
                                                } ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
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