<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Daftar Transaksi Saya</h5>
        <a href="<?= base_url() ?>" class="btn btn-primary">
            <i class="bx bx-plus"></i> Buat Transaksi
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Mobil</th>
                        <th>No Plat</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($transactions) > 0): ?>
                        <?php foreach ($transactions as $i => $t): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= $t->car_name ?></td>
                                <td><?= $t->no_plat ?></td>
                                <td><?= date('d/m/Y', strtotime($t->rent_date)) ?></td>
                                <td><?= date('d/m/Y', strtotime($t->return_date)) ?></td>
                                <td>Rp <?= number_format($t->total, 0, ',', '.') ?></td>
                                <td>
                                    <?php if ($t->status == 'pending'): ?>
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    <?php elseif ($t->status == 'paid'): ?>
                                        <span class="badge bg-info">Paid</span>
                                    <?php elseif ($t->status == 'completed'): ?>
                                        <span class="badge bg-success">Completed</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Cancel</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('customertransactions/show/' . $t->id) ?>" class="btn btn-sm btn-primary">
                                        <i class="bx bx-detail"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">Belum ada transaksi.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>