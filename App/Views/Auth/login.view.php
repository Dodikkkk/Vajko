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

        <form class="form-signin" method="post" action="<?= $link->url("auth.login") ?>">
            <div class="loginBar">
                <input name="login" type="text" id="login" class="form-control" placeholder="Login" required>
            </div>
            <div class="loginBar">
                <input name="password" type="password" id="password" class="form-control" placeholder="Password" required>
            </div>

            <button class="btn btn-primary textColor loginButton fw-bold" type="submit" name="submit">
                Login
            </button>
        </form>

        <div class="loginBar">
            Don't have account? <a href="<?= $link->url("auth.register") ?>">Register here</a>
        </div>

    </div>
</div>