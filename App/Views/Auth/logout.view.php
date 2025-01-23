<?php

$layout = 'auth';
/** @var \App\Core\LinkGenerator $link */
?>

<div class="d-flex align-items-center justify-content-center ">
    <div class=" navBarColors m-5 p-5 text-center loginBox flex-grow-1">
        <div class="loginText">
            <h4 class="fw-bold m-3">You have been logged out</h4>
        </div>


        <a class="btn btn-primary textColor logoutButton fw-bold p-3" href="<?= $link->url("home.index") ?>">
            Back to browsing
        </a>

        <a class="btn btn-primary textColor logoutButton fw-bold p-3" href="<?= $link->url("auth.login") ?>">
            Login again
        </a>

    </div>
</div>