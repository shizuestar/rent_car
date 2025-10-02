<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PinjamPais - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 80px 0;
        }

        .car-card {
            transition: transform 0.3s, box-shadow 0.3s;
            height: 100%;
        }

        .car-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .car-image {
            height: 200px;
            object-fit: cover;
        }

        .status-badge {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .price-tag {
            font-size: 1.5rem;
            font-weight: bold;
            color: #667eea;
        }

        .search-box {
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-car"></i> Rental Mobil
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Beranda</a></li>
                    <!-- todo : if user not log in add btn to navigate if already show dashboard navigate -->
                    <?php if ($this->session->userdata('user_id')): ?>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('/dashboard') ?>">Dashboard</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('login') ?>">Logout</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 mb-4">Sewa Mobil Impian Anda</h1>
            <p class="lead mb-4">Pilihan mobil terbaik dengan harga terjangkau</p>
        </div>
    </section>

    <!-- Search Section -->
    <section class="py-4 bg-light">
        <div class="container">
            <div class="search-box">
                <form action="<?= base_url('home/search') ?>" method="get">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Cari mobil..." value="<?= isset($_GET['q']) ? $_GET['q'] : '' ?>">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i> Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Cars Grid -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Mobil Tersedia</h2>
            <div class="row g-4" id="carsGrid">
                <?php if (!empty($cars)): ?>
                    <?php foreach ($cars as $car): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card car-card">
                                <div class="position-relative">
                                    <img src="<?= base_url($car->image) ?>" class="card-img-top car-image" alt="<?= $car->name ?>">
                                    <?php if ($car->status == 'available'): ?>
                                        <span class="badge bg-success status-badge">Tersedia</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger status-badge">Disewa</span>
                                    <?php endif; ?>
                                </div>
                                <div class="card-body">
                                    <span class="badge bg-info mb-2"><?= $car->category_name ?></span>
                                    <h5 class="card-title"><?= $car->name ?></h5>
                                    <p class="card-text text-muted">
                                        <i class="fas fa-car"></i> <?= $car->type ?> |
                                        <i class="fas fa-id-card"></i> <?= $car->no_plat ?> <br>
                                        <i class="fas fa-calendar"></i> <?= !empty($car->year) ? date('Y', strtotime($car->year)) : '' ?>
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="price-tag">
                                            Rp <?= number_format($car->rent_price, 0, ',', '.') ?>/hari
                                        </div>
                                        <a href="<?= base_url('cars/' . $car->id) ?>" class="btn btn-primary">
                                            Detail <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center">
                        <p class="text-muted">Tidak ada mobil ditemukan</p>
                    </div>
                <?php endif; ?>
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
        function searchCars() {
            let input = document.getElementById("searchInput").value.toLowerCase();
            let cards = document.querySelectorAll("#carsGrid .card");

            cards.forEach(card => {
                let text = card.innerText.toLowerCase();
                if (text.includes(input)) {
                    card.parentElement.style.display = "block";
                } else {
                    card.parentElement.style.display = "none";
                }
            });
        }
    </script>
</body>

</html>