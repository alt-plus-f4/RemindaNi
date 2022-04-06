function displayNew() {
    newForm = document.getElementById("new");
    newForm.style.display = 'block';
}

function editForm(id) {
    document.getElementById(id).elements["title"].disabled  = false;
    document.getElementById(id).elements["date"].disabled   = false;
    document.getElementById(id).elements["time"].disabled   = false;
    document.getElementById(id).elements["desc"].disabled   = false;
    document.getElementById(id).elements["submit"].disabled = false;
    document.getElementById(id).elements["edit"].style.display = `none`;
    document.getElementById(id).elements["submit"].style.display = `block`;
}