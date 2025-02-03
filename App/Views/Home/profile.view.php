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
                    <?php
                    $counter = 0;
                    foreach ($data['activities'] as $post) {
                        $counter++;
                    }
                    echo $counter;
                    ?>
                </div>
                <div class="">
                    Total Movies
                </div>
            </div>
            <div class="col text-center p-1">
                <div class="highlighted">
                    <!--TODO pocitadlo aj pre toto -->
                    1.2
                </div>
                <div class="">
                    Days Watched
                </div>
            </div>
            <div class="col text-center p-1">
                <div class="highlighted">
                    <?php
                    $sum = 0;
                    $counter = 0;
                    foreach ($data['activities'] as $post) {
                        $sum = $sum + $post->getRating();
                        $counter++;
                    }
                    if ($counter > 0) {
                        echo round($sum / $counter, 2);
                    } else {
                        echo "0";
                    }
                    ?>
                </div>
                <div class="">
                    Mean Score
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex p-2 border-top">
        <div class="nula">
            <?php $counter = 0;
            foreach ($data['activities'] as $post) {
                $counter++;
            }
            if ($counter < 11) {
                echo "0";
            } elseif ($counter > 10 && $counter < 26) {
                echo "10";
            } elseif ($counter > 25 && $counter < 101) {
                echo "25";
            } elseif ($counter > 100 && $counter < 251) {
                echo "100";
            } else {
                echo "250";
            }
            ?>
        </div>
        <div class="polovica">
            <?php $counter = 0;
            foreach ($data['activities'] as $post) {
                $counter++;
            }
            if ($counter < 11) {
                echo "5";
            } elseif ($counter > 10 && $counter < 26) {
                echo "17.5";
            } elseif ($counter > 25 && $counter < 101) {
                echo "62.5";
            } elseif ($counter > 100 && $counter < 251) {
                echo "625";
            } else {
                echo "1000";
            }
            ?>
        </div>
        <div class="stovka">
            <?php $counter = 0;
            foreach ($data['activities'] as $post) {
                $counter++;
            }
            if ($counter < 11) {
                echo "10";
            } elseif ($counter > 10 && $counter < 26) {
                echo "25";
            } elseif ($counter > 25 && $counter < 101) {
                echo "100";
            } elseif ($counter > 100 && $counter < 251) {
                echo "250";
            } else {
                echo "1000";
            }
            ?>
        </div>
    </div>
    <div class="progress">
        <div class="progress-bar highlightedBg" role="progressbar" style="width: <?php
        $counter = 0;
        foreach ($data['activities'] as $post) {
            $counter++;
        }
        echo $counter;
        $ratio = 0;
        if ($counter < 11) {
            $ratio = 10;
        } elseif ($counter > 10 && $counter < 26) {
            $ratio = 25;
        } elseif ($counter > 25 && $counter < 101) {
            $ratio = 100;
        } elseif ($counter > 100 && $counter < 251) {
            $ratio = 250;
        } else {
            $ratio = 1000;
        }
        $ratio = $counter / $ratio;
        echo $ratio;
        ?>%;" aria-valuenow="<?php
        $counter = 0;
        foreach ($data['activities'] as $post) {
            $counter++;
        }
        echo $counter;
        ?>" aria-valuemin="<?php $counter = 0;
        foreach ($data['activities'] as $post) {
            $counter++;
        }
        if ($counter < 11) {
            echo "0";
        } elseif ($counter > 10 && $counter < 26) {
            echo "10";
        } elseif ($counter > 25 && $counter < 101) {
            echo "25";
        } elseif ($counter > 100 && $counter < 251) {
            echo "100";
        } else {
            echo "250";
        }
        ?>" aria-valuemax="<?php $counter = 0;
        foreach ($data['activities'] as $post) {
            $counter++;
        }
        if ($counter < 11) {
            echo "10";
        } elseif ($counter > 10 && $counter < 26) {
            echo "25";
        } elseif ($counter > 25 && $counter < 101) {
            echo "100";
        } elseif ($counter > 100 && $counter < 251) {
            echo "250";
        } else {
            echo "1000";
        }
        ?>"></div>
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
            <?= /*$storedDate = $post->getDate();
            $storedDateTime = new DateTime($storedDate);
            $currentDateTime = new DateTime();
            $interval = $storedDateTime->diff($currentDateTime);
            if ($interval->y > 0) {echo $interval->format('%Y years ago'); }
            elseif ($interval->m > 0) {echo $interval->format('%m months ago'); }
            elseif ($interval->d > 0) {echo $interval->format('%d days ago'); }
            elseif ($interval->h > 0) {echo $interval->format('%h hours ago'); }
            elseif ($interval->i > 0) {echo $interval->format('%i minutes ago'); }
            elseif ($interval->s > 0) {echo $interval->format('%s seconds ago'); }*/
            $post->getDate();
            ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>
