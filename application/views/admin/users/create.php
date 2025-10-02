<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h4>Create User</h4>
        <a href="<?= base_url('admin/users') ?>" class="btn btn-secondary float-end">Back</a>
    </div>
    <div class="card-body">
        <form action="<?= base_url('admin/users/store') ?>" method="POST">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="<?= set_value('name') ?>">
                        <?= form_error('name', '<small class="text-danger">', '</small>') ?>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?= set_value('email') ?>">
                        <?= form_error('email', '<small class="text-danger">', '</small>') ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label>Role</label>
                        <select name="role" class="form-control" id="roleSelect">
                            <option value="admin" <?= set_select('role', 'admin') ?>>Admin</option>
                            <option value="customer" <?= set_select('role', 'customer') ?>>Customer</option>
                        </select>
                        <?= form_error('role', '<small class="text-danger">', '</small>') ?>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                        <?= form_error('password', '<small class="text-danger">', '</small>') ?>
                    </div>
                </div>
            </div>

            <div id="customerFields" style="display:none;">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label>No Telepon</label>
                            <input type="text" name="no_telepon" class="form-control" value="<?= set_value('no_telepon') ?>">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label>NIK</label>
                            <input type="text" name="nik" class="form-control" value="<?= set_value('nik') ?>">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control"><?= set_value('alamat') ?></textarea>
                </div>
            </div>

            <script>
                document.getElementById('roleSelect').addEventListener('change', function() {
                    if (this.value === 'customer') {
                        document.getElementById('customerFields').style.display = 'block';
                    } else {
                        document.getElementById('customerFields').style.display = 'none';
                    }
                });
            </script>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>