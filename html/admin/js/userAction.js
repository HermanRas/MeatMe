function updateAction() {
    var userName = document.getElementById("User").value;

    if (userName != `addUser`) {
        window.location.replace("agent.php?name=" + userName);
    } else {
        window.location.replace("agent.php?add");
    }
}

function deleteAction() {
    userName = document.getElementById('uid').value;
    window.location.replace("agent.php?delete=" + userName);
}