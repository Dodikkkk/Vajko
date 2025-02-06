<?php

/** @var Array $data */
/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Core\LinkGenerator $link */
?>

<div class="d-flex align-items-center justify-content-center ">
    <div class=" loginColors m-5 p-5 text-center loginBox flex-grow-1">
        <div class="loginText">
            <h4 class="fw-bold m-3">Register</h4>
        </div>

        <?php if(isset($data['message'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $data['message']; ?>
            </div>
        <?php } ?>
        <form class="form-signup" method="post" action="<?= $link->url("register") ?>">
            <div class="loginBar">
                <div class="my-2 my-md-0">
                    <input name="login" type="text" id="login" class="form-control" placeholder="Login" maxlength="32" required>
                </div>
            </div>
            <div class="loginBar">
                <div class="my-2 my-md-0">
                    <input name="password" type="password" id="password" class="form-control" placeholder="Password" required>
                </div>
            </div>

            <button class="btn btn-primary textColor loginButton fw-bold" type="submit" name="submit">
                Register
            </button>
        </form>

        <div class="loginBar">
            Aleready have account? <a href="<?= $link->url("auth.login") ?>">Login here</a>
        </div>

    </div>
</div>
