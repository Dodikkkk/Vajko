<?php

/** @var Array $data */
/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Core\LinkGenerator $link */

$post = $data['post'];
$movieId = $data['movieId'];

$errors = explode(',', $data['errors'] ?? '');
$invalidStatus = in_array('status', $errors);
$invalidRating = in_array('rating', $errors);
?>



<div class="container mt-5 textColor">
    <h1 class="text-center">Edit Status</h1>
    <?php if ($invalidRating || $invalidStatus) { ?>
        <div class="alert alert-danger">
            There was an error with your request.
            <ul>
                <?= $invalidStatus ? '<li>Your status is invalid!</li>' : '' ?>
                <?= $invalidRating ? '<li>Your rating is invalid!</li>' : '' ?>
            </ul>
        </div>
    <?php } ?>
    <form class="mt-4" method="post" action="<?= $link->url("save", ['movieId' => $movieId]) ?>">
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select id="status" class="form-select" name="status" required>
                <option value="Watched" <?= $post ? 'selected="selected"' : '' ?>>Watched</option>
                <option value="Not Watched">Not Watched</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="rating" class="form-label">Score</label>
            <input type="number" id="rating" name="rating" class="form-control" placeholder="Score" min="0" max="10" step="0.5" value="<?= $post?->getRating() ?? '' ?>">
        </div>

        <div class="mb-3">
            <input class="form-check-input" type="checkbox" id="hideDateCheckbox" onclick="display()" checked name="hideDateCheckBox" value="true">
            <label class="form-check-label" for="hideDateCheckbox">This Date</label>
        </div>

        <div class="mb-3" id="date" style="display:none">
            <label for="dateText" class="form-label">Date</label>
            <input type="date" name="dateText" class="form-control" id="dateText">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>


<script src="public/js/unCheckBox.js"><script
<script src="public/js/defaultDate.js"></script>