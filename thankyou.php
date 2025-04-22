<?php
require_once ('assets/classes/Database.php');
$db = new Database();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $question = $_POST['question'] ?? '';
    
    try {
        $db->insertQuestion($name, $email, $subject, $question);
    } catch (PDOException $e) {
        $error = "Chyba pri ukladaní do databázy: " . $e->getMessage();
    }
}
include("assets/_inc/header.php");

?>

<section class="thank-you-section" style="text-align: center; padding: 100px 20px;">
    <div class="container">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'] ?? '';
            if (empty($name)) {
                echo "<h2>Thank you for filling out the form.</h2>";
            } else {
                echo "<h2>Thank you, $name, for filling out the form.</h2>";
            }
            
        }
        ?>
        <br>
        <a href="index.php" class="btn btn-primary">Back to Home</a>
    </div>
</section>

<section class="featured-properties">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="property-item">
                    <a href="property-details.php"><img src="assets/images/property-01.jpg" alt="Property 1" style = "border-radius: 25px"></a>
                    <div class="down-content">
                        <h4>Modern Villa</h4>
                        <h6><small>From:</small> $2,264,000</h6>
                        <p>This modern villa offers luxurious living with a stunning sea view.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="property-item">
                    <a href="property-details.php"><img src="assets/images/property-02.jpg" alt="Property 2" style = "border-radius: 25px"></a>
                    <div class="down-content">
                        <h4>Luxury Apartment</h4>
                        <h6><small>From:</small> $1,180,000</h6>
                        <p>A stylish apartment in the city center with access to all amenities.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="property-item">
                    <a href="property-details.php"><img src="assets/images/property-03.jpg" alt="Property 3" style = "border-radius: 25px;"></a>
                    <div class="down-content">
                        <h4>Penthouse with Terrace</h4>
                        <h6><small>From:</small> $3,750,000</h6>
                        <p>A spacious penthouse with a large terrace and panoramic city views.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include("assets/_inc/footer.php");
?>

</html>
