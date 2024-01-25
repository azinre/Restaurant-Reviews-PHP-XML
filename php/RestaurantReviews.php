<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);

class RestaurantCls {
    public $name;
    public $id;
    public function __construct($name, $id) {
        $this->name = $name;
        $this->id = $id;
    }
}

$ini_array = parse_ini_file("../Data/LAB5.ini");
$xmlpath = $ini_array['xmlpath'];

function getRestaurants($xmlpath) {
    return simplexml_load_file($xmlpath);
}

if (isset($_GET["action"]) && $_GET["action"] == "searchNames") {
    $restaurants = getRestaurants($xmlpath);
    $restaurants_name_list = array();
    $index = 0;
    foreach ($restaurants->restaurant as $restaurant) {
        $name = (string)$restaurant->name;
        $index++;
        array_push($restaurants_name_list, new RestaurantCls($name, $index));
    }
    header('Content-Type: application/json');
    echo json_encode($restaurants_name_list);
}

if (isset($_GET["action"]) && $_GET["action"] == "searchRestaurant") {
    $restaurant_id = $_GET["id"];
    $restaurants = getRestaurants($xmlpath);
    if (isset($restaurants->restaurant[intval($restaurant_id) - 1])) {
        $restaurant = $restaurants->restaurant[intval($restaurant_id) - 1];
        $response = array(
            "Name" => (string)$restaurant->name,
            "Address" => array(
                "StreetAddress" => (string)$restaurant->address->street,
                "City" => (string)$restaurant->address->city,
                "ProvinceState" => (string)$restaurant->address->province,
                "PostalZipCode" => (string)$restaurant->address->postalCode
            ),
            "Summary" => (string)$restaurant->summary,
            "Rating" => (string)$restaurant->rating,
            "RatingMin" => (int)$restaurant->rating['min'],
            "RatingMax" => (int)$restaurant->rating['max']
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}

if (isset($_POST["action"]) && $_POST["action"] == "updateRestaurant") {
    $restaurant_id = $_POST["id"];
    $restaurants = getRestaurants($xmlpath);
    if (isset($restaurants->restaurant[intval($restaurant_id) - 1])) {
        $restaurant = $restaurants->restaurant[intval($restaurant_id) - 1];

        $restaurant->address->street = $_POST['StreetAddress'];
        $restaurant->address->city = $_POST['City'];
        $restaurant->address->province = $_POST['ProvinceState'];
        $restaurant->address->postalCode = $_POST['PostalZipCode'];
        $restaurant->summary = $_POST['Summary'];
        $restaurant->rating = $_POST['Rating'];

        $restaurants->asXML($xmlpath);
        header('Content-Type: application/json');
        echo json_encode(array("message" => "Restaurant Updated Successfully"));
    } else {
        header('Content-Type: application/json');
        echo json_encode(array("message" => "Restaurant Not Found"));
    }
}
?>