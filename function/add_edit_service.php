<?php
include "../koneksi.php";
session_start();
session_regenerate_id();
if (empty($_SESSION['email'])) {
    header('Location: login.php');
}
if (isset($_POST['adds'])) {
    $namas = $_POST['namas'];
    $fotos = $_FILES['fotos'];

    if ($fotos['error'] == 0) {
        $fillName = uniqid() . "_" . basename($fotos["name"]);
        $fillPath = "../assets/upload/" . $fillName;
        move_uploaded_file($fotos['tmp_name'], $fillPath);

        $q_insert = mysqli_query($connect, "INSERT INTO services (namas, fotos) VALUES ('$namas','$fillName')");
        if ($q_insert) {
            header("location:../admin/service.php?tambah=berhasil");
        } else {
            header("location:add_edit_service.php");
        };
    };
};

if (isset($_GET['idEdits'])) {
    $id = base64_decode($_GET['idEdits']);
    $edits = mysqli_query($connect, "SELECT * FROM services WHERE id='$id'");
    $row = mysqli_fetch_assoc($edits);
}
if (isset($_POST['edits'])) {
    $id = base64_decode($_GET['idEdits']);
    $namas = $_POST['namas'];
    $fotos = $_FILES['fotos'];

    if ($fotos["error"] == 0) {
        $fillName = uniqid() . "_" . basename($fotos["name"]);
        $fillPath = "../assets/upload/" . $fillName;
        $fillfotos = "";
        if (move_uploaded_file($fotos['tmp_name'], $fillPath)) {
            // CEK FOTO
            $cekfotos = mysqli_query($connect, "SELECT fotos FROM services WHERE id=$id");
            $rowfotos = mysqli_fetch_assoc($cekfotos);
            //Jika ada fotonya maka di unlink terlebih dahulu!
            if ($rowfotos && file_exists("../assets/upload/" . $rowfotos['fotos'])) {
                unlink("../assets/upload/" . $rowfotos['fotos']);
            }
            $fieldfotos = "fotos='$fillName',";
        } else {
            $fieldfotos = "";
            echo "GAGAL BOSKUH";
        }
    }

    $update_s = mysqli_query($connect, "UPDATE services SET " . $fieldfotos . " namas='$namas' WHERE id=$id ");
    if ($update_s) {
        header("location:../admin/service.php");
    } else {
        header("location:add_edit_service.php?idEdits=$id ");
    }
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
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-12">
                                <div class="card m-3">
                                    <div class="card-header text-center fw-bold"><?= isset($_GET['idEdits']) ? 'Edit ' : 'Add ' ?>Service</div>

                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="m-3">
                                            <label for="" class="form-lable">Nama Service</label>
                                            <input type="text" name="namas" class="form-control" value="<?= isset($_GET['idEdits']) ? $row['namas'] : '' ?>">
                                        </div>
                                        <div class="m-3">
                                            <label for="" class="form-lable">Foto</label>
                                            <input type="file" name="fotos" class="form-control" src="<?= isset($_GET['idEdits']) ? $row['fotos'] : '' ?>">
                                        </div>
                                        <?php if (isset($_GET['idEdits'])) {
                                        ?>
                                            <div class="m-3">
                                                <img src="../assets/upload/<?= $row['fotos'] ?>" width="100" alt="">
                                            </div>
                                        <?php
                                        } ?>

                                        <div class="m-3">
                                            <a class="btn btn-secondary" href="../admin/service.php">Back</a>
                                            <button class="btn btn-success" type="submit" name="<?= isset($_GET['idEdits']) ? 'edits' : 'adds' ?>"><?= isset($_GET['idEdits']) ? 'Update' : 'Add' ?></button>

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