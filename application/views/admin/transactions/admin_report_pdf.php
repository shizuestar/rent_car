<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 6px;
            text-align: left;
        }

        h3 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h3>Laporan Transaksi Rental Mobil</h3>
    <p>
        Periode: <?= $start_date ?> s/d <?= $end_date ?><br>
        Status: <?= $status == 'all' ? 'Semua' : ucfirst($status) ?>
    </p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Customer</th>
                <th>Mobil</th>
                <th>No Plat</th>
                <th>Tanggal Sewa</th>
                <th>Tanggal Kembali</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($transactions)): ?>
                <?php $no = 1;
                foreach ($transactions as $t): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $t->user_name ?></td>
                        <td><?= $t->car_name ?></td>
                        <td><?= $t->no_plat ?></td>
                        <td><?= $t->rent_date ?></td>
                        <td><?= $t->return_date ?></td>
                        <td>Rp <?= number_format($t->total, 0, ',', '.') ?></td>
                        <td><?= ucfirst($t->status) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" style="text-align:center">Tidak ada data transaksi</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>