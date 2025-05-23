<?php
   require('assets/classes/Menu.php');
   $menu = new Menu();
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Villa Agency - Real Estate HTML5 Template</title>
    <?php
    $menu->add_stylesheets();
    ?>
  </head>

<body>

  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>

  <div class="sub-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8">
          <ul class="info">
            <li><i class="fa fa-envelope"></i> info@company.com</li>
            <li><i class="fa fa-map"></i> Sunny Isles Beach, FL 33160</li>
          </ul>
        </div>
        <div class="col-lg-4 col-md-4">
          <ul class="social-links">
            <li><a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a></li>
            <li><a href="https://x.com/minthu" target="_blank"><i class="fab fa-twitter"></i></a></li>
            <li><a href="https://www.linkedin.com/"><i class="fab fa-linkedin"></i></a></li>
            <li><a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <a href="index.php" class="logo">
                        <h1>Villa</h1>
                    </a>
                    <ul class="nav">
                    <?php
                      $menuItems = $menu->getMenu();
                      foreach($menuItems as $item){
                        $padding = ($item['label'] == 'Contact') ? ' style="padding-left: 20px;"' : '';
                        echo '<li><a href="' . $item['link'] . '"' . $padding . '>' . $item['label'] . '</a></li>';}
                       if (isset($_SESSION['admin']) && $_SESSION['admin'] === true): ?>
                          <li><a href="admin.php?logout=1" style="color: red; font-weight: bold; padding-left: 20px;">Log Out</a></li>
                       <?php endif; ?>    
                  </ul>   
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                </nav>
            </div>
        </div>
    </div>
  </header>