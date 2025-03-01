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
  <link rel="icon" type="image/x-icon" href="https://png.pngtree.com/element_our/20190530/ourmid/pngtree-correct-icon-image_1267804.jpg">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=shopping_bag" />
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styling/css.css">
</head>

<body class="text-white">
  <div class="h-screen w-full page-1 page-fade flex flex-col relative">
    <!-- Particles container for unique background effect -->
    <div class="particles-container" id="particles-container"></div>
    
    <!-- Interactive gradient that follows mouse -->
    <div class="interactive-gradient" id="interactive-gradient"></div>
    
    <!-- Improved Navbar -->
    <nav class="navbar glass flex justify-between items-center px-8">
      <!-- Logo -->
      <div class="text-xl font-medium">Arravel</div>
      
      <!-- Navigation Links -->
      <div class="hidden md:flex space-x-8">
        <a href="#" class="nav-link">Home</a>
        <a href="#" class="nav-link">Books</a>
        <a href="#" class="nav-link">About</a>
        <a href="#" class="nav-link">Contact</a>
      </div>
      
      <!-- User & Cart -->
<!-- User & Cart -->
<div class="flex items-center space-x-6">
  <div class="dropdown">
    <button id="dropdownButton" class="flex items-center space-x-2">
      <?php if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']): ?>
        <span><?php echo htmlspecialchars($_SESSION['first_name']); ?></span>
      <?php else: ?>
        <span>Account</span>
      <?php endif; ?>
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
      </svg>
    </button>
    <div id="dropdownMenu" class="dropdown-menu glass px-4 py-3 min-w-[150px]">
      <?php if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']): ?>
        <a href="profile.php" class="block py-2 text-white hover:text-gray-300">Profile</a>
        <a href="settings.php" class="block py-2 text-white hover:text-gray-300">Settings</a>
        <a href="logout.php" class="block py-2 text-white hover:text-gray-300">Logout</a>
      <?php else: ?>
        <a href="login.php" class="block py-2 text-white hover:text-gray-300">Sign In</a>
        <a href="register.php" class="block py-2 text-white hover:text-gray-300">Register</a>
      <?php endif; ?>
    </div>
  </div>
  
  <a href="#" class="flex items-center">
    <span class="material-symbols-outlined">shopping_bag</span>
    <span class="ml-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
  </a>
  
  <!-- Mobile menu button -->
  <button class="md:hidden">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
  </button>
</div>
    </nav>

    <!-- Improved search bar -->
    <div class="flex items-center justify-center w-full mt-32 relative z-10">
      <form method="get" class="w-full flex items-center justify-center">
        <input type="search" name="search" id="search" placeholder="Search for books, authors, genres..."
          class="search-bar py-4 px-6 rounded-full focus:outline-none text-white">
      </form>
    </div>

    <!-- Main content window -->
    <div class="flex items-center justify-center flex-grow px-6 pb-10 relative z-10">
      <div class="window-outline w-full max-w-5xl h-[65vh]">
        <div class="window-main h-full p-8 flex flex-col justify-center items-center">
          <h1 class="text-5xl md:text-6xl font-semibold text-center mb-6">Discover Your Next Favorite Book</h1>
          <p class="text-lg text-center text-gray-300 max-w-2xl mb-10">
            Explore our curated collection of bestsellers, new releases, and timeless classics.
            Find the perfect story to get lost in.
          </p>
          <button class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-full font-medium transition-all duration-300 transform hover:scale-105">
            Explore Now
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Rest of the content remains unchanged -->
  <!-- Bestsellers section with improved cards -->
  <div class="page-2 min-h-screen w-full flex flex-col items-center py-20">
    <h1 class="text-4xl md:text-5xl mb-16">Best Sellers</h1>
    
    <div class="relative w-full max-w-6xl px-6">
      <!-- Cards with parallax effect -->
      <div id="cards-container" class="cards-container">
        <!-- Card 1 -->
        <div class="card">
          <div class="price-tag">$19.99</div>
          <div class="card-image">
            <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?q=80&w=2787&auto=format&fit=crop" alt="Book cover">
          </div>
          <div class="card-content">
            <h3 class="card-title">The Silent Echo</h3>
            <p class="card-description">A thrilling mystery that will keep you guessing until the very last page.</p>
          </div>
        </div>
        
        <!-- Card 2 -->
        <div class="card">
          <div class="price-tag">$24.99</div>
          <div class="card-image">
            <img src="https://images.unsplash.com/photo-1587876931567-564ce588bfbd?q=80&w=2787&auto=format&fit=crop" alt="Book cover">
          </div>
          <div class="card-content">
            <h3 class="card-title">Midnight Gardens</h3>
            <p class="card-description">A magical journey through enchanted worlds where anything is possible.</p>
          </div>
        </div>
        
        <!-- Card 3 -->
        <div class="card">
          <div class="price-tag">$21.99</div>
          <div class="card-image">
            <img src="https://images.unsplash.com/photo-1531169509526-f8f1fdaa4a67?q=80&w=2787&auto=format&fit=crop" alt="Book cover">
          </div>
          <div class="card-content">
            <h3 class="card-title">Beyond the Horizon</h3>
            <p class="card-description">An epic adventure across uncharted territories and distant galaxies.</p>
          </div>
        </div>
        
        <!-- Card 4 -->
        <div class="card">
          <div class="price-tag">$18.99</div>
          <div class="card-image">
            <img src="https://images.unsplash.com/photo-1589998059171-988d887df646?q=80&w=2952&auto=format&fit=crop" alt="Book cover">
          </div>
          <div class="card-content">
            <h3 class="card-title">The Last Memory</h3>
            <p class="card-description">A heartfelt story about love, loss, and the power of remembrance.</p>
          </div>
        </div>
        
        <!-- Card 5 -->
        <div class="card">
          <div class="price-tag">$22.99</div>
          <div class="card-image">
            <img src="https://images.unsplash.com/photo-1621351183012-e2f9972dd9bf?q=80&w=2835&auto=format&fit=crop" alt="Book cover">
          </div>
          <div class="card-content">
            <h3 class="card-title">Whispers in Time</h3>
            <p class="card-description">A tale of intrigue and suspense that spans across generations.</p>
          </div>
        </div>
      </div>
      
      <!-- Navigation arrows -->
      <button id="prev-btn" class="absolute top-1/2 left-2 transform -translate-y-1/2 glass w-10 h-10 rounded-full flex items-center justify-center z-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
      </button>
      
      <button id="next-btn" class="absolute top-1/2 right-2 transform -translate-y-1/2 glass w-10 h-10 rounded-full flex items-center justify-center z-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </button>
    </div>
  </div>

  <script src="javascript/script.js"></script>
</body>
</html>