<?php

/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Core\LinkGenerator $link */
/** @var \App\Core\IAuthenticator $auth */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="public/css/styl.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" >
    <title>Title</title>
</head>
<body class="bgColor">
<nav class="navbar navbar-expand-lg navBarColors fw-bold">
    <div class="d-flex align-items-center justify-content-center full-width">

        <a class="navbar-brand" href="<?= $link->url("home.index") ?>" ><img src="public/images/logo2.webp" class="maly-obrazok" alt="404"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link navBarColors px-4" href="<?= $link->url("home.index") ?>">Browse</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link navBarColors px-4" href="<?= $link->url($auth->isLogged() ? "home.profile" : "auth.login") ?>">Profile</a>
                </li>
                <li>
                    <a class="nav-link navBarColors px-4" href="<?= $link->url($auth->isLogged() ? "home.list" : "auth.login") ?>">My List</a>
                </li>
            </ul>
        </div>


        <form class="form-inline my-2 my-md-0">
            <input class="form-control " type="text" placeholder="Search" aria-label="Search">
        </form>

        <?php if ($auth->isLogged()): ?>
            <a class="nav-link navBarColors px-4 mx-3" href="<?= $link->url('auth.logout') ?>">Logout</a>
        <?php endif; ?>
    </div>
</nav>
<div class="container-fluid mt-3">
    <div class="web-content">
        <?= $contentHTML ?>
    </div>
</div>
</body>
</html>
