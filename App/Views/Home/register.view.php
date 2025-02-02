<?php

/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Core\LinkGenerator $link */
?>

<div class="d-flex align-items-center justify-content-center ">
    <div class=" navBarColors m-5 p-5 text-center loginBox flex-grow-1">
        <div class="loginText">
            <h4 class="fw-bold m-3">Register</h4>
        </div>

        <form class="form-signup" method="post" action="<?= $link->url("register") ?>">
            <div class="loginBar">
                <form class="my-2 my-md-0">
                    <input name="login" type="text" id="login" class="form-control" placeholder="Login" required>
                </form>
            </div>
            <div class="loginBar">
                <form class="my-2 my-md-0">
                    <input name="password" type="password" id="password" class="form-control" placeholder="Password" required>
                </form>
            </div>

            <div class="btn btn-primary textColor loginButton fw-bold" type="submit" name="submit">
                Login
            </div>
        </form>

        <div class="loginBar">
            Aleready have account? <a href="<?= $link->url("auth.login") ?>">Login here</a>
        </div>

    </div>
</div>
