<?php
function performSearch($mysqli) {
    $searchkey = $_GET['search'];
    if ($result = $mysqli->query("SELECT * FROM pages WHERE title like '%$searchkey%' or keywords like '%$searchkey%' or description like '%$searchkey%' ")) {
        printf("Select returned %d rows.\n", $result->num_rows);
        while ($row = mysqli_fetch_array($result)) {
            print('<div><strong>' . $row['title'] . '</strong>');
            print('<p>' . $row['description'] . '</p></div>');
        }
        $result->close();
    }
}
