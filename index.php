<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Bookstore</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./styling/home.css">
</head>

<body class="text-white">
    <div class="h-screen w-full page-1 page-fade">
        <!-- Navbar -->
        <nav class="w-full flex justify-around items-center">
            <div class="navs flex justify-around items-center py-4 w-1/2 bg-black/[0.4] shadow-lg rounded-full mt-3">
                <ul class="flex items-center">
                    <li>ZMML</li>
                </ul>
                <ul class="flex gap-4 items-center">
                    <li><a href="" class="text-white">Home</a></li>
                    <li><a href="" class="text-white">About</a></li>
                    <li><a href="" class="text-white">Contact</a></li>
                    <li><a href="" class="text-white">Pricing</a></li>
                </ul>
                <ul class="flex items-center">
                    <li><a href="signin.php" class="text-white">Sign In</a></li>
                </ul>
            </div>
        </nav>

        <!--searchbar-->
        <div class="flex items-center justify-center w-full mt-8">
            <Form method="get" class="w-full flex items-center justify-center">
                <input type="search" name="search" id="search" placeholder="Zoek naar boeken"
                    class="spectacledcoder-search-bar-input sear py-3 px-7 rounded-full w-1/2 focus:outline-black focus:border-none focus:appearance-none"">
            </Form> 
        </div> 

        <!-- Main Content -->
        <div class="items-center justify-center flex mt-12 w-full">
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
                      <i class="fa-duotone fa-unicorn"></i>
                    </div>
                    <div class="card-info-wrapper">
                      <div class="card-info">
                        <i class="fa-duotone fa-unicorn"></i>
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
    <div class="page-2 h-screen w-screen bg-black">

    </div>









    <script src="./javascript/script.js"></script>
</body>

</html>