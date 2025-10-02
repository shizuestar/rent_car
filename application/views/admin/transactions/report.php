<div class="">
    <div class="row">
        <div class="col-12 col-md-10 mx-auto">
            <h4 class="fw-light">Laporan / Transaksi</h4>
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url('admin/report/reportPdf') ?>" method="POST" target="_blank">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Start Date -->
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Tanggal Mulai</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- End Date -->
                                <div class="mb-3">
                                    <label for="end_date" class="form-label">Tanggal Selesai</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                                </div>
                            </div>
                        </div>
                        <!-- Status -->
                        <div class="mb-3">
                            <label for="status" class="form-label">Status Transaksi</label>
                            <select id="status" name="status" class="form-select">
                                <option value="all">Semua</option>
                                <option value="pending">Pending</option>
                                <option value="paid">Paid</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-printer"></i> Generate PDF
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>