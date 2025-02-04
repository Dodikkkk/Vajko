function display() {
    var checkBox = document.getElementById("hideDateCheckbox");
    var text = document.getElementById("date");

    if (checkBox.checked == false){
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('dateText').value = today;
        text.style.display = "block";
    } else {
        text.style.display = "none";
    }
}