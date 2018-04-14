<?php
/**
 * @param $mysqli
 * @param $title
 * @param $description
 */
function performSearch($mysqli) {
    $searchkey = "%{$_GET['search']}%";
    $stmt = $mysqli->prepare("SELECT id,title,description FROM pages WHERE title like ? or keywords like ? or description like ?");
    $stmt->bind_param('sss', $searchkey, $searchkey, $searchkey);
    $querySuccessful = $stmt->execute();

    if ($querySuccessful) {
        $stmt->store_result();
        $stmt->bind_result($id, $title, $description);

        printf("Select returned %d rows.\n", $stmt->num_rows);
        while ($stmt->fetch()) {
            print('<div><strong>' . $title . '</strong>');
            print('<p>' . $description . '</p></div>');
        }
    }
}
