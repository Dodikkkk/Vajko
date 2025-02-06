<?php

/** @var array $data */
/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Core\LinkGenerator $link */

$movies = $data['movies'];
$activities = $data['activities'];
?>

<div class="d-flex flex-wrap justify-content-center">
    <table class="table table-borderless listTable listWidth table-responsive">
        <thead>
        <tr>
            <th scope="col" class="listImage"></th>
            <th scope="col" class="listTitle">Title</th>
            <th scope="col" class="text-center"> Score</th>
            <th scope="col" class="text-center">Genre</th>
            <th scope="col" class="text-center">Release date</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['activities'] as $post):
        $movie = null;
        foreach ($movies as $mov) {
            if ($post->getMovieId() == $mov->getId()) {
                $movie = $mov;
            }
        }
        ?>
        <tr class="list">
            <td><a href="<?= $link->url("movie.index", ['movieId' => $post->getMovieId()]) ?>"><img class="listImage" src="<?= $movie->getImage() ?>" alt="404"></a></td>
            <td class="align-middle"><a class="linkText highlightedList px-2 fw-bold" href="<?= $link->url("movie.index", ['movieId' => $post->getMovieId()]) ?>"><?= $movie->getTitle() ?></a></td>
            <td class="align-middle text-center"><?php if ($post->getRating() != 0) { echo $post->getRating();} ?></td>
            <td class="align-middle text-center"><?php $originalString = $movie->getGenres();
                $genres = explode(" | ", $originalString);
                foreach ($genres as $genre) {
                    echo $genre . " ";
                }
                ?>
            </td>
            <td class="align-middle text-center"><?php
                $dateString = $movie->getReleaseDate();
                $date = DateTime::createFromFormat("Y-m-d", $dateString);
                $formattedDate = $date->format("d.m.Y");
                echo $formattedDate;
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
</div>
