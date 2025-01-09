<?php
session_start();
include "koneksi.php";

if (isset($_SESSION['username'])) { 
	header("location:admin.php"); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['user'];
  $password = md5($_POST['pass']);
  $stmt = $conn->prepare("SELECT username 
                          FROM user 
                          WHERE username=? AND password=?");

  $stmt->bind_param("ss", $username, $password);
  $stmt->execute();
  
  $hasil = $stmt->get_result();
  $row = $hasil->fetch_array(MYSQLI_ASSOC);

  if (!empty($row)) {
    $_SESSION['username'] = $row['username'];
    header("location:admin.php");
  } else {
    header("location:login.php");
  }
  $stmt->close();
  $conn->close();
} else {
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login | Ananda's Fragrance Boutique</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    />
    <link rel="icon" href="img/logo.png" />
  </head>
  <body class="bg-warning-subtle">
  <div class="container mt-5 pt-5">
  <div class="row">
    <div class="col-12 col-sm-8 col-md-6 m-auto">
      <div class="card border-0 shadow rounded-5">
        <div class="card-body">
          <div class="text-center mb-3">
            <i class="bi bi-person-circle h1 display-4"></i>
            <p>Ananda's Fragrance Boutique</p>
            <hr />
          </div>
          <form action="" method="post">
            <input
              type="text"
              name="user"
              class="form-control my-4 py-2 rounded-4"
              placeholder="Username"
            />
            <input
              type="password"
              name="pass"
              class="form-control my-4 py-2 rounded-4"
              placeholder="Password"
            />
            <div class="text-center my-3 d-grid">
              <button class="btn btn-danger rounded-4">Login</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php
  //set variable username dan password dummy
  $username = "admin";
  $password = "123456";

  //check apakah ada request dengan method POST yang dilakukan
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      echo '<div class="row mt-4">';
      echo '<div class="col-12 col-sm-8 col-md-6 m-auto">';
      
      //check apakah username dan password yang di POST sama dengan data dummy
      if($_POST['user'] == $username AND $_POST['pass'] == $password){
          echo "<div class='alert alert-success text-center'>";
          echo "Username dan Password Benar<br>";
      }else{
          echo "<div class='alert alert-warning-subtle text-center'>";
          echo "Username dan Password Salah<br>";
      }

      // Display the input values
      foreach($_POST as $key => $val){
          echo "<strong>" . ucfirst($key) . ":</strong> " . htmlspecialchars($val) . "<br>";
      }

      echo '</div>';
      echo '</div>';
      echo '</div>';
  }
  ?>
</div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
<?php
}
?>
