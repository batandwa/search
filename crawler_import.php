<?php
$mysqli = new mysqli("db", "root", "safehack", "safehack");
if ($mysqli->connect_errno) {
    die("Application offline.");
}

$json = file_get_contents('/app/scraper/4.json');
$jsonData = json_decode($json, false);
//foreach ($jsonData as $property) {
//
//    var_dump($property->bathrooms[0]);
//}

//$xmlContents = file_get_contents($file);
//$xml = new SimpleXMLElement($xmlContents, $vulnerable ? LIBXML_NOENT : 0);
$insertFields = [
    'title',
    'price',
    'deposit',
    'image_url',
    'bedrooms',
    'provider_url',
    'description'
];
$sql = 'INSERT INTO pages (' . implode(',', $insertFields) .') VALUES (' . implode(',', array_fill(0, sizeof($insertFields), '?')) . ')';
$statement = $mysqli->prepare($sql);
echo $mysqli->error;
$statement->bind_param('sddsiss', $title, $price, $deposit, $image_url, $bedrooms, $provider_url, $description);

$jsonData = array_slice($jsonData, 0, 100);
foreach ($jsonData as $property) {
    $parsedProperty = parseCrawlerProperty($property);

    $title = $parsedProperty['title'];
    extract($parsedProperty, EXTR_OVERWRITE);
    $statement->execute();
    echo $statement->error;
}

function parseCrawlerProperty($property) {
    $result = array();

    $result['title'] = isset($property->title) ? $property->title[0] : null;
    $result['title'] = substr($result['title'], 0, 490);
    $result['price'] = isset($property->price) ? $property->price[0] : null;
    $result['image_url'] = isset($property->image) ? $property->image[0] : null;
    $result['bedrooms_raw'] = isset($property->bedrooms) ? $property->bedrooms[0] : null;
    $result['bedrooms'] = $result['bedrooms_raw'];
    $bedroomsExploded = explode(' ', $result['bedrooms_raw']);
    if (sizeof($bedroomsExploded) > 1) {
        $result['bedrooms'] = $bedroomsExploded[0];
    }
    $result['provider_url'] = isset($property->provider_url) ? $property->provider_url[0] : null;
    $result['price'] = isset($property->price) ? $property->price[0] : null;
    $result['price'] = parsePrice($result['price']);
    $result['deposit'] = isset($property->deposit) ? $property->deposit[0] : null;
    $result['offer'] = determineOffer($result['provider_url']);

    return $result;
}

function parsePrice($price) {
    return preg_replace('/[^\d]/', '', $price);
}

function determineOffer($url) {
    if(strpos($url, '/for-sale/') !== false) {
        return 'sale';
    }
    if(strpos($url, '/for-rent/') !== false) {
        return 'rent';
    }
    return null;
}
