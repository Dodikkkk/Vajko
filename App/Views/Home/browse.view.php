<?php

/** @var array $data */
/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Core\LinkGenerator $link */

$movies = $data['movies'];
?>

<div class="d-flex textColor m-5 justify-content-center">
    <div class="m-2">
        <div>
            Year
        </div>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Any
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">2024</a></li>
                <li><a class="dropdown-item" href="#">2023</a></li>
                <li><a class="dropdown-item" href="#">2022</a></li>
                <li><a class="dropdown-item" href="#">2021</a></li>
                <li><a class="dropdown-item" href="#">2020</a></li>
                <li><a class="dropdown-item" href="#">2019</a></li>
                <li><a class="dropdown-item" href="#">2018</a></li>
                <li><a class="dropdown-item" href="#">2017</a></li>
                <li><a class="dropdown-item" href="#">2016</a></li>
                <li><a class="dropdown-item" href="#">2015</a></li>
            </ul>
        </div>
    </div>
    <div class="m-2">
        <div>
            Sort by
        </div>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Alphabetically
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Alphabetically</a></li>
                <li><a class="dropdown-item" href="#">Rating - Best</a></li>
                <li><a class="dropdown-item" href="#">Rating - Worst</a></li>
                <li><a class="dropdown-item" href="#">Newest</a></li>
                <li><a class="dropdown-item" href="#">Oldest</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="d-flex flex-wrap justify-content-center m-5 imgRes">
    <?php foreach ($movies as $movie) { ?>
        <div class="m-3">
            <div>
                <a href="<?= $link->url("home.movie", ['movieId' => $movie['movieId']]) ?>"><img class="browseImage" src="public/images/poster.jpg" alt="404"></a>
            </div>
            <div class="pt-2">
                <a class="titleColor fw-bold linkText" href="<?= $link->url("home.movie") ?>">Hardcore Henry</a>
            </div>
        </div>
    <?php } ?>
</div>