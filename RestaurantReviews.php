<header><?php include "header.php" ?></header>
<main>
<?php
if (isset($_GET['success']) && $_GET['success'] === '1') {
    echo '<div class="alert alert-success">Restaurant was Edit Successful.</div>';
}
if (isset($_GET['restaurant'])) {
    $restaurantId = (int)$_GET['restaurant'];   
    $xml = simplexml_load_file('xml/restaurant_reviews.xml');
    $restaurantNames = array();
    foreach ($xml->restaurant as $restaurant) {
        $nameOption = (string) $restaurant->name;
        $restaurantNames[] = $nameOption;
    }    
    if (isset($xml->restaurant[$restaurantId - 1])) {
        $selectedRestaurant = $xml->restaurant[$restaurantId - 1];
        $name = (string)$selectedRestaurant->name;
        $street = (string)$selectedRestaurant->address->street;
        $city = (string)$selectedRestaurant->address->city;
        $province = (string)$selectedRestaurant->address->province;
        $postalCode = (string)$selectedRestaurant->address->postalCode;
        $summary = (string)$selectedRestaurant->summary;
        $Name = (string)$selectedRestaurant->name;
        $rating = (int)$selectedRestaurant->rating;
    } else {
        echo '<div class="alert alert-danger">Restaurant does not find.</div>';
    }
} else {
    echo '<div class="alert alert-danger">No restaurant selected.</div>';
}
?>
<div class="container ">
    <h1 class="text-center mb-4">Online Restaurant Review</h1>
    <div class="containerItem ">
        <p class="mb-2">Select a Restaurant from the dropdown list to view/edit its review:</p>
        <form action="process.php" method="POST" class="form-horizontal" id="FormValidation">
            <input type="hidden" name="restaurantId" id="restaurantId" value=" <?php echo $restaurantId; ?>">
            <div class="form-group">
                <label class="col-sm-2 control-label">Restaurant</label>
                <div class="col-sm-10">
                    <select class="form-control" name="Name" id="Name" placeholder="Rating" disabled>
                        <?php
                        foreach ($restaurantNames as $nameOption) {
                            $selected = ($name === $nameOption) ? 'selected' : '';
                            echo '<option value="' . $nameOption . '" ' . $selected . '>' . $nameOption . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class=" col-sm-2 control-label">Street Address</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="Street" name="Street" placeholder="Street Address" value="<?php echo $street; ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">City</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="City" name="City" placeholder="City" value="<?php echo $city; ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Province/State</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="Province" name="Province" placeholder="Province/State" value="<?php echo $province; ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Postal/Zicp Code</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="Postal" name="Postal" placeholder="Postal/Zip Code" value="<?php echo $postalCode; ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Summary</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="5" placeholder="Sumary" id="Sumary" name="Sumary"><?php echo $summary; ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Rating</label>
                <div class="col-sm-10">
                    <select class="form-control" id="Rating" name="Rating" placeholder="Rating">
                        <?php
                        $min = (int)$selectedRestaurant->rating['min'];
                        $max = (int)$selectedRestaurant->rating['max'];
                        for ($i = $min; $i <= $max; $i++) {
                            $selected = ($rating === $i) ? 'selected' : '';
                            echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-default buttonCSS" />
                    <i class="fa-regular "></i> Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
<br>
<br>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/validation.js"></script>
</main>
<footer><?php include "Footer.php" ?></footer>