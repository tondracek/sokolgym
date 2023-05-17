function appendRegularSessions(div, time) {
    $.ajax({
        type: "POST",
        url: "storage/regular_sessions/update_regular_sessions.php",
        complete: function () {
            $.getJSON("storage/regular_sessions/regular_sessions.json?t=" + time, function (json) {
                loadRegularSessions(div, json);
            });
        }
    })
}

function loadRegularSessions(div, sessions) {
    div.innerHTML = "";
    for (var i in sessions) {
        let session = sessions[i];

        const weekday = [" Po", " Út", " St", " Čt", " Pá", " So", " Ne"];
        let days = [];
        for (let i in session["days"]) {
            days.push(weekday[i]);
        }

        let session_div = document.createElement("div");
        session_div.innerHTML = `
            <div id="session_${session["id"]}" class="session">
                <div class="session_content">
                    <p1>Dny</p1>
                    <p2 class="day">${days}</p2>
                    <p1>Čas</p1>
                    <p2 class="time">${session["start"]} - ${session["end"]}</p2>
                    <p1>Obsazeno</p1>
                    <p2>${session["attendants"].length}/${session["max_capacity"]}</p2>
                    <p1>Účastníci</p1>
                    <p2 class="attendants">${"• " + session["attendants"]}</p2>
                    <button class="regular_sessions_button" onclick="choose_regular_session(${session["id"]})">Zarezervovat</button>
                </div>
            </div>
        `;

        div.appendChild(session_div);

        let today = (new Date().getDay() + 6) % 7;
        let button = session_div.getElementsByClassName("regular_sessions_button")[0];
        if (today in session["days"]) {
            button.disabled = false;
        } else {
            button.disabled = true;
        }
    }
}