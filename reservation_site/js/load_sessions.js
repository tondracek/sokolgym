var ret = "";

function appendSessions() {
    $.ajax({
        type: "POST",
        url: "storage/delete_old_sessions.php",
        complete: function () {
            $.getJSON("storage/sessions.json", function (data) {
                ret = loadSessions(data);
            });
        }
    });
    return ret;
}

function loadSessions(json_data) {
    let ret = document.createElement("div");

    var data = [];

    for (var i in json_data) {
        data.push(json_data[i]);
    }

    data.forEach((session) => {
        let session_div = document.createElement("div");

        let day = session["day"].split("-");

        const weekday = ["Neděle", "Pondělí", "Úterý", "Středa", "Čtvrtek", "Pátek", "Sobota"];
        let day_in_week = weekday[(new Date(session["day"])).getDay()];

        session_div.innerHTML = `
            <div class="session">
                <div class="session_content">
                    <p1>Den</p1>
                    <p2 class="day">${day[2] + "." + day[1] + ". - " + day_in_week}</p2>
                    <p1>Čas</p1>
                    <p2 class="time">${session["start"]} - ${session["end"]}</p2>
                    <p1>Dohled</p1>
                    <p2>${session["trainer"]}</p2>
                    <p1>Obsazeno</p1>
                    <p2>${session["attendants"].length}/${session["max_capacity"]}</p2>
                    <p1>Účastníci</p1>
                    <marquee float="left" direction="left"> ${session["attendants"]}</marquee>
                    <button onclick="choose_session('${session["day"]}', '${session["start"]}', '${session["end"]}', ${session["attendants"].length}, ${session["max_capacity"]});">Zarezervovat</button>
                </div>
            </div>
        `;

        ret.appendChild(session_div);
    });
    return ret.innerHTML;
}