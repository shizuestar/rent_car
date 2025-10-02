<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h4>Transaction #<?= $transaction->id ?></h4>
        <div>
            <?php if ($transaction->status == 'paid'): ?>
                <a href="<?= base_url('admin/transactions/set_completed/' . $transaction->id) ?>"
                    class="btn btn-success"
                    onclick="return confirm('Set this transaction as completed?')">
                    Set Completed
                </a>
            <?php endif; ?>
            <a href="<?= base_url('admin/transactions') ?>" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="card-body">
        <p><b>Customer:</b> <?= $transaction->customer_name ?> (<?= $transaction->customer_email ?>)</p>
        <p><b>Car:</b> <?= $transaction->car_name ?> (<?= $transaction->no_plat ?>)</p>
        <p><b>Rent Date:</b> <?= $transaction->rent_date ?></p>
        <p><b>Return Date:</b> <?= $transaction->return_date ?></p>
        <p><b>Total:</b> Rp <?= number_format($transaction->total, 0, ',', '.') ?></p>
        <p><b>Status:</b>
            <span class="badge 
        <?php if ($transaction->status == 'paid') echo 'bg-success'; ?>
        <?php if ($transaction->status == 'completed') echo 'bg-primary'; ?>
        <?php if ($transaction->status == 'pending') echo 'bg-warning text-dark'; ?>">
                <?= ucfirst($transaction->status) ?>
            </span>
        </p>


        <hr>
        <h5>Payments</h5>
        <?php if (!empty($transaction->payments)): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Method</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Proof</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transaction->payments as $p): ?>
                        <tr>
                            <td><?= ucfirst($p->method) ?></td>
                            <td>Rp <?= number_format($p->amount, 0, ',', '.') ?></td>
                            <td>
                                <span class="badge bg-<?= $p->status == 'verify' ? 'success' : 'warning text-dark' ?>">
                                    <?= ucfirst($p->status) ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($p->payment_proof): ?>
                                    <a href="<?= base_url('uploads/payments/' . $p->payment_proof) ?>" target="_blank">View Proof</a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($p->status == 'pending'): ?>
                                    <a href="<?= base_url('admin/transactions/verify_payment/' . $p->id . '/' . $transaction->id) ?>"
                                        class="btn btn-sm btn-success"
                                        onclick="return confirm('Verify pembayaran ini?')">
                                        Verify
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <?php if ($transaction->status == 'pending'): ?>
            <hr>
            <h5>Add Payment (Cash)</h5>
            <form action="<?= base_url('admin/transactions/store_payment/' . $transaction->id) ?>" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label>Method</label>
                    <select name="method" class="form-control">
                        <option value="cash">Cash</option>
                        <option value="transfer">Transfer</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Amount</label>
                    <input type="number" name="amount" class="form-control" value="<?= $transaction->total ?>">
                </div>
                <div class="mb-3">
                    <label>Payment Proof (Optional if Cash)</label>
                    <input type="file" name="payment_proof" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Save Payment</button>
            </form>
        <?php endif; ?>
    </div>
</div>