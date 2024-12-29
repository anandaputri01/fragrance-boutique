<?php
include "koneksi.php"; 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap Ananda's Fragrance Boutique</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
      body {
        background-color: rgb(189, 209, 249);
        color: black;
      }
      .jumbotron {
        background-color: rgb(189, 209, 249);
      }
      #collection {
        background-color: white;
      }
      #aboutme.dark-mode {
        background-color: #07051f;
      }

      .navbar.light-mode {
        background-color: rgb(189, 209, 249);
      }
      
      /* Dark Mode */
      body.dark-mode {
        background-color: #07051f;
        color: #ffffff;
      }
      .jumbotron.dark-mode {
        background-color: #07051f;
      }
      .navbar.dark-mode {
        background-color: #3d3d3d;
      }
      #collection.dark-mode {
        background-color: #454260;
      }
      .list-group-item{
        background-color: #0c2d4e;
        color: rgb(255, 255, 255);
      }
      
      /* Card and List Styling */
      .card.dark-mode {
        background-color: #07051f;
        color: white;
      }
      .list-group-item.dark-mode {
        background-color: #0c2d4e;
        color: white;
      }
      .carousel-img {
        width: 50%;
        margin: auto;
      }
      /* CSS for equal height cards */
      .card-equal-height {
        display: flex;
        flex-direction: column;
        height: 100%;
      }

      .card-equal-height .card-body {
        flex: 1;
      }
      
      .circle-img {
        width: 400px;
        height: 400px;
        object-fit: cover;
        border-radius: 50%;
      }



       /* Footer Styling */
       .footer {
            background-color: #ffffff;
            color: rgb(0, 0, 0);
            text-align: center;
            padding: 20px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        .social-icons a {
            color: rgb(0, 0, 0);
            margin: 0 10px;
            text-decoration: none;
            font-size: 24px;
        }
        .footer.dark-mode {
          background-color: #000000;
          color: rgb(255, 255, 255);
        }
        .dark-mode .social-icons a {
          color: white;
        }
    </style>
  </head>
  <body>
    <nav class="navbar fixed-top navbar-expand-lg bg-body-tertiary">
      <div class="container">
        <a class="navbar-brand" href="#">Ananda's Fragrance Boutique</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#collection">Collection</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#gallery">Gallery</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#Schedule">Schedule</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#aboutme">About Me</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php" target="_blank">Login</a>
            </li>
          </ul>
          <!-- Theme Switcher Buttons -->
          <div class="d-flex">
            <button id="darkModeBtn" class="btn btn-dark me-2">🌙</button>
            <button id="lightModeBtn" class="btn btn-light">☀️</button>
          </div>
        </div>
      </div>
    </nav>

    <div class="jumbotron d-flex align-items-center">
      <div class="container">
        <div class="row w-100 mt-5" style="height: 95vh">
          <div class="col-md-6 d-flex flex-column justify-content-center">
            <h1 class="fw-bold fs-1">
              Elevate Every Moment with a Captivating Scent
            </h1>
            <h3>
              Hadirkan pesona dengan parfum yang tak hanya harum, tetapi juga berkualitas tinggi.
            </h3>
            <!-- Container for date and time -->
            <div id="dateTime" class="mt-3"></div>
          </div>

          <div class="col-md-6 d-flex align-items-center">
            <img
              class="img-fluid"
              src="https://images.unsplash.com/photo-1595425959632-34f2822322ce?q=80&w=1998&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
            />
          </div>
        </div>
      </div>
    </div>


    <!-- article begin -->
<section id="collection" class="text-center p-5">
  <div class="container">
    <h1 class="fw-bold display-6 pb-3">Collection</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
      <?php
      $sql = "SELECT * FROM article ORDER BY tanggal DESC";
      $hasil = $conn->query($sql); 

      $no = 1;
      while($row = $hasil->fetch_assoc()){
        ?>
        <div class="col">
          <div class="card h-100">
            <img src="<?= $row["gambar"]?>" class="card-img-top" alt="..." />
            <div class="card-body">
              <h5 class="card-title"><?= $row["judul"]?></h5>
              <p class="card-text">
                <?= $row["isi"]?>
              </p>
            </div>
            <div class="card-footer">
              <small class="text-body-secondary">
                <?= $row["tanggal"]?>
              </small>
            </div>
          </div>
        </div>
        <?php
      }
      ?> 
    </div>
  </div>
</section>
<!-- article end -->


    <div class="container-fluid" id="gallery" style="height: 100vh">
      <h1 class="text-center" style="padding-top: 70px">Gallery</h1>
      <div id="carouselExample" class="carousel slide mt-5">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img
              src="https://images.unsplash.com/photo-1593087130576-389402bc050a?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
              class="d-block carousel-img"
              alt="..."
            />
          </div>
          <div class="carousel-item">
            <img
              src="https://images.unsplash.com/photo-1592842312669-1c6a0dc6dc21?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
              class="d-block carousel-img"
              alt=""
            />
          </div>
          <div class="carousel-item">
            <img
              src="https://images.unsplash.com/photo-1514348871858-1d3c20902571?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
              class="d-block carousel-img"
              alt="..."
            />
          </div>
          <div class="carousel-item">
            <img
              src="https://images.unsplash.com/photo-1588680388395-95f3f5c524a8?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
              class="d-block carousel-img"
              alt="..."
            />
          </div>
          <div class="carousel-item">
            <img
              src="https://images.unsplash.com/photo-1588680137822-3a1f1d585efc?q=80&w=1795&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
              class="d-block carousel-img"
              alt="..."
            />
          </div>
          <div class="carousel-item">
            <img
              src="https://images.unsplash.com/photo-1588680387706-913dc9c51036?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
              class="d-block carousel-img"
              alt="..."
            />
          </div>
          <div class="carousel-item">
            <img
              src="https://images.unsplash.com/photo-1595002132744-d718a5f959d7?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
              class="d-block carousel-img"
              alt="..."
            />
          </div>
        </div>
        <button
          class="carousel-control-prev"
          type="button"
          data-bs-target="#carouselExample"
          data-bs-slide="prev"
        >
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button
          class="carousel-control-next"
          type="button"
          data-bs-target="#carouselExample"
          data-bs-slide="next"
        >
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>

    <div class="container mt-4" id="Schedule">
  <h2 class="text-center fw-bold">Schedule</h2>
  <div class="row">
      <!-- Senin -->
      <div class="col-md-4 mb-4">
          <div class="card text-center card-equal-height">
              <div class="card-header bg-danger text-white fw-bold">Senin</div>
              <div class="card-body">
                  <p>Sistem Operasi<br>12.30-15.00 | H4.4</p>
              </div>
          </div>
      </div>
      <!-- Selasa -->
      <div class="col-md-4 mb-4">
          <div class="card text-center card-equal-height">
              <div class="card-header bg-danger text-white fw-bold">Selasa</div>
              <div class="card-body">
                  <p>Pemograman Berbasis Web<br>10.20-12.00 | D2.J</p>
                  <hr>
                  <p>Basis Data<br>14.10-15.30 | D3.M</p>
                  <hr>
                  <p>Pendidikan Pancasila<br>18:30-20:00 | E3.Aula</p>
              </div>
          </div>
      </div>
      <!-- Rabu -->
      <div class="col-md-4 mb-4">
          <div class="card text-center card-equal-height">
              <div class="card-header bg-danger text-white fw-bold">Rabu</div>
              <div class="card-body">
                  <p>Logika Informatika<br>09.30-12.00 | H4.8</p>
              </div>
          </div>
      </div>
  </div>
  <div class="row">
      <!-- Kamis -->
      <div class="col-md-4 mb-4">
          <div class="card text-center card-equal-height">
              <div class="card-header bg-danger text-white fw-bold">Kamis</div>
              <div class="card-body">
                  <p>Probabilitas dan Statistika<br>09.30-12.00 | H4.2</p>
                  <hr>
                  <p>Basis Data<br>12.30-14.10 | H5.8</p>
              </div>
          </div>
      </div>
      <!-- Jumat -->
      <div class="col-md-4 mb-4">
          <div class="card text-center card-equal-height">
              <div class="card-header bg-danger text-white fw-bold">Jumat</div>
              <div class="card-body">
                  <p>Rekayasa Perangkat Lunak<br>09.30-12.00 | H4.2</p>
                  <hr>
                  <p>Sistem Informasi<br>15.30-18.00 | H3.2</p>
              </div>
          </div>
      </div>
      <!-- Sabtu -->
      <div class="col-md-4 mb-4">
          <div class="card text-center card-equal-height">
              <div class="card-header bg-danger text-white fw-bold">Sabtu</div>
              <div class="card-body">
                  <p>FREE</p>
              </div>
          </div>
      </div>
  </div>
</div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <div class="jumbotron d-flex align-items-center" id="aboutme">
    <div class="container">
      <div class="row w-100 mt-5" style="height: 95vh">
        <div class="col-md-6 d-flex align-items-center justify-content-center">
          <img
            class="img-fluid circle-img"
            src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=1964&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
            alt="Profile Picture"
          />
        </div>
        <div class="col-md-6 d-flex flex-column justify-content-center text-center text-md-start">
          <p>A11.2023.14947</p>
          <h1 class="fw-bold fs-1">
              ANANDA PUTRI
          </h1>
          <p>Program Studi Teknik Informatika</p>
          <p><strong><a href="https://dinus.ac.id/" style="color: black; text-decoration: none;">Universitas Dian Nuswantoro</a></strong></p>
      </div>
      </div>
      </div>
    </div>
  </div>
</div>

  
    <!-- Footer Section -->
    <div class="footer">
      <div class="social-icons">
        <a href="https://instagram.com/anandaaaassss/" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="https://wa.me/088232653256" target="_blank"><i class="fab fa-whatsapp"></i></a>
      </div>
      <div class="footer-text">
        Ananda's Fragrance Boutique © 2024
      </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
      // Function to update date and time
      function updateDateTime() {
        const now = new Date();
        const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true };
        document.getElementById('dateTime').innerText = now.toLocaleString('id-ID', options);
      }

      // Call updateDateTime initially and then every second
      updateDateTime();
      setInterval(updateDateTime, 1000);

      // Toggle Dark and Light Mode
      // Function to toggle between light and dark mode
  // Function to toggle between light and dark mode
