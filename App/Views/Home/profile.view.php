<?php

/** @var Array $data */
/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Core\LinkGenerator $link */
$movies = $data['movies'];
?>

<div class="d-flex flex-column m-3 p-2 stats fw-bold">
    <div class="container p-2 ">
        <div class="row text-center">
            <div class="col text-center p-1">
                <div class="highlighted">
                    <?= count($data['activities']) ?>
                </div>
                <div class="">
                    Total Movies
                </div>
            </div>
            <div class="col text-center p-1">
                <div class="highlighted">
                    <?= $data['daysWatched'] ?>
                </div>
                <div class="">
                    Days Watched
                </div>
            </div>
            <div class="col text-center p-1">
                <div class="highlighted">
                    <?= $data['mean']?>
                </div>
                <div class="">
                    Mean Score
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex p-2 border-top">
        <div class="nula">
            <?= $data['start']?>
        </div>
        <div class="polovica">
            <?= $data['mid'] ?>
        </div>
        <div class="stovka">
            <?= $data['end'] ?>
        </div>
    </div>
    <div class="progress">
        <div class="progress-bar highlightedBg" role="progressbar" style="width: <?= $data['ratio'] ?>%;" aria-valuenow="<?= count($data['activities'])?>" aria-valuemin="<?= $data['start'] ?>" aria-valuemax="<?= $data['end'] ?>"></div>
    </div>
</div>

<div class="stats bgColor activityTextMargin">
    <h3>Activity</h3>
</div>

<div class="d-flex flex-wrap">
    <?php
    $items = $data['activities'];
    foreach ($items as $post):
        $movie = null;
        foreach ($movies as $mov) {
            if ($post->getMovieId() == $mov->getId()) {
                $movie = $mov;
            }
        }
        ?>
    <div class="d-flex flex-row m-3  stats fw-bold activityWidth">
        <div>
            <a href="<?= $link->url("movie.index", ['movieId' => $post->getMovieId()]) ?>"><img class="activityImage" src="<?= $movie->getImage() ?>" alt="404"></a>
        </div>
        <div class="d-flex align-items-center justify-content-center p-2">
            <div>
                <span>Watched</span><a class="linkText" href="<?= $link->url("movie.index", ['movieId' => $post->getMovieId()]) ?>"><span class="highlighted p-2"><?= $movie->getTitle() ?></span></a><br>
                <?php if ($post->getRating() != 0): ?>
                    <span>Score: </span><?= $post->getRating() ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="activityDate p-2">
            <?php $storedDate = $post->getDate();
            $storedDateTime = new DateTime($storedDate);
            $currentDateTime = new DateTime();
            $interval = $storedDateTime->diff($currentDateTime);
            if ($interval->y > 0) {echo $interval->format('%Y years ago'); }
            elseif ($interval->m > 0) {echo $interval->format('%m months ago'); }
            elseif ($interval->d > 0) {echo $interval->format('%d days ago'); }
            elseif ($interval->h > 0) {echo $interval->format('%h hours ago'); }
            elseif ($interval->i > 0) {echo $interval->format('%i minutes ago'); }
            elseif ($interval->s > 0) {echo $interval->format('%s seconds ago'); }
            ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>
