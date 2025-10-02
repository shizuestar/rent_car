<div class="container mt-4">
	<h3><?= $title ?></h3>
	<div class="card">
		<div class="card-body">
			<form action="<?= site_url('admin/categories/update/'.$category->id) ?>" method="post">
				<div class="mb-3">
					<label class="form-label">Category Name</label>
					<input type="text" name="name" value="<?= $category->name ?>" class="form-control" required>
				</div>
				<div class="mb-3">
					<label class="form-label">Description</label>
					<textarea name="description" class="form-control"><?= $category->description ?></textarea>
				</div>
				<button type="submit" class="btn btn-success">Update</button>
				<a href="<?= site_url('admin/categories') ?>" class="btn btn-secondary">Cancel</a>
			</form>
		</div>
	</div>
</div>
