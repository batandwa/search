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
    $output = '';

    if ($querySuccessful) {
        $stmt->store_result();
        $stmt->bind_result($id, $title, $description);

        printf("Select returned %d rows.\n", $stmt->num_rows);
        while ($stmt->fetch()) {
            $output .= '<div><strong>' . $title . '</strong>';
            $output .= '<p>' . $description . '</p></div>';
        }
    }

    return $output;
}
