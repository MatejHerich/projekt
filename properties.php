<?php
require_once 'assets/classes/DatabaseConnection.php';
require_once 'assets/classes/PropertyManager.php';

$dbConnection = new DatabaseConnection();
$pdo = $dbConnection->getConnection();
$propertyManager = new PropertyManager($pdo);

$properties = $propertyManager->getAllProperties();
$categories = array_unique(array_column($properties, 'kategoria'));

include("assets/_inc/header.php");
?>
<div class="page-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <span class="breadcrumb"><a href="#">Home</a> / Properties</span>
        <h3>Properties</h3>
      </div>
    </div>
  </div>
</div>

<div class="section properties">
  <div class="container">
    <ul class="properties-filter">
      <li>
        <a class="is_active" href="#!" data-filter="*">Show All</a>
      </li>
      <?php foreach ($categories as $category):
        $safeCategory = htmlspecialchars(preg_replace('/[^a-z0-9]/', '', strtolower($category)));
      ?>
      <li>
        <a href="#!" data-filter=".<?php echo $safeCategory; ?>"><?php echo htmlspecialchars($category); ?></a>
      </li>
      <?php endforeach; ?>
    </ul>

    <div class="row properties-box">
      <?php foreach ($properties as $property): ?>
      <div class="col-lg-4 col-md-6 align-self-center mb-30 properties-items col-md-6 <?php echo htmlspecialchars(strtolower(str_replace(' ', '', $property['kategoria']))); ?>">
        <div class="item">
          <a href="property-details.php?id=<?php echo htmlspecialchars($property['id']); ?>">
            <img src="assets/images/<?php echo htmlspecialchars($property['obrazok']); ?>" alt="<?php echo htmlspecialchars('Property: ' . $property['nazov']); ?>">
          </a>
          <span class="category"><?php echo htmlspecialchars($property['kategoria']); ?></span>
          <h6><?php echo htmlspecialchars('$' . number_format($property['cena'], 0, '.', '.')); ?></h6>
          <h4><a href="property-details.php?id=<?php echo htmlspecialchars($property['id']); ?>"><?php echo htmlspecialchars($property['nazov']); ?></a></h4>
          <ul>
            <li>Bedrooms: <span><?php echo htmlspecialchars($property['pocet_izieb']); ?></span></li>
            <li>Bathrooms: <span><?php echo htmlspecialchars($property['pocet_kupelni']); ?></span></li>
            <li>Area: <span><?php echo htmlspecialchars($property['rozloha'] . 'm2'); ?></span></li>
            <li>Floor: <span><?php echo htmlspecialchars($property['poschodie']); ?></span></li>
            <li>Parking: <span><?php echo htmlspecialchars($property['parkovanie']); ?></span></li>
          </ul>
          <div class="main-button">
            <a href="property-details.php?id=<?php echo htmlspecialchars($property['id']); ?>">Schedule a visit</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <ul class="pagination">
          <li><a href="#">1</a></li>
          <li><a class="is_active" href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">>></a></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<?php
include("assets/_inc/footer.php");
?>
</html>
