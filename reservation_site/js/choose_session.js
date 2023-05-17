function choose_session(id, regular) {
    let file = (regular) ? "storage/regular_sessions/regular_sessions.json" : "storage/onetime_sessions/sessions.json";

    $.getJSON(file, function (json) {
        let session = json[id];
        if (session["attendants"].length < session["max_capacity"]) {
            open_popup(document.getElementById('session_join_popup'));
            let data = {"id": id, "regular": regular};
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