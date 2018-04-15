<?php
function performSearch($mysqli) {
    $searchkey = $_GET['search'];
    $output = '';

    $result = $mysqli->query("SELECT * FROM pages WHERE title like '%$searchkey%' or description like '%$searchkey%'  LIMIT 10");
    if ($result !== false) {
        $output .= sprintf("<em>Search returned %d rows.</em><br><br>\n", $result->num_rows);
        while ($row = mysqli_fetch_array($result)) {
            $output .= '<div><a href="' . $row['provider_url'] . '"><strong>' . $row['title'] . '</strong></a>';
            $output .= '<p>' . $row['description'] . '</p></div>';
        }
        $result->close();
    }

    return $output;
}
