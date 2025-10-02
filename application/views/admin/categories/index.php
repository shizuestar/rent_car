<div class="container mt-4">
	<h3><?= $title ?></h3>
	<a href="<?= site_url('admin/categories/create') ?>" class="btn btn-primary mb-3">Add Category</a>

	<div class="card">
		<div class="table-responsive">
			<table class="table table-striped mb-0">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Description</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach($categories as $cat): ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $cat->name ?></td>
						<td><?= $cat->description ?></td>
						<td>
							<a href="<?= site_url('admin/categories/edit/'.$cat->id) ?>"
								class="btn btn-sm btn-warning">Edit</a>
							<a href="<?= site_url('admin/categories/delete/'.$cat->id) ?>"
								onclick="return confirm('Delete this category?')"
								class="btn btn-sm btn-danger">Delete</a>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
