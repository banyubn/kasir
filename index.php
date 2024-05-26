<?php
require 'functions.php';

if (isset($_POST['submit'])) {
    create($_POST['barang'], $_POST['harga'], $_POST['jumlah']);
}

//Alert(s)
if (isset($_SESSION['alert'])) {
    $alert = $_SESSION['alert'];
    unset($_SESSION['alert']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='style/poppins-font.css' rel='stylesheet'>
    <link href='style/style.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Kasir Banyu</title>

    <!-- Font Awesome Icon -->
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css' rel='stylesheet'>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- DataTable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
</head>

<body>
    <?php if (@$alert) : ?>
        <div class="alert alert-success">
            <?php echo htmlspecialchars($alert); ?>
        </div>
    <?php endif; ?>

    <div class="container mt-3">
        <h1 class="fw-bold mb-1 p-0 text-center">Masukkan Data Barang</h1>
        <h6 class="text-secondary text-center">Project data barang <span class="fw-bold">Banyu Bagastara Nugroho | PPLG X-1</span></h6>
        <form action="" method="POST" class="mt-4">
            <label for="barang" class="text-secondary fw-bold">Nama : </label>
            <input class="inp-txt" type="text" name="barang" id="barang" placeholder="Nama Barang ..." required>
            <br>
            <label for="harga" class="text-secondary fw-bold">Harga : </label>
            <input class="inp-txt" type="number" name="harga" id="harga" placeholder="Harga ..." required>
            <br>
            <label for="jumlah" class="text-secondary fw-bold">Jumlah : </label>
            <input class="inp-txt" type="number" name="jumlah" id="jumlah" placeholder="Jumlah ..." required>
            <br>
            <button class="btn btn-primary form-control" type="submit" name="submit"><i class="fa fa-plus"></i> Tambah</button>
            <br>
            <a href="payment.php" class="btn btn-success form-control mt-4 <?= empty($_SESSION['dataBarang']) ? 'd-none' : 'd-block' ?>">Bayar</a>
        </form>
    </div>

    <div class="display container mt-5 d-flex justify-content-center flex-column">
        <table id="myTable" class="display" style="width: 100%;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($_SESSION["dataBarang"] as $key => $brg) : ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= htmlspecialchars($brg['nama']) ?></td>
                        <td><?= htmlspecialchars(number_format($brg['harga'], 0, '', '.')) ?></td>
                        <td><?= htmlspecialchars($brg['jumlah']) ?></td>
                        <td><?= htmlspecialchars(number_format($brg['total'], 0, '', '.')) ?></td>
                        <td>
                            <a href='delete.php?id=<?= $key ?>' class="btn btn-danger ms-2">Delete</a>
                        </td>
                    </tr>
                    <?php $no++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <hr>
        <div class="row total-barang">
            <div class="col-md-10 text-center">
                <h4>Total Barang</h4>
            </div>
            <div class="col-md-2 text-center">
                <h4>
                    <?= count($_SESSION['dataBarang']); ?>
                </h4>
            </div>
        </div>
        <hr>
        <div class="row total-harga">
            <div class="col-md-10 text-center">
                <h4>Total Harga</h4>
            </div>
            <div class="col-md-2 text-center">
                <h4>
                    <?php
                    $harga_total = 0;
                    foreach ($_SESSION['dataBarang'] as $data) {
                        $harga_total += $data['total'];
                    }
                    echo 'Rp ' . number_format($harga_total, 0, '', '.');
                    ?>
                </h4>
            </div>
        </div>
        <hr>
    </div>

    <script>
        //DataTables jQuery
        $(document).ready(function() {
            $('#myTable').DataTable({
                "bPaginate": false,
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": false,
                "bAutoWidth": false,
                "responsive": true,
                "columns": [{
                    width: '5%'
                }, {
                    width: '50%'
                }, {
                    width: '15%'
                }, null, null, {
                    width: '10%'
                }],
                "columnDefs": [{
                        responsivePriority: 1,
                        targets: 5
                    },
                    {
                        responsivePriority: 2,
                        targets: 1
                    },
                    {
                        responsivePriority: 3,
                        targets: 4
                    },
                    {
                        responsivePriority: 4,
                        targets: 2
                    },
                    {
                        responsivePriority: 5,
                        targets: 0
                    },
                    {
                        responsivePriority: 6,
                        targets: 3
                    },
                ],
            });
        });
    </script>
</body>

</html>