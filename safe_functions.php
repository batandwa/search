<?php
/**
 * @param $mysqli
 * @param $title
 * @param $description
 */
function performSearch($mysqli) {
    $searchkey = "%{$_GET['search']}%";
    $stmt = $mysqli->prepare("SELECT title,description,provider_url FROM pages WHERE title like ? or description like ? or provider_url like ? LIMIT 10");
    $stmt->bind_param('sss', $searchkey, $searchkey, $searchkey);
    $querySuccessful = $stmt->execute();
    $output = '';

    if ($querySuccessful) {
        $stmt->store_result();
        $stmt->bind_result($title, $description, $provider_url);

        printf("Select returned %d rows.\n", $stmt->num_rows);
        while ($stmt->fetch()) {
            $output .= '<div><strong>' . $title . '</strong>';
            $output .= '<p>' . $description . '</p></div>';
        }
    }

    return $output;
}
