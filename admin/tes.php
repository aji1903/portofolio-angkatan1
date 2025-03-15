<?php
include "../koneksi.php";

$resume_c = mysqli_query($connect, "SELECT * FROM kontak");
$row = mysqli_fetch_all($resume_c, MYSQLI_ASSOC);

?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contoh DataTables</title>

    <!-- Menyertakan CSS DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

    <!-- Menyertakan jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Menyertakan JavaScript DataTables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

</head>

<body>

    <h2>Tabel Interaktif dengan DataTables</h2>

    <!-- Tabel yang ingin diberi fitur DataTables -->
    <table id="mytable" class="table table-bordered text-center">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>

            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($row as $rows) {
                # code...

            ?>
                <tr>
                    <td><?= $rows['nama'] ?></td>
                    <td><?= $rows['email'] ?></td>
                    <td><?= $rows['subject'] ?></td>
                    <td><?= $rows['message'] ?></td>

                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables pada tabel dengan id "myTable"
            $('#mytable').DataTable();
        });
    </script>

</body>

</html>