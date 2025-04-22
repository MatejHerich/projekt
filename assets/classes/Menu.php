<?php
class Menu{
    private $menuItems;

    public function __construct($menuItems = []){
      if(empty($menuItems)){
       $menuItems =    [
          ['label' => 'Home','link' => 'index.php'],
          ['label' => 'Properties','link' => 'properties.php'],
          ['label' => 'Property details','link' => 'property-details.php'],
          ['label' => 'Contact','link' => 'contact.php'],];
      }
      $this->menuItems = $menuItems;}

    public function index(){
      return $this->menuItems;}
  
    public function add_scripts(){
        echo  ('<script src="vendor/jquery/jquery.min.js"></script>');
        echo  ('<script src="vendor/bootstrap/js/bootstrap.min.js"></script>');
        echo  ('<script src="assets/js/isotope.min.js"></script>');
        echo  ('<script src="assets/js/owl-carousel.js"></script>');
        echo  ('<script src="assets/js/counter.js"></script>');
        echo  ('<script src="assets/js/custom.js"></script>');}
    
    public function add_stylesheets(){
        echo '<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">';
        echo '<link rel="stylesheet" href="assets/css/fontawesome.css">';
        echo '<link rel="stylesheet" href="assets/css/templatemo-villa-agency.css">';
        echo '<link rel="stylesheet" href="assets/css/owl.css">';
        echo '<link rel="stylesheet" href="assets/css/animate.css">';
        echo '<link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>';
}    }