const darkModeBtn = document.getElementById('darkModeBtn');
const lightModeBtn = document.getElementById('lightModeBtn');

darkModeBtn.addEventListener('click', () => {
  document.body.classList.add('dark-mode');
  document.body.classList.remove('light-mode');
  document.querySelector('.jumbotron').classList.add('dark-mode');
  document.querySelector('.navbar').classList.add('dark-mode');
  document.getElementById('collection').classList.add('dark-mode');
  document.querySelector('.footer').classList.add('dark-mode');
  document.getElementById('aboutme').classList.add('dark-mode'); // Add this line
  const cards = document.querySelectorAll('.card');
  cards.forEach(card => card.classList.add('dark-mode'));
  const listItems = document.querySelectorAll('.list-group-item');
  listItems.forEach(item => item.classList.add('dark-mode'));
});

lightModeBtn.addEventListener('click', () => {
  document.body.classList.remove('dark-mode');
  document.body.classList.add('light-mode');
  document.querySelector('.jumbotron').classList.remove('dark-mode');
  document.querySelector('.navbar').classList.remove('dark-mode');
  document.querySelector('.footer').classList.remove('dark-mode');
  document.getElementById('collection').classList.remove('dark-mode');
  document.getElementById('aboutme').classList.remove('dark-mode'); // Add this line
  const cards = document.querySelectorAll('.card');
  cards.forEach(card => card.classList.remove('dark-mode'));
  const listItems = document.querySelectorAll('.list-group-item');
  listItems.forEach(item => item.classList.remove('dark-mode'));
});


    </script>
  </body>
</html>