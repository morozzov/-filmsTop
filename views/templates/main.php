<?php
$url = $_SERVER['REQUEST_URI'];
$url = explode('?', $url);
$url = strtolower($url[0]);
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Top Films</title>
    <link rel="stylesheet" href="/public/vendors/bootstrap502/css/bootstrap.css">

    <script src="/public/vendors/bootstrap502/js/jquery-3.6.0.min.js"></script>
    <style>
        .linkCard:hover {
            background: #F7F7F7;
        }
    </style>
</head>
<body>


<header class="card-header p-1 mb-1 border-bottom">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="/films/getall" class="nav-link px-2 link-secondary">Films</a></li>

            </ul>

            <div>
                <a href="/users/logout" class="link-dark">logout(<?= $_SESSION["user_name"]?>)</a>
            </div>
        </div>
    </div>
</header>


<main style="min-height: 100vh">
    <?php require_once './views/' . $contentPage . '.php'; ?>
</main>

<script src="/public/vendors/bootstrap502/js/bootstrap.bundle.js"></script>

</body>
</html>