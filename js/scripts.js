
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
            window.location.reload();
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


var intervalHandlers = {};

function setTimer(post_id) {

    post_id = "#e" + post_id;

    var user_input = prompt("Please set timer in minutes:", "0");
    var secondsRemaining, intervalID;
    var timerHTML = document.querySelector(post_id + " #timer");
    var noteHTML = document.querySelector(".entry" + post_id);

    // check if not a number
    if (isNaN(user_input) || user_input == 0) {
        alert("Enter valid time only.");
        return; // stops function if true
    }

    secondsRemaining = user_input;

    function tickTock() {

        // turn the seconds into mm:ss
        var min = Math.floor(secondsRemaining / 60);
        var sec = secondsRemaining - (min * 60);

        //add a leading zero (as a string value) if seconds less than 10
        if (sec < 10) {
            sec = "0" + sec;
        }

        // concatenate with colon
        var message = min.toString() + ":" + sec;

        // now change the display
        timerHTML.innerHTML = " (" + message + ")";

        // stop is down to zero
        if (secondsRemaining === 0) {

            clearInterval(intervalHandlers[post_id]);

            noteHTML.classList.add("divShake");

            setTimeout(function () {

                document.getElementById("alarm").play();

                setTimeout(function () {
                    document.getElementById("alarm").pause();
                    timerHTML.innerHTML = "";
                    noteHTML.classList.remove("divShake");
                }, 5000);
            }, 0);


        }

        //subtract from seconds remaining
        secondsRemaining--;

    }

    function startTimer() {
        if (intervalHandlers[post_id]) {
            clearInterval(intervalHandlers[post_id]);
            intervalID = setInterval(tickTock, 1000);
            intervalHandlers[post_id] = intervalID;
        } else {
            intervalID = setInterval(tickTock, 1000);
            intervalHandlers[post_id] = intervalID;
        }
    }

    startTimer();

}