<?php require_once __DIR__ . '/config.php'; ?>

<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="static/image/favicon.ico">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>LMS</title>
</head>

<body>

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Library</a>
            <!-- <a class="navbar-brand" href="#"><img src="static/image/logo.png" style="height: 1.31em;" alt="Logo"></a> -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <?php require __DIR__ . '/partials/navbar/_login.php'; ?>
                    <?php require __DIR__ . '/partials/navbar/_dashboard.php'; ?>
                    <?php require __DIR__ . '/partials/navbar/_search_member.php'; ?>
                    `<?php require __DIR__ . '/partials/navbar/_logout.php'; ?>
                </ul>
                <form class="d-flex" action="search.php" method="GET">
                    <input required name="query" class="form-control me-2" type="search" placeholder="Search by book or author" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <center style="margin-top: 8em;">
        <h1>
            <strong>
                LIBRARY MANAGEMENT SYSTEM
            </strong>
        </h1>
    </center>

    <div class="container" style="width: 48em;">
        <?php require __DIR__ . '/partials/_show_alert.php'; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>