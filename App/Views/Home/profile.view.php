<?php

/** @var Array $data */
/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Core\LinkGenerator $link */
?>

<div class="d-flex flex-column m-3 p-2 stats fw-bold">
    <div class="container p-2 ">
        <div class="row text-center">
            <div class="col text-center p-1">
                <div class="highlighted">
                    12
                </div>
                <div class="">
                    Total Movies
                </div>
            </div>
            <div class="col text-center p-1">
                <div class="highlighted">
                    1.2
                </div>
                <div class="">
                    Days Watched
                </div>
            </div>
            <div class="col text-center p-1">
                <div class="highlighted">
                    7.7
                </div>
                <div class="">
                    Mean Score
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex p-2 border-top">
        <div class="nula">
            0
        </div>
        <div class="polovica">
            50
        </div>
        <div class="stovka">
            100
        </div>
    </div>
    <div class="progress">
        <div class="progress-bar highlightedBg" role="progressbar" style="width: 12%;" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
</div>

<div class="stats bgColor activityTextMargin">
    <h3>Activity</h3>
</div>

<div class="d-flex flex-wrap">
    <?php foreach ($data['activities'] as $post): ?>
    <div class="d-flex flex-row m-3  stats fw-bold activityWidth">
        <div>
            <a href="<?= $link->url("home.movie", ['movieId' => $post->getMovieId()]) ?>"><img class="activityImage" src="public/images/poster.jpg" alt="404"></a>
        </div>
        <div class="d-flex align-items-center justify-content-center p-2">
            <div>
                <span>Watched</span><a class="linkText" href="<?= $link->url("home.movie", ['movieId' => $post->getMovieId()]) ?>"><span class="highlighted p-2">Hardcore Henry</span></a><br>
                <span>Score: </span><?= $post->getRating() ?>
            </div>
        </div>
        <div class="activityDate p-2">
            2 days ago
        </div>
    </div>
    <?php endforeach; ?>
</div>
