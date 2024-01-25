<header><?php include "header.php" ?></header>
<main>
    <?php
    $xml = simplexml_load_file('xml/restaurant_reviews.xml');
    $count = 1;
    $restaurantNames = array();
    $xml = simplexml_load_file('xml/restaurant_reviews.xml');
    $restaurantNames = array();
    foreach ($xml->restaurant as $restaurant) {
        $nameOption = (string) $restaurant->name;
        $restaurantNames[] = $nameOption;
    }
    ?>
    <div class="container scroll-content fadeLeft">
        <h1 class="text-center mb-4">Online Restaurant Review</h1>
        <div class="containerItem mt-3 scroll-content fadeRight">
            <p class="mb-2">Select a Restaurant from the dropdown list to view/edit its review:</p>
            <form action="RestaurantReviews.php" method="get" class="form-horizontal" id="restaurantForm">
                <div class="form-group">
                    <label for="Restaurants" id="Restaurants" class="col-sm-2 control-label">Restaurants</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="restaurant" id="restaurant">
                            <option>choose the restaurant...</option>'
                            <?php
                            foreach ($restaurantNames as $name) {
                                echo '<option value=' . $count . '>' . $name . '</option>';
                                $count++;
                            }

                            ?>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        var select = document.getElementById('restaurant');
        select.onchange = function() {
            var form = document.getElementById('restaurantForm');
            form.submit();
        };
    </script>  
</main>
<footer><?php include "Footer.php" ?></footer>