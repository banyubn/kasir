<?php
session_start();

if (!isset($_SESSION["dataBarang"])) {
    $_SESSION["dataBarang"] = [];
}
function create($barang, $harga, $jumlah)
{
    if ($barang == "" || $harga == "" || $jumlah == "") {
        echo "
        <script>
            alert('Data tidak boleh kosong!');
            document.location.href = 'index.php';
        </script>";

        header('location: index.php');
    } else {
        $data = array(
            'nama' => $barang,
            'harga' => $harga,
            'jumlah' => $jumlah,
            'total' => $harga * $jumlah,
        );

        array_push($_SESSION["dataBarang"], $data);
    }
}

function destroy($id)
{
    unset($_SESSION['dataBarang'][$id]);

    header('location: index.php');

    $_SESSION['alert'] = 'Data kamu berhasil di hapus!';
}

function pay($harga_total, $bayar)
{
    if ($bayar < $harga_total) {
        echo '
        <div class="alert alert-danger" role="alert">
            Uang kamu ngga cukup!
        </div>
        ';
    } else {
        echo '
            <script>
                window.print();
            </script>
        ';
    }
}
