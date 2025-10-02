<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3>Detail Transaksi</h3>
        <?php if ($transaction->status == 'pending'): ?>
            <a href="<?= base_url('customertransactions/cancel/' . $transaction->id) ?>"
                class="btn btn-danger"
                onclick="return confirm('Yakin ingin membatalkan transaksi ini?')">
                <i class="bx bx-x"></i> Batalkan
            </a>
        <?php endif; ?>
    </div>
    <div class="card-body">
        <dl class="row mb-0">
            <dt class="col-sm-3">Mobil</dt>
            <dd class="col-sm-9"><?= $transaction->car_name ?> (<?= $transaction->no_plat ?>)</dd>

            <dt class="col-sm-3">Tanggal Pinjam</dt>
            <dd class="col-sm-9"><?= date('d/m/Y', strtotime($transaction->rent_date)) ?></dd>

            <dt class="col-sm-3">Tanggal Kembali</dt>
            <dd class="col-sm-9"><?= date('d/m/Y', strtotime($transaction->return_date)) ?></dd>

            <dt class="col-sm-3">Status Peminjaman</dt>
            <dd class="col-sm-9">
                <?php if ($transaction->status == 'pending'): ?>
                    <span class="badge bg-warning text-dark">Pending</span>
                <?php elseif ($transaction->status == 'paid'): ?>
                    <span class="badge bg-info">Paid</span>
                <?php elseif ($transaction->status == 'completed'): ?>
                    <span class="badge bg-success">Completed</span>
                <?php else: ?>
                    <span class="badge bg-danger">Cancel</span>
                <?php endif; ?>
            </dd>

            <dt class="col-sm-3">Total</dt>
            <dd class="col-sm-9">Rp <?= number_format($transaction->total, 0, ',', '.') ?></dd>
        </dl>
        <hr>

        <div class="d-flex align-items-center justify-content-between mb-2">
            <h6 class="mb-0 me-2">Pembayaran</h6>
            <?php if (empty($transaction->payments)): ?>
                <span class="badge bg-danger">Belum Bayar</span>
            <?php else: ?>
                <?php
                $payment_status = $transaction->payments[0]->status;
                if ($payment_status == 'pending') {
                    echo '<span class="badge bg-warning text-dark">Pending</span>';
                } elseif ($payment_status == 'verify') {
                    echo '<span class="badge bg-success">Sudah Bayar</span>';
                }
                ?>
            <?php endif; ?>
        </div>

        <?php if (!empty($transaction->payments)): ?>
            <ul class="list-group">
                <?php foreach ($transaction->payments as $p): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>
                            <?= ucfirst($p->method) ?> - Rp <?= number_format($p->amount, 0, ',', '.') ?>
                            <?php if ($p->payment_proof): ?>
                                <a href="<?= base_url('uploads/payments/' . $p->payment_proof) ?>" target="_blank" class="ms-2">[Bukti]</a>
                            <?php endif; ?>
                        </span>
                        <span class="badge bg-<?= $p->status == 'verify' ? 'success' : 'warning text-dark' ?>">
                            <?= ucfirst($p->status) ?>
                        </span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <!-- Form Tambah Pembayaran -->
            <form action="<?= base_url('customertransactions/add_payment/' . $transaction->id) ?>" method="POST" enctype="multipart/form-data" class="mt-3">
                <div class="row">
                    <div class="mb-3 col-12 col-md-6">
                        <label for="method" class="form-label">Metode Pembayaran</label>
                        <select name="method" id="method" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="cash">Cash</option>
                            <option value="transfer">Transfer</option>
                        </select>
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="amount" class="form-label">Jumlah Dibayar</label>
                        <input type="number" name="amount" id="amount" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="payment_proof" class="form-label">Upload Bukti Pembayaran</label>
                    <input type="file" name="payment_proof" id="payment_proof" class="form-control" accept="image/*" required>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary"><i class="bx bx-upload"></i> Upload Pembayaran</button>
                </div>
            </form>
        <?php endif; ?>

    </div>
</div>