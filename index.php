<!DOCTYPE html>
<html lang="cs" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="M36nxgVbSVORBGjHGd2FhMoG2aLodNYIWCb5A_8eRhU" />
    <meta name="description" content="SokolGym Mohelno | Posilovna Mohelno | Vítejte v SokolGymu. Naše posilovna se nachází v mohelenské sokolovně. V rezervačním systému se můžete přihlásit do existujících termínů, nebo si zažádat o klíče a vytvořit si vlastní termín.">

    <title>SokolGym - Posilovna MOHELNO</title>
    <link rel="icon" type="image/x-icon" href="res/favicon.ico">
    <link rel="stylesheet" href="style.css">
  </head>

  <body>
<!-- NAVIGATION BAR -->
    <div id="header" class="expand">
      <div class="fill_bg" style="background-color: #000000;"></div>
      <div class="fill_bg" style="background-color: #151718;" id="header_bg"></div>

      <img id="logo" src="res/logo.png" onclick="window.scrollTo({top: 0, behavior: 'smooth'});" alt="sokol logo">
      <div id="links">
        <div>
          <span onclick="document.getElementById('photo_text_div').scrollIntoView({behavior: 'smooth'});">ÚVOD</span> |
          <span onclick="document.getElementById('reservation_div').scrollIntoView({behavior: 'smooth'});">REZERVAČNÍ SYSTÉM</span  >
        </div>
      </div>
    </div>

<!-- INFO WIDGET -->
    <div id="info_widget" class="shown_info_widget" onclick="document.getElementById('photo_text_div').scrollIntoView({behavior: 'smooth'});">
      <p>INFO</p>
      <span>&#8595;</span>
    </div>

<!-- INTRO IMAGE -->
    <div id="intro_image_div">
      <div>
        <img id="intro_image" src="res\sokol_gym.jpg" alt="sokol gym logo">
        <script type="text/javascript">
          {
            let intro_image_div = document.getElementById("intro_image_div");
            let header = document.getElementById("header");
            intro_image_div.style.height = "calc(100vh - " + header.clientHeight + "px)";
          }
        </script>
      </div>
    </div>

    <div id="photo_text_div">
<!-- IMAGE SLIDESHOW -->
      <div id="image_show_div">
        <img class="image" data-src="res\image_show\sokolovna.jpg" alt="sokolovna">
        <img class="image" data-src="res\image_show\posilovna.jpg" alt="posilovna">
        <img class="image" data-src="res\image_show\protein_pooh.jpg" alt="protein pooh">
        <img class="image" data-src="res\image_show\creatine_tiger.jpg" alt="creatine tiger">
        <img class="image" data-src="res\image_show\metal_eeyore.jpg" alt="metal_eeyore">
        <script src="js\setup_image_animation.js" charset="utf-8"></script>
      </div>
<!-- INTRODUCING TEXT -->
      <div id="text_div">
        <h1 style="margin-bottom: 0px" class="shiny">SokolGym</h1>
        <p style="margin-top: 0px">Mohelno</p>
        <p>
          Vítejte v SokolGymu. Naše posilovna se nachází v mohelenské sokolovně. V rezervačním systému se můžete přihlásit do existujících termínů, nebo si zažádat o klíče a vytvořit si vlastní termín.
        </p>
      </div>
    </div>

    <hr width="70%">
<!-- RESERVATION -->
    <div id="reservation_div">
      <h1>REZERVACE NÁVŠTĚVY</h1>
      <div id="reservation_button_div">
        <button class="reservation_button" onclick="location.href='reservation_site/index.php?v=3.1.1';">REZERVOVAT ZDE</button>
      </div>
    </div>

    <footer id="footer">
      <script src="components/footer.js" charset="utf-8"></script>
    </footer>

    <script src="js/on_scroll.js" charset="utf-8"></script>
  </body>
</html>
