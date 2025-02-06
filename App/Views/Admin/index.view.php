<?php

/** @var array $data */
/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Core\LinkGenerator $link */
?>

<div class="d-flex align-items-center justify-content-center ">
    <div class="  m-5 p-5 text-center loginBox flex-grow-1">
        <button class="btn btn-primary textColor loginButton fw-bold" type="submit" name="updateData" id="updateData" onclick="updateStats()">
            Update Data
        </button>
    </div>
</div>
<div class="d-flex flex-wrap justify-content-center">
    <table class="table table-borderless listTable listWidth table-responsive">
        <thead>
        <tr>
            <th scope="col" class="listImage text-center">ID</th>
            <th scope="col" class="listTitle">Name</th>
            <th scope="col" class="text-center">Is Admin</th>
            <th scope="col" class="text-center">Change admin</th>
            <th scope="col" class="text-center">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['users'] as $user): ?>
            <tr class="list" id="user<?= $user->getUserId() ?>">
                <td class="align-middle text-center"><a class="listImage linkText fw-bold textColor"><?= $user->getUserId() ?></a></td>
                <td class="align-middle"><a class="linkText highlightedList px-2 fw-bold"><?= $user->getName() ?></a></td>
                <td class="align-middle text-center" id="usr<?= $user->getUserId() ?>"><?php if ($user->getIsAdmin() === 1) {echo "yes";} else {echo "no";}  ?></td>
                <td class="align-middle">
                    <div class="d-flex align-items-center justify-content-center">
                        <button class="btn btn-primary textColor changeButton fw-bold" type="submit" name="submit" onclick="adminUser(<?= $user->getUserId() ?>)">
                            Change admin status
                        </button>
                    </div>
                </td>
                <td class="align-middle text-center"><img onclick="deleteUser(<?= $user->getUserId() ?>)" class="listImage" role="button" src="public/images/trash_icon.png" alt="404"></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="public/js/ajax.js"></script>