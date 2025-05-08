<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tsebo Online Studies</title>

    <!-- Bootstrap & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Animate On Scroll (AOS) -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">

    <style>
        body { font-family: Arial, sans-serif; }

        /* Navbar */
        .navbar { background-color: #007bff !important; }
        .navbar-brand, .nav-link, .dropdown-item { color: white !important; }
        .icon { font-size: 1.5rem; margin-right: 8px; color: white; }

        /* Carousel */
        .carousel-item img { width: 100%; height: 300px; object-fit: cover; }
        .carousel-caption {
            background: rgba(0, 123, 255, 0.5);
            padding: 20px;
            border-radius: 10px;
        }
        .carousel-caption h2, .carousel-caption p { color: white; }

        /* How It Works */
        .how-it-works {
            text-align: center;
            padding-bottom: 40px;
        }
        .step-box {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.1s;
        }
        .step-box:hover { transform: scale(0.05); }
        .step-icon { font-size: 2.5rem; color: #007bff; margin-bottom: 10px; }
b{
    color: #007bff;
}
        /* Footer */
        .footer {
            background: #007bff;
            color: white;
            padding: 15px 0;
            font-size: 0.9rem;
        }
        .footer a { color: white; transition: color 0.3s ease-in-out; }
        .footer a:hover { color: #f8d210; }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#"><i class="fas fa-graduation-cap"></i> Tsebo Online Studies</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-home icon"></i> Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-info-circle icon"></i> About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('fetchAll') }}"><i class="fas fa-chalkboard-teacher icon"></i> Find a Tutor</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <i class="fas fa-user-plus icon"></i> Register
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('student.register.form') }}">Register as Student</a></li>
                        <li><a class="dropdown-item" href="{{ route('instructor.register') }}">Register as Instructor</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <i class="fas fa-sign-in-alt icon"></i> Login
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('student.login') }}">Login as Student</a></li>
                        <li><a class="dropdown-item" href="{{ route('instructor.login') }}">Login as Instructor</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<hr/>

<!-- Carousel -->
<div id="courseCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">

        <div class="carousel-item active">
            <img src="images/slides/slide1.png" class="d-block w-100" alt="Slide 1">
            <div class="carousel-caption">
                <h2>Enhance Your Skills Online</h2>
                <p>Learn at your own pace with expert tutors.</p>
            </div>
        </div>
  <div class="carousel-item active">
            <img src="images/slides/slide2.png" class="d-block w-100" alt="Slide 1">
            <div class="carousel-caption">
                <h2>Enhance Your Skills Online</h2>
                <p>Learn at your own pace with expert tutors.</p>
            </div>
        </div>

        <div class="carousel-item active">
            <img src="images/slides/slide3.png" class="d-block w-100" alt="Slide 1">
            <div class="carousel-caption">
                <h2>Enhance Your Skills Online</h2>
                <p>Learn at your own pace with expert tutors.</p>
            </div>
        </div>

    </div>




</div>

<!-- How It Works -->
<div class="container mt-5 how-it-works">
    <h3 class="text-center mb-4">How It Works</h3>
    <div class="row g-4">
        <div class="col-md-6" data-aos="fade-right">
            <div class="step-box text-center">
                <i class="fas fa-user-plus step-icon"></i>
                <h5> <b>1. </b>Register as Student</h5>
                <p>Create an account to access courses.</p>
            </div>
        </div>
        <div class="col-md-6" data-aos="fade-left">
            <div class="step-box text-center">
                <i class="fas fa-wallet step-icon"></i>
                <h5><b>2. </b>Pay Annual Subscription</h5>
                <p>Unlock full access to all resources.</p>
            </div>
        </div>
        <div class="col-md-6" data-aos="fade-right">
            <div class="step-box text-center">
                <i class="fas fa-calendar-check step-icon"></i>
                <h5><b>3. </b>Book Class with Tutor</h5>
                <p>Schedule lessons at your convenience.</p>
            </div>
        </div>
        <div class="col-md-6" data-aos="fade-left">
            <div class="step-box text-center">
                <i class="fas fa-credit-card step-icon"></i>
                <h5><b>4. </b>Pay for the Session</h5>
                <p>Complete your payment for booked sessions.</p>
            </div>
        </div>
    </div>
</div>

<!-- Find a Tutor Section -->
<div class="container mt-5">
    <h3 class="text-center mb-4">Find a Tutor</h3>
    <p class="text-center">Search and connect with experienced tutors for personalized learning.</p>
    <div class="text-center">
        <a href="#" class="btn btn-primary"><i class="fas fa-search"></i> Search Tutors</a>
    </div>
</div>

<!-- Footer -->
<footer class="footer mt-5">
    <div class="container text-center">
        <p>Metcash Complex, Room 133, Maseru, Lesotho</p>
        <p><a href="https://wa.me/26657428772"><i class="fab fa-whatsapp"></i> +266 57428772</a></p>
        <p>&copy; <script>document.write(new Date().getFullYear());</script> Tsebo Online Studies. All rights reserved.</p>
    </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script> AOS.init(); </script>

</body>
</html>
