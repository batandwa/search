<?php
function performSearch($mysqli) {
    $searchkey = $_GET['search'];
    $output = '';

    if ($result = $mysqli->query("SELECT * FROM pages WHERE title like '%$searchkey%' or keywords like '%$searchkey%' or description like '%$searchkey%' ")) {
        $output .= sprintf("Select returned %d rows.\n", $result->num_rows);
        while ($row = mysqli_fetch_array($result)) {
            $output .= '<div><strong>' . $row['title'] . '</strong>';
            $output .= '<p>' . $row['description'] . '</p></div>';
        }
        $result->close();
    }

    return $output;
}
