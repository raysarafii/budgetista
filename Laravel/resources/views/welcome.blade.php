<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: #ffffff;
        }
        .navbar-custom {
            background-color: rgba(255, 255, 255, 0.1);
            transition: background-color 0.3s ease;
        }
        .navbar-custom.scrolled {
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            color: #000;
        }
        .feature-icon {
            color: #00c851;
            margin-right: 10px;
        }
        .card-custom {
            background-color: rgba(255, 255, 255, 0.1);
            border: none;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .btn-custom {
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            opacity: 0.8;
        }
        footer {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px 0;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand text-white fw-bold" href="#">
                <i class="fas fa-users"></i> Team Management
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn btn-outline-light btn-sm mx-2 btn-custom">
                            <i class="fas fa-user-plus"></i> Daftar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-light btn-sm mx-2 btn-custom">
                            <i class="fas fa-sign-in-alt"></i> Masuk
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="container mt-5 pt-5">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <h1 class="fw-bold mb-4">Kelola Tim Anda dengan Mudah</h1>
                <p class="fs-5 mb-4">
                    Solusi manajemen tim berbasis web untuk meningkatkan kolaborasi dan produktivitas.
                </p>
                <div class="mt-4">
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg me-2 btn-custom">
                        <i class="fas fa-user-plus"></i> Daftar
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg btn-custom">
                        <i class="fas fa-sign-in-alt"></i> Masuk
                    </a>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <img src="{{ asset('images/dashboard.png') }}" alt="Team Management" class="img-fluid rounded">
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="features" class="container mt-5">
        <h2 class="text-center mb-4">Fitur Unggulan</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card card-custom text-center p-4">
                    <i class="fas fa-users fa-3x mb-3 text-success"></i>
                    <h5>Manajemen Kelompok</h5>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-custom text-center p-4">
                    <i class="fas fa-tasks fa-3x mb-3 text-info"></i>
                    <h5>Pengelolaan Proyek</h5>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-custom text-center p-4">
                    <i class="fas fa-check-circle fa-3x mb-3 text-primary"></i>
                    <h5>Manajemen Tugas</h5>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-custom text-center p-4">
                    <i class="fas fa-comments fa-3x mb-3 text-warning"></i>
                    <h5>Komentar dan Diskusi</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-5 text-center text-white">
        <div class="container p-4">
            <div class="row">
                <!-- About -->
                <div class="col-md-6 mb-4">
                    <h5>Team Management</h5>
                    <p>
                        Solusi manajemen tim berbasis web untuk mempermudah kolaborasi dan produktivitas Anda. Mudah digunakan dan cocok untuk semua tim.
                    </p>
                </div>
                <!-- Social Media -->
                <div class="col-md-6 mb-4">
                    <h5>Ikuti Kami</h5>
                    <a href="#" class="text-white me-3"><i class="fab fa-facebook fa-lg"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-twitter fa-lg"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-linkedin fa-lg"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
