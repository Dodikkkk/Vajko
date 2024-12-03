<?php

/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Core\LinkGenerator $link */
?>


<div class="container mt-5 textColor">
    <h1 class="text-center">Edit Status</h1>
    <form class="mt-4" method="post" action="<?= $link->url("movie") ?>">
        <div class="mb-3">
            <label for="statusDropdown" class="form-label">Status</label>
            <select id="statusDropdown" class="form-select" name="status">
                <option value="Watching">Watched</option>
                <option value="Completed">Not Watched</option>
                <option value="Plan to Watch">Plan to Watch</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="scoreInput" class="form-label">Score</label>
            <input type="number" id="scoreInput" name="score" class="form-control" placeholder="Score" min="1" max="10" step="0.5">
        </div>

        <div class="mb-3">
            <label for="DateInput" class="form-label">Date</label>
            <input type="date" id="DateInput" name="endDate" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>

<script src="public/js/defaultDate.js"></script>