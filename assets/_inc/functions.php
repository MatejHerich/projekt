<?php
function get_menu(array $pages) {
    $menuItems = ''; 
    foreach ($pages as $page_name => $page_url) {
        if ($page_name === 'Contact Us') {   
            $menuItems .= '<li><a href="' . $page_url . '" style="padding-left: 20px;"">' . $page_name . '</a></li>';} 
        else {
            $menuItems .= '<li><a href="' . $page_url . '">' . $page_name . '</a></li>';}
    }
    return $menuItems;}
function add_scripts(){
    echo  ('<script src="vendor/jquery/jquery.min.js"></script>');
    echo  ('<script src="vendor/bootstrap/js/bootstrap.min.js"></script>');
    echo  ('<script src="assets/js/isotope.min.js"></script>');
    echo  ('<script src="assets/js/owl-carousel.js"></script>');
    echo  ('<script src="assets/js/counter.js"></script>');
    echo  ('<script src="assets/js/custom.js"></script>');
}
function add_stylesheets(){
    echo '<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">';
    echo '<link rel="stylesheet" href="assets/css/fontawesome.css">';
    echo '<link rel="stylesheet" href="assets/css/templatemo-villa-agency.css">';
    echo '<link rel="stylesheet" href="assets/css/owl.css">';
    echo '<link rel="stylesheet" href="assets/css/animate.css">';
    echo '<link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>';
}    