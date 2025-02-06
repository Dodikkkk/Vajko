async function deleteUser(user) {
    if (!confirm("Are you sure?"))
    {
        return;
    }
    await fetch("?c=admin&a=delete&id=" + user, {
        method:'DELETE'
    });
    var deletedUser = document.getElementById("user" + user);
    deletedUser.parentNode.removeChild(deletedUser);
}

async function adminUser(user) {
    if (!confirm("Are you sure?"))
    {
        return;
    }
    await fetch("?c=admin&a=changeAdminStatus&id=" + user, {
        method:'UPDATE'
    });
    var newUser = document.getElementById("usr" + user);
    if (newUser.innerText === "yes") {
        newUser.innerText = "no";
    } else {
        newUser.innerText = "yes";
    }
}

async function updateStats() {
    if (!confirm("Are you sure?"))
    {
        return;
    }
    var tlacitko = document.getElementById("updateData");
    tlacitko.innerText = "Updating...";
    tlacitko.setAttribute("disabled", "true");
    try {
        await fetch("?c=admin&a=updateStats", {
            method:'UPDATE'
        });
    } catch (e) {
        console.error(e);
        alert("Something went wrong");
    }
    tlacitko.innerText = "Update Data";
    tlacitko.removeAttribute("disabled");
}