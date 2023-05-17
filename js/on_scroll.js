let header = document.getElementById("header");
let intro_image_div = document.getElementById("intro_image_div");
let info_widget = document.getElementById("info_widget");
let logo = document.getElementById("logo");
let links = document.getElementById("links");
let photo_text_div = document.getElementById("photo_text_div")
let header_bg = document.getElementById("header_bg");

intro_image_fade();

window.addEventListener("scroll", function() {
  intro_image_fade();
  shrink_nav();
});

function intro_image_fade() {
  let intro_image_div_bounds = intro_image_div.getBoundingClientRect();
  let opacity = intro_image_div_bounds.bottom / (intro_image_div_bounds.bottom - intro_image_div_bounds.top);

  if (opacity < 0.05) {
    opacity = 0;
  }
  if (opacity > 1) {
    opacity = 1;
  }

  let opacity_value = Math.round(opacity*opacity*1000)/1000;

  intro_image_div.style.opacity = opacity_value;
  photo_text_div.style.opacity = 1 - opacity_value;
  header_bg.style.opacity = 1 - opacity_value;
}

function shrink_nav() {
  if (document.documentElement.scrollTop > 32) {
    header.className = "shrink"
    info_widget.className = "hidden_info_widget";
  } else if (document.documentElement.scrollTop < 16) {
    header.className = "expand"
    info_widget.className = "shown_info_widget";
  }
}
