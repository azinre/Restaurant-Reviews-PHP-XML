<header><?php include "header.php" ?></header>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Street = $_POST['Street'];
    $City = $_POST['City'];
    $Province = $_POST['Province'];
    $Postal = $_POST['Postal'];
    $Sumary = $_POST['Sumary'];
    $Rating = $_POST['Rating'];
    $restaurantId = $_POST['restaurantId'];
    // Load the XML
    $xml = simplexml_load_file('xml/restaurant_reviews.xml');
    if (isset($xml->restaurant[$restaurantId - 1])) {
        $selectedRestaurant = $xml->restaurant[$restaurantId - 1];
        // Check if any of the fields have changed
        $fieldsChanged = false;
        if ($selectedRestaurant->address->street != $Street
            || $selectedRestaurant->address->city != $City
            || $selectedRestaurant->address->province != $Province
            || $selectedRestaurant->address->postalCode != $Postal
            || $selectedRestaurant->summary != $Sumary
            || (int)$selectedRestaurant->rating != $Rating) {
            $fieldsChanged = true;
        }
        if ($fieldsChanged) {
            // Save changes to XML only if any field has changed
            $selectedRestaurant->address->street = $Street;
            $selectedRestaurant->address->city = $City;
            $selectedRestaurant->address->province = $Province;
            $selectedRestaurant->address->postalCode = $Postal;
            $selectedRestaurant->summary = $Sumary;
            $selectedRestaurant->rating = $Rating;
            $xml->asXML('xml/restaurant_reviews.xml');
            echo '<div class="alert alert-success">Restaurant was Edit Successful.</div>';
        } else {
            echo '<div class="alert alert-info">No changes were made.</div>';
        }
        header('Location: RestaurantReviews.php?restaurant=' . $restaurantId . '&success=1');

    } else {
        echo '<div class="alert alert-danger">Restaurant was not Edit.</div>';
    }
}
?>
<footer><?php include "Footer.php" ?></footer>
