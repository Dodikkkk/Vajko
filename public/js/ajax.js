async function deleteUser(user) {
    if (!confirm("Are you sure?"))
    {
        return;
    }
    await fetch("?c=home&a=delete&id=" + user, {
        method:'DELETE'
    });
    var deletedUser = document.getElementById("user" + user);
    deletedUser.parentNode.removeChild(deletedUser);
}