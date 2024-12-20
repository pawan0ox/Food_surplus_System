<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surplus Food Management</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Surplus Food</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="Admin/admin_login.php">Admin Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Donor/donor_register.php">Donor Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Donor/donor_login.php">Donor Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="bg-light py-5 text-center">
    <div class="container">
        <h1 class="display-4">Welcome to the Surplus Food Management System</h1>
        <p class="lead">Donate surplus food and help those in need.</p>
        <div>
            <a href="Donor/donor_register.php" class="btn btn-primary btn-lg me-2">Register as Donor</a>
            <a href="Donor/donor_login.php" class="btn btn-secondary btn-lg">Donor Login</a>
        </div>
    </div>
</section>

<!-- Carousel Section -->
<div id="donorCarousel" class="carousel slide mt-4" data-bs-ride="carousel">
    <div class="carousel-inner">
        <!-- Slide 1 -->
        <div class="carousel-item active">
            <img src="img/donor1.jpg" class="d-block mx-auto img-fluid carousel-image" alt="Donor 1">
            <div class="carousel-caption d-none d-md-block">
                <h5>Generous Donor 1</h5>
                <p>"Helping the community with every meal."</p>
            </div>
        </div>
        <!-- Slide 2 -->
        <div class="carousel-item">
            <img src="img/donor2.jpg" class="d-block mx-auto img-fluid carousel-image" alt="Donor 2">
            <div class="carousel-caption d-none d-md-block">
                <h5>Generous Donor 2</h5>
                <p>"Making a difference with every donation."</p>
            </div>
        </div>
        <!-- Slide 3 -->
        <div class="carousel-item">
            <img src="img/donor3.jpg" class="d-block mx-auto img-fluid carousel-image" alt="Donor 3">
            <div class="carousel-caption d-none d-md-block">
                <h5>Generous Donor 3</h5>
                <p>"Together, we can feed the world."</p>
            </div>
        </div>
    </div>

    <!-- Carousel Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#donorCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#donorCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- Custom CSS -->
<style>

    .carousel-image {
        width: 25%;
        margin-left: auto;
        margin-right: auto;
    }

    /* Style for carousel captions */
    .carousel-caption {
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        padding: 10px;
        border-radius: 5px;
    }

    .carousel-item img {
        width: 25%;
        height: auto;
    }
</style>


<!-- Footer -->
<footer class="bg-dark text-white text-center py-3 mt-5">
    <p>Helping Community with proper surplus food management</p>
</footer>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
