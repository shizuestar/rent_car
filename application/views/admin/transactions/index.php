<div class="card">
    <div class="card-header">
        <h4>Transactions</h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Car</th>
                    <th>Rent Date</th>
                    <th>Return Date</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transactions as $t): ?>
                    <tr>
                        <td><?= $t->id ?></td>
                        <td><?= $t->customer_name ?></td>
                        <td><?= $t->car_name ?> (<?= $t->no_plat ?>)</td>
                        <td><?= $t->rent_date ?></td>
                        <td><?= $t->return_date ?></td>
                        <td>Rp <?= number_format($t->total, 0, ',', '.') ?></td>
                        <td><span class="badge bg-<?= $t->status == 'paid' ? 'success' : 'warning' ?>"><?= ucfirst($t->status) ?></span></td>
                        <td>
                            <a href="<?= base_url('admin/transactions/detail/' . $t->id) ?>" class="btn btn-sm btn-info">Detail</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>