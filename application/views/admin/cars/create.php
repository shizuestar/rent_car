<div class="card">
    <div class="card-header">
        <h5>Add New Car</h5>
    </div>
    <div class="card-body">
        <form action="<?= site_url('admin/cars/store') ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <!-- Name -->
                <div class="col-12 mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control">
                </div>

                <!-- Type & Category -->
                <div class="col-md-6 col-12 mb-3">
                    <label>Type</label>
                    <input type="text" name="type" class="form-control">
                </div>
                <div class="col-md-6 col-12 mb-3">
                    <label>Category</label>
                    <select name="category_id" class="form-control">
                        <option value="">-- Select --</option>
                        <?php foreach ($categories as $c): ?>
                            <option value="<?= $c->id ?>"><?= $c->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- No Plat & Year -->
                <div class="col-md-6 col-12 mb-3">
                    <label>No Plat</label>
                    <input type="text" name="no_plat" class="form-control">
                </div>
                <div class="col-md-6 col-12 mb-3">
                    <label>Year</label>
                    <input type="date" name="year" class="form-control">
                </div>

                <!-- Rent Price & Image -->
                <div class="col-md-6 col-12 mb-3">
                    <label>Rent Price</label>
                    <input type="number" name="rent_price" class="form-control">
                </div>
                <div class="col-md-6 col-12 mb-3">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <!-- Description -->
                <div class="col-12 mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
            <a href="<?= site_url('admin/cars') ?>" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>