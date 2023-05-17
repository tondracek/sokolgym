<!DOCTYPE html>
<html lang="en" version="3.1.1">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="M36nxgVbSVORBGjHGd2FhMoG2aLodNYIWCb5A_8eRhU" />
    <meta name="description" content="SokolGym Mohelno | Posilovna Mohelno | Rezervační systém">

    <!-- NO CACHE -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <title>Rezervace návštěvy</title>
    <link rel="icon" type="image/x-icon" href="../res/favicon.ico">
    <link rel="stylesheet" href="style.css">

    <script src="../components/jquery-3.6.1.min.js" charset="utf-8"></script>
</head>

<body>
    <a href="../" style="position: absolute; color: white; margin: 10px; text-decoration: none;">&larr; Zpět</a>

    <h1 class="shiny" style="padding-top: 10%; margin: 0%; font-size: 50px">SokolGym</h1>
    <p style="text-align: center; margin-top: 0px">Mohelno</p>

    <hr width="70%">
    <p style="text-align: center; font-size: 22px;" onclick="open_popup(document.getElementById('tutorial'))">Klikněte pro NÁVOD</p>

    <div id="tutorial" class="popup" style="max-height: 90%; overflow-y: scroll;">
        <div style="white-space: pre-wrap;">
            <p1 style="text-align: center; font-weight: bold; margin: 10px;">Bez registrace</p1>
            <p1> Bez registrace se můžete přihlásit k již existujícím termínům, ale nemůžete vytvářet termíny vlatní.</p1>
            <p1> Z nabídky níže vyberte termín, který vám vyhovuje. Klikněte na tlačítko <u>zaregistrovat</u> a ve vyskakovacím okně vyplňte své jméno, přijmení a emailovou adresu. Po stiknutí tlačítka <u>Přihlásit se</u> Vám pošleme na emailovou adresu <b>email s odkazem pro potvrzení přihlášní na termín</b>. Po stisknutí tlačítka <u>Potvrdit</u> v emailu jste si úspěšně zaregistrovali místo na daný termín.</p1>
            <p1 style="text-align: center; font-weight: bold; margin: 10px;">Chci získat registraci</p1>
            <p1> Pokud chcete vytvářet vlastní termíny v dostupný čas, potřebujete registraci. Kontaktujte nás osobně nebo na email v zápatí této stránky. Po podepsání <u>Smlouvy o nájmu</u> (taktéž dostupná v zápatí) získáte klíče od posilovny a jednorázový kód pro vytvoření uživatelského účtu, pomocí kterého budete moct vytvářet vlatní rezervace.</p1>
            <p1> Po získání jednorázového kódu stiskněte tlačítko <u>Vytvořit účet</u> a ve vyskakovacím okně vyplňte váš email, heslo a jednorázový kód. S nově vytvořeným účtem můžete vytvářet vlastní rezervace v čase, který je volný.</p1>
            <button id="button" type="button" style="margin-top: 15px" onclick="close_popup(document.getElementById('tutorial'))">Zavřít</button>
        </div>
    </div>

    <h1 style="margin-bottom: 0; margin-top: 5%">pravidelné rezervace</h1>
    <div style="text-align: center;">
        <p1>Rezervovat místo lze pouze v daný den.</p1>
    </div>

    <div class="sessions" id="regular_sessions">
        <!-- LOAD SESSIONS WITH JS AND PHP -->
    </div>

    <div style="padding-left: 5%; padding-right: 5%;">
        <p1>Případně probíhá domluva na soukromé Facebook skupině. Pro přidání ke skupině se neváhejte ozvat <a href="https://www.facebook.com/SokolGymMohelno">ZDE</a>.</p1>
    </div>

    <h1 style="margin-bottom: 0; margin-top: 5%">jednorázové rezervace</h1>
    <div class="sessions" id="sessions">
        <!-- LOAD SESSIONS WITH JS AND PHP -->
    </div>

    <hr width="70%">

    <div id="create_session">
        <button onclick="open_popup(document.getElementById('session_create_popup'))">Vytvořit termín</button>
        <button style="padding: 2px" onclick="open_popup(document.getElementById('create_user_popup'))">Vytvořit účet</button>
        <p onclick="open_popup(document.getElementById('create_code_popup'))">Vytvořit kód</p>
    </div>

    <!-- POPUP CREATE SESSION -->
    <div id="session_create_popup" class="popup">
        <form action="storage/create_session.php" method="post">
            <div>
                <p1>Den</p1>
                <input type="date" name="day" autocomplete="off">
                <p1>Začátek</p1>
                <input type="time" name="start">
                <p1>Konec</p1>
                <input type="time" name="end">
                <p1>Dohled</p1>
                <input type="text" name="trainer">
                <p1>Maximální kapacita</p1>
                <input type="number" value="5" name="max_capacity">
                <p1>Zamluveno (mimo dohled)</p1>
                <input type="number" value="0" name="reserved_capacity">
                <hr width="70%">
                <p1>Email</p1>
                <input type="email" value="" name="email" autocomplete="email">
                <p1>Heslo</p1>
                <input type="password" value="Heslo" name="password" autocomplete="current-password">
                <input type="submit" style="margin-top: 5px" value="Vytvořit">
                <button id="button" type="button" style="margin-top: 5px" onclick="close_popup(document.getElementById('session_create_popup'))">Zrušit</button>
            </div>
        </form>
    </div>

    <!-- POPUP JOIN SESSION -->
    <div id="session_join_popup" class="popup">
        <form action="../mail_html/session_join_mail.php" method="post">
            <div>
                <p1>Jméno a příjmení</p1>
                <input type="text" name="name">
                <p1>E-mail</p1>
                <input type="email" name="email">
                <hr width="70%">
                <input type="submit" value="Přihlásit se">
                <button id="button" type="button" style="margin-top: 5px" onclick="close_popup(document.getElementById('session_join_popup'));">Zrušit</button>
            </div>
        </form>
    </div>
    <!-- POPUP CREATE USER -->
    <div id="create_user_popup" class="popup">
        <form action="storage/create_user.php" method="post">
            <div class="">
                <p1>Váš email</p1>
                <input type="email" name="email">
                <p1>Vaše heslo</p1>
                <input type="password" name="password" autocomplete="new-password">
                <p1>Vaše heslo znovu</p1>
                <input type="password" name="password_again" autocomplete="new-password">
                <hr width="70%">
                <p1>Jednorázový kód</p1>
                <input type="text" name="code">
                <hr width=70%>
                <input type="submit" value="Vytvořit účet">
                <button id="button" type="button" style="margin-top: 5px" onclick="close_popup(document.getElementById('create_user_popup'));">Zrušit</button>
            </div>
        </form>
    </div>

    <!-- POPUP CREATE ONE-TIME CODE -->
    <div id="create_code_popup" class="popup">
        <form action="storage/create_code.php" method="post">
            <div class="">
                <p1>Adminské heslo</p1>
                <input type="password" name="password">
                <hr width=70%>
                <input type="submit" value="Vytvořit jednorázový kód">
                <button id="button" type="button" style="margin-top: 5px" onclick="close_popup(document.getElementById('create_code_popup'));">Zrušit</button>
            </div>
        </form>
    </div>

    <footer id="footer">
        <script src="../components/footer.js?v=3.1" charset="utf-8"></script>
    </footer>

    <script src="js/load_sessions.js?v=3.1" charset="utf-8"></script>
    <script src="js/load_regular_sessions.js?v=3.1.1" charset="utf-8"></script>
    <script type="text/javascript">
        let loaded_sessions = document.getElementById("sessions");

        function reload() {
            loaded_sessions.innerHTML = appendSessions();
            appendRegularSessions(document.getElementById("regular_sessions"));
            setTimeout(reload, 5000);
        }
        loaded_sessions.innerHTML = appendSessions();
        appendRegularSessions(document.getElementById("regular_sessions"));
        setTimeout(reload, 500);
    </script>
    <script src="js/open_popup.js"></script>
    <script src="js/choose_session.js" charset="utf-8"></script>
</body>

</html>