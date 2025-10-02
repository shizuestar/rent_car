<div class="card">
    <div class="card-header">
        <h5>Edit Car</h5>
    </div>
    <div class="card-body">
        <form action="<?= site_url('admin/cars/update/' . $car->id) ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <!-- Name -->
                <div class="col-12 mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="<?= $car->name ?>">
                </div>

                <!-- Type & Category -->
                <div class="col-md-6 col-12 mb-3">
                    <label>Type</label>
                    <input type="text" name="type" class="form-control" value="<?= $car->type ?>">
                </div>
                <div class="col-md-6 col-12 mb-3">
                    <label>Category</label>
                    <select name="category_id" class="form-control">
                        <option value="">-- Select --</option>
                        <?php foreach ($categories as $c): ?>
                            <option value="<?= $c->id ?>" <?= $car->category_id == $c->id ? 'selected' : '' ?>>
                                <?= $c->name ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- No Plat & Year -->
                <div class="col-md-6 col-12 mb-3">
                    <label>No Plat</label>
                    <input type="text" name="no_plat" class="form-control" value="<?= $car->no_plat ?>">
                </div>
                <div class="col-md-6 col-12 mb-3">
                    <label>Year</label>
                    <input type="date" name="year" class="form-control" value="<?= $car->year ?>">
                </div>

                <!-- Rent Price & Image -->
                <div class="col-md-6 col-12 mb-3">
                    <label>Rent Price</label>
                    <input type="number" name="rent_price" class="form-control" value="<?= $car->rent_price ?>">
                </div>
                <div class="col-md-6 col-12 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="available" <?= $car->status == 'available' ? 'selected' : '' ?>>Available</option>
                        <option value="rented" <?= $car->status == 'rented' ? 'selected' : '' ?>>Rented</option>
                    </select>
                </div>

                <!-- Description -->
                <div class="col-12 mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control"><?= $car->description ?></textarea>
                </div>

                <!-- Status -->
                <div class="col-12 mb-3">
                    <label>Image</label><br>
                    <?php if ($car->image): ?>
                        <img src="<?= base_url($car->image) ?>" width="100" class="mb-2 d-block">
                    <?php endif; ?>
                    <input type="file" name="image" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= site_url('admin/cars') ?>" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>