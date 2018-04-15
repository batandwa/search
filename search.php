<?php
$searchPerformed = isset($_GET['search']) && !empty($_GET['search']);
if ($searchPerformed) {
    $mysqli = new mysqli("localhost", "root", "", "safehack");

    if ($mysqli->connect_errno) {
        echo $mysqli->connect_error;
        die("Application offline.");
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>SearchEngine</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <link href="main.css" rel="stylesheet">
    <?php if (!$searchPerformed): ?>
        <link href="signin.css" rel="stylesheet">
    <?php else: ?>
        <link href="results.css" rel="stylesheet">
    <?php endif ?>

</head>

<body class="<?php echo $searchPerformed ? '' : 'text-center'; ?>">
<?php if ($searchPerformed): ?>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="#">
                <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72"
                     height="72">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                </ul>
                <form method="get" action="index.php" class="form-inline mt-2 mt-md-0">
                    <input class="form-control mr-sm-2" name="search" placeholder="Search" aria-label="Search"
                           type="text">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
    </header>
<?php endif ?>

<?php if (!$searchPerformed): ?>
    <div class="container">
        <div class="row">
            <div class="col-xl">
                <form method="get" action="index.php" class="form-signin">
                    <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72"
                         height="72">
                    <div class="form-group">
                        <input type="text" class="form-control" name="search" aria-describedby="emailHelp"
                               placeholder="Search..."
                               required>
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
    </div>
<?php endif ?>

<?php
if ($searchPerformed): ?>
    <div class="container results">
        <div class="row">
            <div class="col-xl">
                <?php print performSearch($mysqli); ?>
            </div>
        </div>
    </div>
<?php endif ?>

</body>
</html>
