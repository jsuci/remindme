function showPass() {
    var x = document.getElementById("pass");
    var y = document.getElementById("confirm_pass");

    if (x.type === "password") {
        x.type = "text";
        if (y !== null) {
            y.type = "text";
        }
    } else {
        x.type = "password";
        if (y !== null) {
            y.type = "password";
        }
    }
}
