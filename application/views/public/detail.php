<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $car->name ?> - Detail Mobil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        body {
            background: #f5f7fa;
        }

        .navbar {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .car-detail-image {
            width: 100%;
            height: 450px;
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            transition: transform 0.3s ease;
        }

        .car-detail-image:hover {
            transform: scale(1.02);
        }

        .info-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            border: 1px solid #e8ecef;
        }

        .info-card h4 {
            color: #2d3748;
            font-weight: 600;
            margin-bottom: 25px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-row i {
            margin-right: 10px;
            color: #667eea;
        }

        .price-box {
            background: var(--primary-gradient);
            color: white;
            border-radius: 15px;
            padding: 35px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
            top: 20px;
            margin-bottom: 40px;
        }

        .price-amount {
            font-size: 2.8rem;
            font-weight: bold;
            margin: 15px 0;
        }

        .price-box h5 {
            font-weight: 500;
            opacity: 0.95;
        }

        .status-available {
            color: #28a745;
            font-weight: 600;
            background: #d4edda;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .status-rented {
            color: #dc3545;
            font-weight: 600;
            background: #f8d7da;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .car-title-section {
            background: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .car-title-section h1 {
            color: #2d3748;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .car-title-section .badge {
            font-size: 0.9rem;
            padding: 8px 15px;
            font-weight: 500;
        }

        .floating-action-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
            box-shadow: 0 8px 25px rgba(0,0,0,0.25);
            border-radius: 50px;
            padding: 15px 30px;
            font-size: 1.1rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .floating-action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(0,0,0,0.3);
        }

        .floating-action-btn i {
            margin-right: 8px;
        }

        .breadcrumb {
            background: white;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        @media (max-width: 768px) {
            .car-detail-image {
                height: 300px;
            }

            .floating-action-btn {
                width: calc(100% - 40px);
                left: 20px;
                right: 20px;
                text-align: center;
            }

            .price-amount {
                font-size: 2rem;
            }

            .feature-highlight {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <i class="fas fa-car"></i> Rental Mobil
            </a>
        </div>
    </nav>

    <section class="py-5">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="fas fa-home"></i> Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Mobil</li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-lg-8">
                    <img src="<?= base_url($car->image) ?>" alt="<?= $car->name ?>" class="car-detail-image mb-4">

                    <div class="car-title-section">
                        <span class="badge bg-info mb-3"><?= $car->category_name ?></span>
                        <h1><?= $car->name ?></h1>
                        <p class="lead text-muted mb-0"><?= $car->description ?></p>
                    </div>

                    <div class="info-card">
                        <h4><i class="fas fa-info-circle"></i> Spesifikasi Kendaraan</h4>
                        <div class="info-row">
                            <div><i class="fas fa-car"></i> Tipe Kendaraan</div>
                            <div><strong><?= $car->type ?></strong></div>
                        </div>
                        <div class="info-row">
                            <div><i class="fas fa-id-card"></i> Nomor Plat</div>
                            <div><strong><?= $car->no_plat ?></strong></div>
                        </div>
                        <div class="info-row">
                            <div><i class="fas fa-calendar"></i> Tahun</div>
                            <div><strong><?= !empty($car->year) ? date('Y', strtotime($car->year)) : '-' ?></strong></div>
                        </div>
                        <div class="info-row">
                            <div><i class="fas fa-check-circle"></i> Status</div>
                            <div class="<?= $car->status == 'available' ? 'status-available' : 'status-rented' ?>">
                                <i class="fas fa-circle" style="font-size: 0.6rem; margin-right: 5px;"></i>
                                <?= $car->status == 'available' ? 'Tersedia' : 'Sedang Disewa' ?>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4">
                    <div class="price-box">
                        <h5>Harga Sewa</h5>
                        <div class="price-amount">Rp <?= number_format($car->rent_price, 0, ',', '.') ?></div>
                        <p class="mb-0">per hari</p>
                    </div>

                    <div class="info-card">
                        <h5><i class="fas fa-info-circle"></i> Informasi Penting</h5>
                        <ul class="list-unstyled mt-3">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Dokumen lengkap</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Kondisi terawat</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Siap pakai</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Garansi mesin</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Floating Action Button -->
    <?php if ($this->session->userdata('user_id')): ?>
        <?php if ($car->status == 'available'): ?>
            <a href="<?= base_url('cars/booking/' . $car->id) ?>" class="btn btn-primary floating-action-btn">
                <i class="fas fa-calendar-check"></i> Pinjam Sekarang
            </a>
        <?php else: ?>
            <button class="btn btn-secondary floating-action-btn" disabled>
                <i class="fas fa-ban"></i> Tidak Tersedia
            </button>
        <?php endif; ?>
    <?php else: ?>
        <a href="<?= base_url('auth/login') ?>" class="btn btn-warning floating-action-btn">
            <i class="fas fa-sign-in-alt"></i> Login untuk Pinjam
        </a>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>