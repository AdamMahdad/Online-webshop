<?php

require_once('./php/login.php');
require_once('./php/signup.php');

if (!isset($_SESSION['loggedIn']) && isset($_COOKIE['remember_me'])) {
  try {
    $stmt = $pdo->prepare('SELECT * FROM users WHERE remember_token = :token');
    $stmt->execute(['token' => $_COOKIE['remember_me']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
      $_SESSION['email'] = $user['email'];
      $_SESSION['first_name'] = $user['first_name'];
      $_SESSION['last_name'] = $user['last_name'];
      $_SESSION['loggedIn'] = true;
    }
  } catch (PDOException $e) {
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Bookstore</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="./styling/home.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=shopping_bag" />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
</head>

<body class="text-white">
  <div class="h-screen w-full page-1 page-fade flex flex-col relative">
    <!-- Navbar -->
    <nav class="w-full flex justify-center items-center">


      <div class="navs flex justify-around items-center py-4 w-1/2 bg-black/[0.4] shadow-lg rounded-full mt-3">
        <ul class="flex items-center">
          <li>Arravel</li>
        </ul>
        <ul class="flex gap-4 items-center">
          <li><a href="" class="text-white">Home</a></li>
          <li><a href="" class="text-white">About</a></li>
          <li><a href="" class="text-white">Contact</a></li>
          <li><a href="" class="text-white">Pricing</a></li>
        </ul>
        <ul class="flex items-center relative">
          <li class="relative">
            <?php
            if (isset($_SESSION['first_name'])) {
              $user = $_SESSION['first_name'];
              echo '
              <div class="dropdown">
                  <button id="dropdownButton" class="text-white bg-transparent focus:outline-none">
                      ' . htmlspecialchars($user) . '
                  </button>
                  <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white text-black rounded shadow-lg">
                      <a href="logout.php" class="block px-4 py-2 hover:bg-gray-100">Logout</a>
                  </div>
              </div>';
            } else {
              echo '<a href="login.php" class="text-white">Sign in</a>';
            }
            ?>
          </li>
        </ul>
      </div>


      <div class="flex items-center mt-4 py-4 absolute right-24">
        <a href="#">
          <span class="material-symbols-outlined">
            shopping_bag
          </span>
        </a>
      </div>


    </nav>





    <!-- searchbar -->
    <div class="flex items-center justify-center w-full mt-8">
      <Form method="get" class="w-full flex items-center justify-center">
        <input type="search" name="search" id="search" placeholder="Zoek naar een product"
          class="spectacledcoder-search-bar-input sear py-3 px-7 rounded-full w-1/2 focus:outline-black focus:border-none focus:appearance-none"">
            </Form> 
        </div> 

        <!-- Main Content -->
        <div class=" section-hero flex items-center justify-center h-full">
        <div class="window-outline h-[89%] w-11/12">
          <div class="window-main h-full">
            <div class="window-bar">
            </div>
            <div class="window-content">
              <div class="hero-text-content">
                <div class="text-hero">
                <span class="text-hero-serif"></span>
                </div>
                <div class="hero-about-grid">
                  <div class="hero-about-null"></div>
                  <div>
                    <div class="text-hero-about">
                      
                    </div>
                  </div>
                </div>
              </div>
              <div class="window-grain"></div>
            </div>
          </div>
        </div>
    </div>
  </div>


  <div class="page-2 h-screen w-screen flex flex-col items-center">
    <div>
      <h1 class="text-5xl">Best sellers</h1>
    </div>
    <div class="wrapper flex justify-center items-center mt-10">
      <div id="cards">
        <div class="card">
          <div class="card-content">
            <div class="card-image">
              <i class="fa-duotone fa-apartment"></i>
            </div>
            <div class="card-info-wrapper">
              <div class="card-info">
                <i class="fa-duotone fa-apartment"></i>
                <div class="card-info-title">
                  <h3>Apartments</h3>
                  <h4>Places to be apart. Wait, what?</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-content">
            <div class="card-image">
              <img src="https://plus.unsplash.com/premium_photo-1705004597770-40e4db5df8a6?q=80&w=2095&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="">
            </div>
            <div class="card-info-wrapper">
              <div class="card-info">
                <div class="card-info-title">
                  <h3>Unicorns</h3>
                  <h4>A single corn. Er, I mean horn.</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-content">
            <div class="card-image">
              <i class="fa-duotone fa-blender-phone"></i>
            </div>
            <div class="card-info-wrapper">
              <div class="card-info">
                <i class="fa-duotone fa-blender-phone"></i>
                <div class="card-info-title">
                  <h3>Blender Phones</h3>
                  <h4>These absolutely deserve to exist.</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-content">
            <div class="card-image">
              <i class="fa-duotone fa-person-to-portal"></i>
            </div>
            <div class="card-info-wrapper">
              <div class="card-info">
                <i class="fa-duotone fa-person-to-portal"></i>
                <div class="card-info-title">
                  <h3>Adios</h3>
                  <h4>See you...</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-content">
            <div class="card-image">
              <i class="fa-duotone fa-person-from-portal"></i>
            </div>
            <div class="card-info-wrapper">
              <div class="card-info">
                <i class="fa-duotone fa-person-from-portal"></i>
                <div class="card-info-title">
                  <h3>I mean hello</h3>
                  <h4>...over here.</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-content">
            <div class="card-image">
              <i class="fa-duotone fa-otter"></i>
            </div>
            <div class="card-info-wrapper">
              <div class="card-info">
                <i class="fa-duotone fa-otter"></i>
                <div class="card-info-title">
                  <h3>Otters</h3>
                  <h4>Look at me, imma cute lil fella.</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
  </div>


  <div class="h-screen"></div>





  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

  <script src="./javascript/script.js"></script>
</body>

</html>h