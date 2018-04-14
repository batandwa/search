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
    $sql = 'INSERT INTO pages (title, keywords, description) VALUES (?, ?, ?)';
    $statement = $mysqli->prepare($sql);
    $statement->bind_param('sss', $title, $keywords, $description);

    foreach ($xml->property as $prop) {
        $description = substr($prop->description, 0, 490);
        $description = $vulnerable ? $description : htmlentities($description);
        $keywords = $vulnerable ? $prop->keywords : htmlentities($prop->keywords);
        $title = $vulnerable ? $prop->title : htmlentities($prop->title);
        $statement->execute();
        echo $statement->error;
    }

    $statement->close();
}
