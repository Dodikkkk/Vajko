<?php

/** @var array $data */
/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Core\LinkGenerator $link */

/**$movies = $data['movies'];*/
?>

<div class="d-flex textColor m-5 justify-content-center">
    <div class="m-2">
        <div class="text-center">
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
        <div class="text-center">
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


<div class="d-flex flex-wrap justify-content-center">
    <table class="table table-borderless listTable listWidth">
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
        <?php foreach ($data['activities'] as $post): ?>
        <tr class="list">
            <td><a href="<?= $link->url("home.movie", ['movieId' => $post->getMovieId()]) ?>"><img class="listImage" src="public/images/poster.jpg" alt="404"></a></td>
            <td class="align-middle"><a class="linkText highlightedList px-2 fw-bold" href="<?= $link->url("home.movie", ['movieId' => $post->getMovieId()]) ?>">Hardcore Henry</a></td>
            <td class="align-middle text-center"><?= $post->getRating() ?></td>
            <td class="align-middle text-center">Action, Sci-fi</td>
            <td class="align-middle text-center">8. 4. 2016</td>
        <?php endforeach; ?>
        </tbody>

    <!--</table>
    <?php /**foreach ($data['activities'] as $post): ?>
        <div class="d-flex flex-row list fw-bold listWidth">
            <div>
                <a href="<?= $link->url("home.movie", ['movieId' => $post->getMovieId()]) ?>"><img class="listImage" src="public/images/poster.jpg" alt="404"></a>
            </div>
            <div class="d-flex align-items-center justify-content-center p-2">
                <div>
                    <span>Watched</span><a class="linkText highlightedList px-2" href="<?= $link->url("home.movie", ['movieId' => $post->getMovieId()]) ?>">Hardcore Henry</a><br>
                    <span>Score: </span><?= $post->getRating() ?>
                </div>
            </div>
            <div class=" p-2">
                2 days ago
            </div>
        </div>
    <?php endforeach; */?>
    -->
</div>
