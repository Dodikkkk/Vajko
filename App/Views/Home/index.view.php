<?php

/** @var array $data */
/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Core\LinkGenerator $link */

$movies = $data['movies'];
?>

<div class="d-flex textColor m-5 justify-content-center">
    <div class="m-2">
        <div class="text-center">
            Year
        </div>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="yearBtn">
                Any
            </button>
            <ul class="dropdown-menu scrollableDropdown" id="year">
                <?php
                for ($i = 2026; $i >= 1922; $i--) {
                    echo "<li><button id='year". $i ."' onclick='updateYearFilter(". $i . ")' class=\"dropdown-item\">$i</button></li>";
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="m-2">
        <div class="text-center">
            Sort by
        </div>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" id="orderBtn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Default
            </button>
            <ul class="dropdown-menu">
                <li><button class="dropdown-item" onclick="updateOrderFilter(1)" id="order1">Alphabetically</button></li>
                <li><button class="dropdown-item" onclick="updateOrderFilter(2)" id="order2">Rating - Best</button></li>
                <li><button class="dropdown-item" onclick="updateOrderFilter(3)" id="order3">Rating - Worst</button></li>
                <li><button class="dropdown-item" onclick="updateOrderFilter(4)" id="order4">Newest</button></li>
                <li><button class="dropdown-item" onclick="updateOrderFilter(5)" id="order5">Oldest</button></li>
            </ul>
        </div>
    </div>
</div>

<div class="d-flex flex-wrap justify-content-center m-5 imgRes">
    <?php if(count($movies) != 0) {
    foreach ($movies as $movie) { ?>
        <div class="m-3">
            <div>
                <a href="<?= $link->url("movie.index", ['movieId' => $movie->getId()]) ?>"><img class="browseImage" src="<?= $movie->getImage() ?>" alt="Image not Found"></a>
            </div>
            <div class="pt-2" style="max-width: 13rem">
                <a class="titleColor fw-bold linkText" href="<?= $link->url("movie.index", ['movieId' => $movie->getId()]) ?>"><?= $movie->getTitle() ?></a>
            </div>
        </div>
    <?php }} else { ?>
    <div class="m-3" style="color: azure">
        <h1>No movies were found...</h1>
    </div>
    <?php } ?>
</div>