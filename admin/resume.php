<?php
include("../koneksi.php");
session_start();
session_regenerate_id();
$rows = mysqli_query($connect, "SELECT * FROM resume ORDER BY id DESC");
if (empty($_SESSION['email'])) {
    header('Location: login.php');
}
if (isset($_GET['idDeleter'])) {
    $id = $_GET['idDeleter'];

    $deleter = mysqli_query($connect, "DELETE FROM resume WHERE id='$id'");
    header('Location:resume.php?deleter=berhasil');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Resume</title>
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
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css"> -->

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"> -->
</head>


<!-- Menyertakan jQuery -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

<!-- Menyertakan JavaScript DataTables -->
<!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> -->
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css"> -->

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
                                    <div class="card-header text-center fw-bold">Resume</div>
                                    <?php
                                    if (isset($_GET['insert']) && $_GET['insert'] == "berhasil") {
                                    ?>
                                        <div class="alert alert-success text-center" role="alert">
                                            Tambah Data Berhasil!!
                                        </div>

                                    <?php
                                    } ?>
                                    <?php
                                    if (isset($_GET['deleter']) && $_GET['deleter'] == "berhasil") {
                                    ?>
                                        <div class="alert alert-danger text-center" role="alert">
                                            Hapus Data Berhasil!!
                                        </div>
                                    <?php
                                    } ?>

                                    <div class="card-body">
                                        <div class="mt-1 mb-1">
                                            <a href="../function/add_edit_resume.php" class="btn btn-primary m-3">Create</a>
                                        </div>
                                        <div class="table table-responsive">
                                            <table class="table table-bordered text-center" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Tahun</th>
                                                        <th>Skill</th>
                                                        <th>Instansi</th>
                                                        <th>Deskripsi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no = 1;
                                                    foreach ($rows as $row) {
                                                    ?>

                                                        <tr>
                                                            <td><?= $no++ ?></td>
                                                            <td><?= $row['tahun_awal'] ?> - <?= $row['tahun_akhir'] ?></td>
                                                            <td><?= $row['skill'] ?></td>
                                                            <td><?= $row['instansi'] ?></td>
                                                            <td><?= $row['deskripsi'] ?></td>
                                                            <td>
                                                                <a href="../function/add_edit_resume.php?idEditr=<?= base64_encode($row['id']) ?>" class="btn btn-primary ">Edit</a>
                                                                <a onclick="return confirm ('Apakah Anda Yaking Ingin Menghapus??')" href="resume.php?idDeleter= <?= $row['id'] ?>" class="btn btn-danger">Delete</a>
                                                                <a target="_blank" href="print-pdf.php?idprt=<?= $row['id'] ?>" class="btn btn-secondary sm">Print-PDF</a>
                                                            </td>

                                                        </tr>
                                                    <?php
                                                    } ?>
                                                </tbody>

                                            </table>

                                            <!-- target="_blank" berfungsi untuk menambahkan tab baru pada saat print pdf -->
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
    <script src="https://cdn.datatables.net/v/bs5/dt-2.2.2/datatables.min.js" integrity="sha384-k90VzuFAoyBG5No1d5yn30abqlaxr9+LfAPp6pjrd7U3T77blpvmsS8GqS70xcnH" crossorigin="anonymous"></script>
    <script
        src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script> -->
    <script>
        let dataTable = new DataTable("#myTable");
    </script>
    <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
</body>

</html>