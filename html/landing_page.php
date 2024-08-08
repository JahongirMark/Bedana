<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chicken Farm Landing Page</title>

    <!--Bootstrap CSS-->
    <link rel="shortcut icon" href="/img/chicken-icon.jpg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!--My CSS-->
    <link rel="stylesheet" href="../css/landing_page.css">  
</head>
  <body>
    <!--Navbar section-->
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
            <div class="farm-name-overlay  d-flex justify-content-center align-items-center">
                <a class="navbar-brand" href="#">
                    <h1>Bedana</h1>
                </a>
            </div>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto me-5">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
              <a class="nav-link" href="#about-section">About</a>
              <a class="nav-link" href="#products-section">Products</a>
              <!-- <a class="nav-link" href="#contact-section">Contact</a> -->
            </div>
            <a href="../html/registration_page.php" class="btn btn-outline-secondary shadow-sm d-sm d-block">Sign Up</a>
          </div>
        </div>
      </nav>
    <!--Hero section-->
    <section class="hero">
        <div class="container">
            <div class="row">
                <!--text-->
                <div class="col-md-6">
                    <div class="text">
                        Welcome to <span style="color: green;">Our Chicken Farm!</span>
                        Fresh, organic eggs and poultry straight from our farm to your table.<br><br>
                        Explore our wide range of farm-fresh eggs and free-range chickens.<br><br>
                        <span style="color: green;">Sign up now</span> for the freshest updates!
                    </div>
                    <div class="buttons">
                        <a href="../html/registration_page.php" class="btn btn-primary">Join Us Right Now</a>
                    </div>
                </div>
                <!--image-->
                <div class="col-md-6">
                    <img src="/img/_3840eaf2-936f-4a11-87f1-6b3e7aaf2b53.jpeg" alt="About Chicken Farm Image" class="w-100" style="border-radius: 100px;">
                </div>
            </div>
        </div>
    </section>
    <div class="container" id="about-section"> 
        <section class="image-info-section d-flex justify-content-center">
            <div class="row">
                <div class="col-md-6">
                  <div class="image-container d-flex justify-content-center">
                    <img src="/img/Animal-survival-hero-image-1.png" alt="Section Image">
                  </div>
                </div>
                <div class="col-md-6">
                    <div class="info-container">
                     <h2>About Our Chicken Farm</h2>
                     <p>Our chicken farm is dedicated to providing the highest quality eggs and poultry, raised with care and attention to sustainability. We believe in farming practices that respect the environment and deliver nutritious, delicious food to our community.</p>
                    </div>
                </div>
            </div>
        </section>
    </div> 
    <!--Products section-->
    <section class="products" id="products-section">
        <div class="container">
            <div class="text-header text-center">
                <h2>Our Products</h2>
                <p>Browse through our selection of fresh eggs and poultry.</p>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="product">
                        <img src="../img/eggs.png" alt="Product Eggs" class="w-100">
                        <h5 class="mb-3">Fresh Eggs</h5>
                        <p>Fresh Eggs are versatile, high-protein eggs commonly used in a variety of dishes, offering a rich source of essential nutrients and a fresh, natural taste. you can easily get daily, fresh and nutritious eggs</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="product">
                        <img src="../img/chicken.jpg" alt="Product Chicken" class="w-100">
                        <h5 class="mb-3">Free-Range Chickens</h5>
                        <p>Free-Range Chickens are ethically raised poultry with access to outdoor environments, providing tender meat with a natural flavor and higher welfare standards.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="product">
                        <img src="../img/quail eggs.png" alt="Product Feed" class="w-100">
                        <h5 class="mb-3">Fresh Quail Eggs</h5>
                        <p>Fresh Quail Eggs are small, nutrient-rich eggs known for their delicate flavor and speckled shells, often used in gourmet dishes and valued for their high protein content and essential vitamins.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Contact section-->
    <!-- <section class="contact" id="contact-section">
        <div class="container">
            <div class="text-header text-center">
                <h2>Contact Us</h2>
                <p>We would love to hear from you. Get in touch with us today!</p>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="contact-form">
                        <form action="submit_form.php" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-info">
                        <h5>Visit Us</h5>
                        <p>123 Chicken Lane, Countryside, USA</p>
                        <h5>Call Us</h5>
                        <p>(123) 456-7890</p>
                        <h5>Email Us</h5>
                        <p>info@chickenfarm.com</p>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!--Footer section-->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    &copy; 2024 Bedana. All rights reserved.
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="/JAVASCRIPT/chicken_farm_landing_page.js"></script>
  </body>
</html>
