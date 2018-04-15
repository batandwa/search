<?php
/**
 * @param $file
 * @internal param $vulnerable
 * @internal param $mysqli
 * @internal param $description
 */
function parseXml($file) {
    global $vulnerable;
    global $mysqli;

    $xmlContents = file_get_contents($file);
    $xml = new SimpleXMLElement($xmlContents, $vulnerable ? LIBXML_NOENT : 0);
    $sql = 'INSERT INTO pages (title, description, image_url, bedrooms, provider_url, agent_contact, address, price, deposit) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
    $statement = $mysqli->prepare($sql);
    $statement->bind_param('sssisssdd', $title, $description, $image_url, $bedrooms, $provider_url, $agent_contact, $address, $price, $deposit);

    foreach ($xml->property as $prop) {
        $description = substr($prop->description, 0, 490);
        $description = $vulnerable ? $description : htmlentities($description);
   //     $keywords = $vulnerable ? $prop->keywords : htmlentities($prop->keywords);
        $title = $vulnerable ? $prop->title : htmlentities($prop->title);
        $image_url = $vulnerable ? $prop->image_url : htmlentities($prop->image_url);
        $bedrooms = $vulnerable ? $prop->bedrooms : htmlentities($prop->bedrooms);
        $provider_url = $vulnerable ? $prop->provider_url : htmlentities($prop->provider_url);
        $agent_contact = $vulnerable ? $prop->agent_contact : htmlentities($prop->agent_contact);
        $address = $vulnerable ? $prop->address : htmlentities($prop->address);
        $price = $vulnerable ? $prop->price : htmlentities($prop->price);
        $deposit = $vulnerable ? $prop->deposit : htmlentities($prop->deposit);
        $statement->execute();
        echo $statement->error;
    }

    $statement->close();
}
