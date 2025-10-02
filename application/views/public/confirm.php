<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pesanan - Rental Mobil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .confirmation-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 0;
        }

        .car-summary-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .car-image-summary {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .total-section {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }

        .total-price {
            font-size: 2rem;
            font-weight: bold;
            color: #667eea;
        }

        .date-card {
            background: #e7f3ff;
            border-left: 4px solid #0d6efd;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .duration-badge {
            background: #667eea;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 1.1rem;
            font-weight: bold;
        }

        .summary-section {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
        }

        .section-title {
            color: #667eea;
            font-weight: bold;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #667eea;
        }
    </style>
</head>

<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <i class="fas fa-car"></i> Rental Mobil
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <section class="confirmation-header">
        <div class="container text-center">
            <i class="fas fa-check-circle fa-4x mb-3"></i>
            <h1 class="display-5">Konfirmasi Pesanan</h1>
            <p class="lead">Silakan periksa detail pesanan Anda</p>
        </div>
    </section>

    <!-- Confirmation Content -->
    <section class="py-5">
        <div class="container">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="#" onclick="history.back()">Detail Mobil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Konfirmasi</li>
                </ol>
            </nav>

            <div class="row">
                <!-- Left Column: Car & Rental Details -->
                <div class="col-lg-8">
                    <!-- Car Information -->
                    <div class="summary-section">
                        <h4 class="section-title">
                            <i class="fas fa-car"></i> Detail Kendaraan
                        </h4>
                        <div class="row">
                            <div class="col-md-4">
                                <img src="<?= base_url($car->image) ?>" alt="<?= $car->name ?>" class="img-fluid rounded">
                            </div>
                            <div class="col-md-8">
                                <div class="mb-2">
                                    <span class="badge bg-info"><?= $car->category_name ?></span>
                                </div>
                                <h3 class="mb-3"><?= $car->name ?></h3>
                                <div class="info-row"><span><i class="fas fa-car text-primary"></i> Tipe</span> <strong><?= $car->type ?></strong></div>
                                <div class="info-row"><span><i class="fas fa-id-card text-primary"></i> Nomor Plat</span> <strong><?= $car->no_plat ?></strong></div>
                                <div class="info-row"><span><i class="fas fa-calendar text-primary"></i> Tahun</span> <strong><?= !empty($car->year) ? date('Y', strtotime($car->year)) : '' ?></strong></div>
                            </div>
                        </div>
                    </div>

                    <!-- Rental Period -->
                    <div class="summary-section">
                        <h4 class="section-title">
                            <i class="fas fa-calendar-alt"></i> Periode Sewa
                        </h4>
                        <form id="rentalForm" action="<?= base_url('home/store_transaction') ?>" method="post">
                            <input type="hidden" name="car_id" value="<?= $car->id ?>">

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Tanggal Pinjam</label>
                                    <input type="date" id="startDate" name="rent_date" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tanggal Kembali</label>
                                    <input type="date" id="endDate" name="return_date" class="form-control" required>
                                </div>
                            </div>
                        </form>

                        <div class="text-center mt-3" id="durationInfo">
                            <!-- Duration will be shown here -->
                        </div>

                        <div class="alert alert-info mt-3">
                            <i class="fas fa-info-circle"></i>
                            <strong>Catatan:</strong> Pengembalian mobil maksimal pukul 17:00 WIB
                        </div>
                    </div>

                    <!-- Customer Information Form -->
                    <div class="summary-section">
                        <h4 class="section-title">
                            <i class="fas fa-user"></i> Data Penyewa
                        </h4>
                        <form id="customerForm">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Lengkap *</label>
                                    <input type="text" class="form-control"
                                        value="<?= $user->name ?>" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">No. Telepon *</label>
                                    <input type="tel" class="form-control"
                                        value="<?= $user->no_telepon ?>" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email *</label>
                                    <input type="email" class="form-control"
                                        value="<?= $user->email ?>" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">No. KTP *</label>
                                    <input type="text" class="form-control"
                                        value="<?= $user->nik ?>" readonly>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Alamat *</label>
                                    <textarea class="form-control" rows="2" readonly><?= $user->alamat ?></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right Column: Price Summary -->
                <div class="col-lg-4">
                    <div class="summary-section sticky-top" style="top: 20px;">
                        <h4 class="section-title">
                            <i class="fas fa-receipt"></i> Ringkasan Pembayaran
                        </h4>

                        <div id="priceSummary">
                            <!-- Price summary will be loaded here -->
                        </div>

                        <div class="total-section">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Harga per Hari:</span>
                                <span class="fw-bold"><?= "Rp " . number_format($car->rent_price, 0, ',', '.') ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Durasi Sewa:</span>
                                <span class="fw-bold" id="rentalDays">0 hari</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Subtotal:</span>
                                <span class="fw-bold" id="subtotal">Rp 0</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 mb-0">Total Bayar:</span>
                                <span class="total-price" id="totalPrice">Rp 0</span>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button class="btn btn-primary btn-lg" onclick="confirmOrder()">
                                <i class="fas fa-check"></i> Konfirmasi Pesanan
                            </button>
                            <a href="#" onclick="history.back()" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>

                        <div class="alert alert-warning mt-3 small">
                            <i class="fas fa-exclamation-triangle"></i>
                            Dengan melanjutkan, Anda menyetujui syarat dan ketentuan kami.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">&copy; 2024 Rental Mobil. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Data mobil dari PHP -> JS
        const currentCar = {
            id: <?= $car->id ?>,
            name: "<?= $car->name ?>",
            rent_price: <?= $car->rent_price ?>
        };
    </script>

    <script>
        // Format harga ke Rupiah
        function formatRupiah(amount) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(amount);
        }

        // Get car ID from URL
        function getCarIdFromUrl() {
            const urlParams = new URLSearchParams(window.location.search);
            return parseInt(urlParams.get('id'));
        }

        // Calculate days between two dates
        function calculateDays(startDate, endDate) {
            const start = new Date(startDate);
            const end = new Date(endDate);
            const diffTime = Math.abs(end - start);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            return diffDays || 0;
        }

        // Update price calculation
        function updatePriceCalculation() {
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;

            if (!startDate || !endDate || !currentCar) {
                document.getElementById('rentalDays').textContent = '0 hari';
                document.getElementById('subtotal').textContent = 'Rp 0';
                document.getElementById('totalPrice').textContent = 'Rp 0';
                document.getElementById('durationInfo').innerHTML = '';
                return;
            }

            const days = calculateDays(startDate, endDate);

            if (days < 1) {
                alert('Tanggal kembali harus setelah tanggal pinjam');
                document.getElementById('endDate').value = '';
                return;
            }

            const subtotal = currentCar.rent_price * days;
            const total = subtotal;

            document.getElementById('rentalDays').textContent = `${days} hari`;
            document.getElementById('subtotal').textContent = formatRupiah(subtotal);
            document.getElementById('totalPrice').textContent = formatRupiah(total);

            document.getElementById('durationInfo').innerHTML = `
                <span class="duration-badge">
                    <i class="fas fa-clock"></i> Durasi Sewa: ${days} Hari
                </span>
            `;
        }

        // Set minimum date to today
        function setMinimumDate() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('startDate').setAttribute('min', today);
            document.getElementById('endDate').setAttribute('min', today);
        }

        // Confirm order
        function confirmOrder() {
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;

            if (!startDate || !endDate) {
                alert('Silakan pilih tanggal pinjam dan tanggal kembali');
                return;
            }

            const days = calculateDays(startDate, endDate);
            if (days < 1) {
                alert('Tanggal kembali harus setelah tanggal pinjam');
                return;
            }

            // ✅ Submit form
            document.getElementById('rentalForm').submit();
        }

        // Event listeners
        document.getElementById('startDate').addEventListener('change', function() {
            const startDate = this.value;
            document.getElementById('endDate').setAttribute('min', startDate);
            updatePriceCalculation();
        });

        document.getElementById('endDate').addEventListener('change', updatePriceCalculation);

        // Initialize
        setMinimumDate();
    </script>
</body>

</html>