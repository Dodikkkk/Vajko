<?php

/** @var array $data */
/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Core\LinkGenerator $link */

$movieId = $data['movieId'];
?>

<div class="d-flex flex-wrap">
    <div>
        <div>
            <img class="moviePageImage" src="public/images/poster.jpg" alt="404">
        </div>
        <?php if ($auth->isLogged()) { ?>
            <a class="btn btn-primary textColor  setAsWatched" href="<?= $link->url("home.form", ['movieId' => $movieId]) ?>">
                Set Status
            </a>
        <?php } ?>
    </div>
    <div class="movieHeader">
        <div class="movieTitle ">
            <h3>Hardcore Henry</h3>
        </div>
        <div class="movieDesc lh-lg ">
            <p>
                A man wakes up in a Moscow laboratory to learn that he's been brought back from the dead as a half-human, half-robotic hybrid. With no memory of his former life, a woman who claims to be his wife tells him that his name is Henry. Before she can activate his voice, armed thugs storm in and kidnap her. As Henry starts to understand his new abilities, he embarks on a bloody rampage through the city to save his spouse from a psychopath (Danila Kozlovsky) who plans to destroy the world.
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
                1hour 35mins
            </div>
        </div>
        <div class="p-3">
            <div class="fw-bold">
                Release Date
            </div>
            <div>
                8.4.2016
            </div>
        </div>
        <div class="p-3">
            <div class="fw-bold">
                Average Rating
            </div>
            <div>
                6.7/10
            </div>
        </div>
        <div class="p-3">
            <div class="fw-bold">
                Genres
            </div>
            <div>
                Action
            </div>
            <div>
                Sci-Fi
            </div>
        </div>
        <div class="p-3">
            <div class="fw-bold">
                Director
            </div>
            <div>
                Ilya Naishuller
            </div>
        </div>
    </div>
    <div class="m-5 flex-grow-1">
        <h4 class="textColor">Cast</h4>
        <div class="d-flex flex-wrap justify-content-between actorList">
            <div class="actorDiv p-2">
                <div class="text-center">
                    <img class="actor" src="public/images/profile.webp" alt="404">
                </div>
                <div class="titleColor text-center p-2 ">
                    Actor
                </div>
            </div>
            <div class="actorDiv p-2">
                <div class="text-center">
                    <img class="actor" src="public/images/profile.webp" alt="404">
                </div>
                <div class="titleColor text-center p-2 ">
                    Actor
                </div>
            </div>
            <div class="actorDiv p-2">
                <div class="text-center">
                    <img class="actor" src="public/images/profile.webp" alt="404">
                </div>
                <div class="titleColor text-center p-2 ">
                    Actor
                </div>
            </div>
        </div>
        <div>
            <h4 class="textColor">Trailer</h4>
        </div>
        <div class="d-flex full-width ratio-16x9">
            <div class=" full-width ratio ratio-16x9">
                <iframe class="full-width ratio-16x9" src="https://www.youtube.com/embed/96EChBYVFhU?si=NPd78YqNcFh_qQ1M"></iframe>
            </div>
        </div>
    </div>
</div>