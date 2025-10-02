<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h4 class="mb-0">Management Users</h4>
        <a href="<?= base_url('admin/users/create') ?>" class="btn btn-primary float-end">Create User</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Customer Info</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($users as $u): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $u->name ?></td>
                        <td><?= $u->email ?></td>
                        <td><?= $u->role ?></td>
                        <td>
                            <?php if ($u->role == 'customer'): ?>
                                Telp: <?= $u->no_telepon ?? '-' ?><br>
                                NIK: <?= $u->nik ?? '-' ?><br>
                                Alamat: <?= $u->alamat ?? '-' ?>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= base_url('admin/users/edit/' . $u->id) ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="<?= base_url('admin/users/delete/' . $u->id) ?>" onclick="return confirm('Delete user?')" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>