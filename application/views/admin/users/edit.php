<div class="card">
    <div class="card-header">
        <h4>Edit User</h4>
        <a href="<?= base_url('admin/users') ?>" class="btn btn-secondary float-end">Back</a>
    </div>
    <div class="card-body">
        <form action="<?= base_url('admin/users/update/' . $user->id) ?>" method="POST">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control"
                            value="<?= set_value('name', $user->name) ?>">
                        <?= form_error('name', '<small class="text-danger">', '</small>') ?>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control"
                            value="<?= set_value('email', $user->email) ?>">
                        <?= form_error('email', '<small class="text-danger">', '</small>') ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label>Role</label>
                        <select name="role" class="form-control" id="roleSelect">
                            <option value="admin" <?= set_select('role', 'admin', $user->role == 'admin') ?>>Admin</option>
                            <option value="customer" <?= set_select('role', 'customer', $user->role == 'customer') ?>>Customer</option>
                        </select>
                        <?= form_error('role', '<small class="text-danger">', '</small>') ?>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label>Password (Kosongkan jika tidak ingin diubah)</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                </div>
            </div>

            <!-- Customer Detail -->
            <div id="customerFields" style="display:none;">
                <hr>
                <h5>Customer Detail</h5>
                <div class="mb-3">
                    <label>No Telepon</label>
                    <input type="text" name="no_telepon" class="form-control"
                        value="<?= set_value('no_telepon', $user->no_telepon ?? '') ?>">
                    <?= form_error('no_telepon', '<small class="text-danger">', '</small>') ?>
                </div>
                <div class="mb-3">
                    <label>NIK</label>
                    <input type="text" name="nik" class="form-control"
                        value="<?= set_value('nik', $user->nik ?? '') ?>">
                    <?= form_error('nik', '<small class="text-danger">', '</small>') ?>
                </div>
                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control"><?= set_value('alamat', $user->alamat ?? '') ?></textarea>
                    <?= form_error('alamat', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>

            <script>
                function toggleCustomerFields() {
                    const role = document.getElementById('roleSelect').value;
                    document.getElementById('customerFields').style.display = (role === 'customer') ? 'block' : 'none';
                }
                document.getElementById('roleSelect').addEventListener('change', toggleCustomerFields);
                window.onload = toggleCustomerFields;
            </script>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>