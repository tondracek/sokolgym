function choose_session(day, start, end, current, max) {
    if (current < max) {
        open_popup(document.getElementById('session_join_popup'));
        data = { "day": day, "start": start, "end": end, "id": 0, "regular": false};
        $.ajax({
            type: "POST",
            url: "storage/choose_session.php",
            data: data
        });
    } else {
        alert("Termín je již zaplněn");
    }
}

function choose_regular_session(id) {
    $.getJSON("storage/regular_sessions.json", function (json) {
        let session = json[id];
        if (session["attendants"].length < session["max_capacity"]) {
            open_popup(document.getElementById('session_join_popup'));
            data = { "day": "", "start": session["start"], "end": session["end"], "id": id, "regular": true};
            $.ajax({
                type: "POST",
                url: "storage/choose_session.php",
                data: data
            });
        } else {
            alert("Termín je již zaplněn");
        }
    });
}