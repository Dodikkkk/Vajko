<?php

/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Core\LinkGenerator $link */
?>

<div class="d-flex align-items-center justify-content-center ">
    <div class=" navBarColors m-5 p-5 text-center loginBox flex-grow-1">
        <div class="loginText">
            <h4 class="fw-bold m-3">Login</h4>
        </div>

        <div class="loginBar">
            <form class="my-2 my-md-0">
                <input class="form-control " type="text" placeholder="Name" aria-label="Search">
            </form>
        </div>
        <div class="loginBar">
            <form class="my-2 my-md-0">
                <input class="form-control " type="text" placeholder="Password" aria-label="Search">
            </form>
        </div>

        <div class="btn btn-primary textColor loginButton fw-bold">
            Login
        </div>

        <div class="loginBar">
            Don't have account? <a href="<?= $link->url("home.register") ?>">Register here</a>
        </div>

    </div>
</div>