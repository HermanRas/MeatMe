function updateAction() {
    var farmAction = document.getElementById("farm").value;

    if (farmAction != `addFarm`) {
        window.location.replace("area.php?name=" + farmAction);
    } else {
        window.location.replace("area.php?add");
    }
}

function deleteAction() {
    farmName = document.getElementById('uid').value;
    window.location.replace("area.php?delete=" + farmName);
}