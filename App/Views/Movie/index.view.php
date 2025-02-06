<?php

/** @var array $data */
/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Core\LinkGenerator $link */

$movie = $data['movie'];
$cast = $data['actors'];
?>

<div class="d-flex flex-wrap">
    <div>
        <div>
            <img class="moviePageImage" src="<?= $movie->getImage() ?>" alt="404">
        </div>
        <?php if ($auth->isLogged()) { ?>
            <a class="btn btn-primary textColor  setAsWatched" href="<?= $link->url("movie.form", ['movieId' => $movie->getId()]) ?>">
                Set Status
            </a>
        <?php } ?>
    </div>
    <div class="movieHeader">
        <div class="movieTitle ">
            <h3><?= $movie->getTitle() ?></h3>
        </div>
        <div class="movieDesc lh-lg ">
            <p>
                <?= $movie->getSynopsis() ?>
            </p>
        </div>
    </div>
</div>


<div class="d-flex flex-wrap">
    <div class="movieStats">

        <div class="p-3">
            <div class="fw-bold">
                Duration
            </div>
            <div>
                <?= floor($movie->getRuntime() / 60) ?>h <?= $movie->getRuntime() % 60 ?>mins
            </div>
        </div>
        <div class="p-3">
            <div class="fw-bold">
                Release Date
            </div>
            <div>
                <?php
                $dateString = $movie->getReleaseDate();
                $date = DateTime::createFromFormat("Y-m-d", $dateString);
                $formattedDate = $date->format("d.m.Y");
                echo $formattedDate;
                ?>
            </div>
        </div>
        <div class="p-3">
            <div class="fw-bold">
                Average Rating
            </div>
            <div>
                <?= round($movie->getRating(), 2) ?>
            </div>
        </div>
        <div class="p-3">
            <div class="fw-bold">
                Genres
            </div>
            <?php $originalString = $movie->getGenres();
            $genres = explode(" | ", $originalString);
            foreach ($genres as $genre) {
                echo "<div>" . $genre . "</div>";
            }
            ?>
        </div>
        <div class="p-3">
            <div class="fw-bold">
                Director
            </div>
            <div>
                <?= $movie->getDirector() ?>
            </div>
        </div>
    </div>
    <div class="m-5 flex-grow-1">
        <h4 class="textColor">Cast</h4>
        <div class="d-flex flex-wrap justify-content-between actorList">
            <?php foreach ($cast as $actor) { ?>
            <div class="actorDiv p-2">
                <div class="text-center">
                    <img class="actor" src="<?= $actor->getImage() ?>" alt="404">
                </div>
                <div class="titleColor text-center p-2 ">
                    <?= $actor->getName() ?>
                </div>
            </div>
            <?php } ?>
        </div>
        <div>
            <h4 class="textColor">Trailer</h4>
        </div>
        <div class="d-flex full-width ratio-16x9">
            <?php if ($movie->getTrailer() != null) { ?>
            <div class=" full-width ratio ratio-16x9">
                <iframe class="full-width ratio-16x9" src="https://www.youtube.com/embed/<?= $movie->getTrailer() ?>"></iframe>
            </div>
            <?php } else {
                echo "<h1 class='titleColor'>Trailer not found</h1>";
            }?>
        </div>
    </div>
</div>