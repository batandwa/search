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

        printf("<em>Search returned %d rows.</em><br><br>\n", $stmt->num_rows);
        while ($stmt->fetch()) {
            $output .= '<div><a href="' . $provider_url . '"><strong>' . $title . '</strong></a>';
            $output .= '<p>' . $description . '</p></div>';
        }
    }

    return $output;
}
