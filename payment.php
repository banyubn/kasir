<?php
require 'functions.php';

$harga_total = 0;
foreach ($_SESSION['dataBarang'] as $data) {
    $harga_total += $data['total'];
}

if (isset($_POST['submit'])) {
    pay($harga_total, $_POST['bayar']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Kasir Banyu | Payment</title>

    <link href="print/default.css" rel="stylesheet" type="text/css" media="all" />
    <link href="print/print.css" rel="stylesheet" type="text/css" media="print" />

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='style/poppins-font.css' rel='stylesheet'>
    <link href='style/style.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        p {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <div class="container default text-center">
        <h1 class="my-4 fw-bold">Bayar Sekarang</h1>

        <form action="" method="POST">
            <h6 class="text-start">Masukkan Nominal Uang : </h6>
            <input type="number" name="bayar" class="form-control" placeholder="Jumlah Uang" required>
            <p class="fw-bold text-start mb-4">Total yang harus dibayarkan adalah :
                <?=
                number_format($harga_total, 0, '', '.');
                ?>
            </p>
            <input type="submit" name="submit" value="Bayar" class="btn btn-primary form-control">
            <a href="index.php" class="btn btn-secondary form-control mt-3">Batal</a>
        </form>
    </div>


    <!-- print view -->
    <div class="print">
        <h1 class="fw-thin text-center my-4">Bukti Pembayaran</h1>
        <div class="d-flex">
            <p>Kode Transaksi</p>
            <p class="text-secondary px-1"> #<?= uniqid(); ?></p>
        </div>
        <div class="d-flex">
            <p>Bulan, tanggal</p>
            <p class="text-secondary px-1"> #<?= date("F j, Y");; ?></p>
        </div>
        <hr>
        <?php foreach ($_SESSION['dataBarang'] as $data) : ?>
            <div class="row mx-2">
                <div class="col-sm-6 text-start m-0 p-0">
                    <p><?= $data['nama']; ?></p>
                </div>
                <div class="col-sm-6 text-end m-0 p-0">
                    <p><?= $data['harga']; ?></p>
                    <p class="fw-bold">x <?= $data['jumlah']; ?></p>
                </div>
            </div>
            <hr>
        <?php endforeach; ?>
        <div class="row">
            <div class="col-sm-6 text-start">
                <p class="fw-bold">Uang yang Dibayarkan</p>
                <p class="fw-bold">Total</p>
                <p class="fw-bold">Kembalian</p>
            </div>
            <div class="col-sm-6 text-end">
                <p class="fw-bold"><?= number_format($_POST['bayar'], 0, '', '.') ?></p>
                <p class="fw-bold"><?= number_format($harga_total, 0, '', '.'); ?></p>
                <p class="fw-bold"><?= number_format($_POST['bayar'] - $harga_total, 0, '', '.') ?></p>
            </div>
        </div>
        <p class="text-secondary text-center" style="padding-top: 100px;">Terima kasih sudah berbelanja di toko kami!</p>
    </div>

</body>

</html>