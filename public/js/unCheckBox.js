function display() {
    // Get the checkbox
    var checkBox = document.getElementById("hideDateCheckbox");
    // Get the output text
    var text = document.getElementById("date");

    // If the checkbox is checked, display the output text
    if (checkBox.checked == false){
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('dateText').value = today;
        text.style.display = "block";
    } else {
        text.style.display = "none";
    }
}