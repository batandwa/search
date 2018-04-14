<?php



//$xml_string = "<person><name>Welcome aboard this <![CDATA[P&O Cruises]]> voyage!</name> <title><![CDATA[<script>alert(1)</script>]]></title>  </person>";
//
//$person = new SimpleXMLElement($xml_string);
//echo 'CDATA retained: ', $person->asXML();
//
//$person = new SimpleXMLElement($xml_string, LIBXML_NOCDATA);
//echo 'CDATA merged: ', $person->asXML();




//global $mysqli;

$xmlContents = file_get_contents('uploads/test.xml');
$xml = new SimpleXMLElement($xmlContents);
//echo $xml->bbb->cccc->dddd['Id'];
//echo $xml->bbb->cccc->eeee['name'];
//var_dump($xml->property);
$sql = 'INSERT INTO pages (title, keywords, description) VALUES (?, ?, ?)';
$statement = $mysqli->prepare($sql);
$statement->bind_param('sss', $title, $keywords, $descr);
foreach ($xml->property as $prop) {
//    var_dump($prop);
//    echo $prop->title;
//    var_dump($mysqli);
    $descr = substr($prop->description, 0, 490);
    $keywords = $prop->keywords;
    $title = $prop->title;
    $statement->execute();
}

/* close statement and connection */
$statement->close();
// or...........
//foreach ($xml->bbb->cccc as $element) {
//    foreach($element as $key => $val) {
//        echo "{$key}: {$val}";
//    }
//}