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


function editNote(post_id) {
    var post_entry = "e" + post_id
    var post_title = post_entry + " .title";
    var post_message = post_entry + " .message";


    var title = document.querySelector(`#${post_title}`);
    var message = document.querySelector(`#${post_message}`);


    title.setAttribute('contenteditable', true);
    message.setAttribute('contenteditable', true);

}

function saveNote(post_id) {
    var post_entry = "e" + post_id
    var post_title = post_entry + " .title";
    var post_message = post_entry + " .message";


    var title = document.querySelector(`#${post_title}`);
    var message = document.querySelector(`#${post_message}`);

    var title_text = title.innerHTML;
    var title_message = message.textContent;

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    };

    xhttp.open("POST", `./incl/dashboard.inc.php`, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(
        `post_id=${post_id}&title=${title_text}&message=${title_message}`
    );



    title.removeAttribute('contenteditable');
    message.removeAttribute('contenteditable');


}