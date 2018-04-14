<?php
$xmlContents = file_get_contents('uploads/xxe.xml');
$xml = new SimpleXMLElement($xmlContents, $vulnerable ? LIBXML_NOENT : 0);
$sql = 'INSERT INTO pages (title, keywords, description) VALUES (?, ?, ?)';
$statement = $mysqli->prepare($sql);
$statement->bind_param('sss', $title, $keywords, $description);

foreach ($xml->property as $prop) {
    $description = substr($prop->description, 0, 490);
    $keywords = $prop->keywords;
    $title = $prop->title;
    $statement->execute();
}

$statement->close();
