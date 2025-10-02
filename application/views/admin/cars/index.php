<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5 class="mb-0">Cars List</h5>
        <a href="<?= site_url('admin/cars/create') ?>" class="btn btn-primary btn-sm">Add Car</a>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>No Plat</th>
                    <th>Rent Price</th>
                    <th>Year</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($cars as $car): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $car->category_name ?></td>
                        <td><?= $car->name ?></td>
                        <td><?= $car->type ?></td>
                        <td><?= $car->no_plat ?></td>
                        <td><?= number_format($car->rent_price, 2) ?></td>
                        <td><?= $car->year ?></td>
                        <td>
                            <span class="badge bg-<?= $car->status == 'available' ? 'success' : 'danger' ?>">
                                <?= ucfirst($car->status) ?>
                            </span>
                        </td>
                        <td>
                            <?php if ($car->image): ?>
                                <img src="<?= base_url($car->image) ?>" alt="" width="60">
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= site_url('admin/cars/edit/' . $car->id) ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="<?= site_url('admin/cars/delete/' . $car->id) ?>"
                                onclick="return confirm('Delete this car?')"
                                class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>